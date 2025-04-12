<?php

class LoginController extends Controller
{
    public function index()
    {
        //echo "this is the User Controller\n";
        $this->view('login');

    }

    public function handleLogin()
    {
        if (session_status() == PHP_SESSION_NONE) {

            echo "session is not started\n";
            session_start();
        }

        // Checking if user is already logged in
        if (isset($_SESSION['user_id'])) {
            switch ($_SESSION['user_type']) {
                case 'inst':
                    header('Location: /Free-Write/public/Institute');
                    break;
                default:
                    header('Location: /Free-Write/public/');
                    break;
            }
            exit;
        }

    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //echo "inside the post request\n";
            $user = new User();
            $userDetails = new UserDetails();

            $result = $user->createUser($_POST['signup-email'], $_POST['pw'], "reader", 0, 1);

            if ($result) {
                $newUserID = $user->first(['email' => $_POST['signup-email']]);
                $regDate = date("Y-m-d H:i:s");
                $result = $userDetails->addUserDetails($newUserID["userID"], $_POST['fname'], $_POST['lname'], $regDate, $regDate);

                if ($result) {
                    //echo "User details created successfully!\n";
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
        $sitelog = new SiteLog();
        $user_email = $_POST['log-email'];

        // Start the session if it's not already started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user = new User();
            $userData = $user->first(['email' => $user_email]);

            //attempt on institution
            if ($userData == null) {
                $institution = new Institution();
                $userData = $institution->first(['username' => $user_email]);

                if ($userData) //if institution is found
                    $this->InstitutionLogin($userData);

            }

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
                    $_SESSION['user_premium'] = $userData['isPremium'];
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
                $response['success'] = true;
                $response['message'] = 'login_success';
                //$response['redirect'] = '/Free-Write/public/User/Profile';

                switch ($userData['userType']) {
                    case 'admin':
                        $response['redirect'] = '/Free-Write/public/Mod/Dashboard';
                        break;
                    case 'mod':
                        $this->modLogUpdate();
                        $response['redirect'] = '/Free-Write/public/Mod/Dashboard';
                        break;
                    case 'reader':
                    case 'writer':
                    case 'covdes':
                    case 'wricov':
                        $response['redirect'] = '/Free-Write/public/User/Profile';
                        break;
                    case 'courier':
                        $response['redirect'] = '/Free-Write/public/courier';
                        break;
                    case 'publisher':
                        $response['redirect'] = '/Free-Write/public/publisher';
                        break;
                    case 'inst':
                        $response['redirect'] = '/Free-Write/public/Institute';
                        break;
                    default:
                        $response['redirect'] = '/Free-Write/public/';
                        break;
                }

                echo json_encode($response);
                return;
            } else {
                // Failed login attempt
                $newAttempts = $userData['loginAttempt'] + 1;
                $user->update($userData['userID'], ['loginAttempt' => $newAttempts], 'userID');

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

    public function InstitutionLogin($institutionData)
    {
        $sitelog = new SiteLog();
        //$institution = new Institution();

        // Start the session if it's not already started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $pw = $_POST['log-password'];

        if ($institutionData) {

            if (($pw == $institutionData['password'])) {
                //echo "<script>alert('Password is correct!');</script>";

                // Set session variables
                $_SESSION['user_id'] = $institutionData['institutionID'];
                $_SESSION['user_type'] = 'inst';
                $_SESSION['user_name'] = $institutionData['name'];

                // Update sitelog with successful login attempt
                $dataset = array(
                    'user' => $institutionData['creator'],
                    'activity' => 'Institution ' . $institutionData['name'] . ' Successfully logged in',
                    'occurrence' => date("Y-m-d H:i:s")
                );
                $sitelog->insert($dataset);

                // Redirect to the appropriate page based on user type
                $this->handleLogin();
                exit;
            } else {
                echo "<script>alert('Password is incorrect.')</script>";
                $this->view('login');
            }
        } else {
            echo "<script>alert('User  not found.')</script>";
        }

        $this->view('login');
    }
    public function logout()
    {
        //echo "inside the logout function\n";
        $sitelog = new SiteLog();
        $dataset = array();

        if ($_SESSION['user_type'] == 'mod')
            $dataset['mod'] = $_SESSION['user_id'];
        else
            $dataset['user'] = $_SESSION['user_id'];

        if ($_SESSION['user_type'] == 'inst')
            $dataset['activity'] = 'Institution ' . $_SESSION['user_name'] . ' Successfully logged out';
        else
            $dataset['activity'] = $_SESSION['user_type'] . ' ' . $_SESSION['user_name'] . ' Successfully logged out';
        $dataset['occurrence'] = date("Y-m-d H:i:s");

        if ($_SESSION['user_type'] == 'mod') {
            $modLog = new ModLog();
            $modLog->insert($dataset);
        }

        // Change the key name from 'mod' to 'user'
        // Check if the key exists
        if (isset($dataset['mod'])) {
            $dataset['user'] = $dataset['mod']; // Copy value to the new key
            unset($dataset['mod']); // Remove the old key
        }
        $sitelog->insert($dataset);


        // Destroy the session
        session_destroy();

        // Redirect to the login page
        header('Location: /Free-Write/public/');
        exit;
    }

    public function modLogUpdate()
    {
        //echo "inside the modLogUpdate function\n";
        $modLog = new ModLog();

        $modLog->insert(
            [
                'mod' => $_SESSION['user_id'],
                'activity' => 'Moderator ' . $_SESSION['user_name'] . ' Successfully logged in',
                'occurrence' => date("Y-m-d H:i:s")
            ]
        );
    }

    /*public function userProfile()
    {
        echo "inside the userProfile function\n";
        $this->view('Profile/userProfile');
    }*/
}