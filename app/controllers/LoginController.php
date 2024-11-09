<?php

class LoginController extends Controller
{
    public function index()
    {
        //echo "this is the User Controller\n";
        $URL = splitURL();

        if (count($URL) == 2) {
            switch ($URL[1]) {
                case 'handleLogin':
                    $this->handleLogin();
                case 'login':
                    $this->login();
                    break;
                case 'register':
                    $this->register();
                    break;
                case 'logout':
                    $this->logout();
                    break;
                default:
                    $this->view('login');
                    break;
            }
        } else {
            $this->view('login');
        }
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

            $result = $user->createUser($_POST['signup-email'], $_POST['pw'], "reader", 0, 1);



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
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user = new User();
            $sitelog = new SiteLog();
            $userData = $user->getUserByUsername($_POST['log-email']);

            // Check if user is currently locked out
            if ($userData && $userData['loginAttempt'] >= 3) {
                if (!isset($_SESSION['lockout_time'])) {
                    // Set lockout time if not set
                    $_SESSION['lockout_time'] = time() + (5 * 60); // 5 minutes from now
                    echo "<script>alert('Account locked for 5 minutes due to multiple failed attempts.');</script>";
                }
                $this->view('login');
                return;
            }

            $pw = $_POST['log-password']; //get login attempt count

            if ($userData) {
                if ($pw == $userData['password'] && $userData['loginAttempt'] < 3) { // && logincount < 3
                    echo "<script> alert('Password is correct!'); </script>";
                    // Start the session if it's not already started
                    if (session_status() == PHP_SESSION_NONE) {
                        session_start();
                    }

                    // Set session variables
                    $_SESSION['user_id'] = $userData['userID'];
                    $_SESSION['user_type'] = $userData['userType'];

                    //update sitelog with successful login attempt
                    $dataset = array(
                        'user' => $userData['userID'],
                        'activity' => 'Successfully logged in',
                        'occurrence' => date("Y-m-d H:i:s")
                    );
                    $sitelog->insert($dataset);

                    //set lastlogindate
                    $userDetails = new UserDetails();
                    $userDetails->update($userData['userID'], ['lastLogDate' => date("Y-m-d H:i:s")], 'user');

                    // Redirect to the appropriate page based on user type
                    $this->handleLogin();
                    exit;
                } else {
                    echo "<script>alert('Password is incorrect.')</script>";
                    //increase login attempt counter
                    $newcount = $userData['loginAttempt'] + 1;
                    $user->update($userData['userID'], ['loginAttempt' => $newcount], 'userID');

                    //update sitelog with failed login attempt
                    $dataset = array(
                        'user' => $userData['userID'],
                        'activity' => 'Failed login attempt',
                        'occurrence' => date("Y-m-d H:i:s")
                    );
                    $sitelog->insert($dataset);

                }
            } else {
                //check for institution login
                echo "<script>alert('User not found.')</script>";
            }

            $this->view('login');
        } else {
            //echo "inside the get request";
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
        $this->view('userProfile');
    }
}
