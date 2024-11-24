<?php

class LoginController extends Controller
{
    public function index()
    {
        //echo "this is the User Controller\n";
        $this->view('login');

    }

    //set expire
    //set login attempt counter
    //set logging login time
    //set site logs

    public function handleLogin()
    {
        if (session_status() == PHP_SESSION_NONE) {

            echo "session is not started\n";
            session_start();
        }

        // Checking if user is already logged in
        if (isset($_SESSION['user_id'])) {
            switch ($_SESSION['user_type']) {
                case 'admin':
                    header('Location: /Free-Write/public/Admin');
                    break;
                case 'mod':
                    header('Location: /Free-Write/public/Mod');
                    break;
                case 'reader':
                case 'writer':
                case 'covdes':
                case 'wricov':
                    header('Location: /Free-Write/public/User/Profile');
                    break;
                case 'courier':
                    header('Location: /Free-Write/public/courier');
                    break;
                case 'publisher':
                    header('Location: /Free-Write/public/publisher');
                    break;
                case 'inst':
                    header('Location: /Free-Write/public/inst');
                    break;
                default:
                    header('Location: /Free-Write/public/');
                    break;
            }
            exit;
        }

    }

    /*
        parameters include the username and password and stuff
        perform the insert in user.php
        change the interface to login page
    */

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //echo "inside the post request\n";
            $user = new User();
            $userDetails = new UserDetails();

            $result = $user->createUser($_POST['signup-email'], $_POST['pw'], "reader", 0, 0);



            if ($result) {
                $newUserID = $user->getUserByUsername($_POST['signup-email']);
                $regDate = date("Y-m-d H:i:s");
                $result = $userDetails->addUserDetails($newUserID["userID"], $_POST['fname'], $_POST['lname'], $regDate, $regDate);

                if ($result) {
                    echo "User details created successfully!\n";
                    $sitelog = new SiteLog();

                    $useremail = array(
                        'email' => $_POST['signup-email']
                    );
                    $userid = $user->first($useremail);

                    $dataset = array(
                        'user' => $userid['userID'],
                        'activity' => 'Successfully registered',
                        'occurrence' => $regDate
                    );
                    $sitelog->insert($dataset);
                } else {
                    echo "<script>alert('Failed to create user details')</script>";
                }
            } else {
                echo "<script>alert('Failed to create user')</script>";
            }

            $this->view('login');
        } else {
            //echo "inside the get request";
            $this->view('login');
        }
    }

    public function login()
    {
        // Start the session if it's not already started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user = new User();
            $sitelog = new SiteLog();
            $userData = $user->getUserByUsername($_POST['log-email']);

            // Check if user is currently locked out
            if ($userData && $userData['loginAttempt'] >= 3) {
                // Check if lockout time has expired
                if (isset($_SESSION['lockout_time']) && time() < $_SESSION['lockout_time']) {
                    // User is still locked out
                    echo "<script>alert('Account locked for 5 minutes due to multiple failed attempts.Lockout time is set to: " . date('Y-m-d H:i:s', $_SESSION['lockout_time']) . "\\nCurrent time is: " . date('Y-m-d H:i:s') . "');</script>";

                    // Log the locked login attempt
                    $dataset = array(
                        'user' => $userData['userID'],
                        'activity' => 'Locked Login',
                        'occurrence' => date("Y-m-d H:i:s")
                    );
                    $sitelog->insert($dataset);

                    //header("Location: /Free-Write/public/Login");
                    $this->view('login');
                    return;
                } else {
                    // Lockout period has expired, reset the login attempts and clear lockout_time
                    $user->update($userData['userID'], ['loginAttempt' => 0], 'userID');
                    unset($_SESSION['lockout_time']);
                }
            }

            $pw = $_POST['log-password'];

            if ($userData) {

                if (($pw == $userData['password']) && $userData['loginAttempt'] < 3) {
                    echo "<script>alert('Password is correct!');</script>";

                    // Set session variables
                    $_SESSION['user_id'] = $userData['userID'];
                    $_SESSION['user_type'] = $userData['userType'];

                    // Update sitelog with successful login attempt
                    $dataset = array(
                        'user' => $userData['userID'],
                        'activity' => 'Successfully logged in',
                        'occurrence' => date("Y-m-d H:i:s")
                    );
                    $sitelog->insert($dataset);

                    // Reset login attempts on successful login
                    $user->update($userData['userID'], ['loginAttempt' => 0], 'userID');

                    // Set last login date
                    $userDetails = new UserDetails();
                    $userDetails->update($userData['userID'], ['lastLogDate' => date("Y-m-d H:i:s")], 'user');

                    // Redirect to the appropriate page based on user type
                    $this->handleLogin();
                    exit;
                } else {
                    echo "<script>alert('Password is incorrect.')</script>";

                    // Increase login attempt counter
                    $newcount = $userData['loginAttempt'] + 1;
                    $user->update($userData['userID'], ['loginAttempt' => $newcount], 'userID');

                    // Log the failed login attempt
                    $dataset = array(
                        'user' => $userData['userID'],
                        'activity' => 'Failed login attempt',
                        'occurrence' => date("Y-m-d H:i:s")
                    );
                    $sitelog->insert($dataset);

                    // Set lockout time if attempts reach 3
                    if ($newcount >= 3) {
                        $_SESSION['lockout_time'] = time() + (5 * 60); // 5 minutes lockout
                    }

                    $this->view('login');
                }
            } else {
                echo "<script>alert('User  not found.')</script>";
            }

            $this->view('login');
        } else {
            $this->view('login');
        }
    }

    public function logout()
    {
        //echo "inside the logout function\n";
        // Start the session if it's not already started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Destroy the session
        session_destroy();

        // Redirect to the login page
        header('Location: /Free-Write/public/');
        exit;
    }

    public function userProfile()
    {
        echo "inside the userProfile function\n";
        $this->view('Profile/userProfile');
    }
}
