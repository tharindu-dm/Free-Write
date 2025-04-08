<?php

class LoginController extends Controller
{
    public function index()
    {
        //echo "this is the Login Controller\n";
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
        //create a new user and add user details to the database. this will create a new entry in site log.

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

        // Start the session if it's not already started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') { // this section checks if the request method is POST and see if it has the relevant parameters
            $user_email = $_POST['log-email'] ?? '';
            $password = $_POST['log-password'] ?? '';
            $response = ['success' => false, 'message' => '', 'lockout' => false, 'remainingTime' => 0]; // Initialize response array to log the response

            $user = new User();
            $userData = $user->first(['email' => $user_email, 'isActivated' => 1]); //checking email in user table 

            // Check institution - if user not found
            if ($userData == null) {
                $institution = new Institution();
                $userData = $institution->first(['username' => $user_email]);

                if ($userData) {
                    return $this->InstitutionLogin($userData); // institution is found, call InstitutionLogin method
                }
            }

            if (!$userData) {
                $response['message'] = 'user_not_found';
                echo json_encode($response);
                return; // user nor institution found
            }

            // Handle lockout status using cookies
            if ($userData['loginAttempt'] >= 3) {
                $lockoutTime = $_COOKIE['lockout_time'] ?? 0; // Check if lockout time is set in cookies
                $currentTime = time();
                $remainingTime = $lockoutTime - $currentTime;

                if ($remainingTime > 0) {
                    $response['lockout'] = true;
                    $response['remainingTime'] = $remainingTime;
                    $response['message'] = 'account_locked';

                    // Log the locked login attempt
                    $sitelog->insert([
                        'user' => $userData['userID'],
                        'activity' => 'Locked Login Attempt',
                        'occurrence' => date("Y-m-d H:i:s")
                    ]);

                    echo json_encode($response); // echo an error message
                    return;
                } else {
                    // Reset lockout if time expired
                    $this->resetLoginAttempts($userData['userID'], $user);
                    $userData['loginAttempt'] = 0;
                }
            }

            // Verify password
            if ($password === $userData['password']) {
                // Successful login
                $_SESSION['user_id'] = $userData['userID'];
                $_SESSION['user_type'] = $userData['userType'];
                $_SESSION['user_premium'] = $userData['isPremium'];

                // Reset login attempts
                $this->resetLoginAttempts($userData['userID'], $user);

                // Update last login
                $userDetails = new UserDetails();
                $userDetails->update($userData['userID'], ['lastLogDate' => date("Y-m-d H:i:s")], 'user');

                // Get user full name
                $userFLnames = $userDetails->first(['user' => $userData['userID']]);
                $_SESSION['user_name'] = $userFLnames['firstName'] . " " . $userFLnames['lastName'];

                // Log successful login
                $sitelog->insert([
                    'user' => $userData['userID'],
                    'activity' => 'Successfully logged in',
                    'occurrence' => date("Y-m-d H:i:s")
                ]);

                $response['success'] = true;
                $response['message'] = 'login_success';
                //$response['redirect'] = '/Free-Write/public/User/Profile';

                //user is redirected to the relevant page based on the user type
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

                // Log failed attempt
                $sitelog->insert([
                    'user' => $userData['userID'],
                    'activity' => 'Failed login attempt',
                    'occurrence' => date("Y-m-d H:i:s")
                ]);

                // Check if user should be locked out by its login attempts
                if ($newAttempts >= 3) {
                    $lockoutEndTime = time() + (5 * 60); // 5 minutes lockout
                    setcookie('lockout_time', $lockoutEndTime, $lockoutEndTime, "/");
                    $response['lockout'] = true;
                    $response['remainingTime'] = 300; // 5 minutes in seconds
                    $response['message'] = 'account_locked';
                } else {
                    $response['message'] = 'invalid_password';
                    $response['remainingAttempts'] = 3 - $newAttempts;
                }

                echo json_encode($response);
                return;
            }
        }

        // If not POST request, just show the login view
        $this->view('login');
    }

    // Private function to reset login attempts
    private function resetLoginAttempts($userId, $userModel)
    {
        //if use successfully loggedin then reset the login attempts to 0
        $userModel->update($userId, ['loginAttempt' => 0], 'userID');
        if (isset($_COOKIE['lockout_time'])) {
            setcookie('lockout_time', '', time() - 3600, "/"); // Clear the cookie
        }
    }


    public function InstitutionLogin($institutionData)
    {
        //we arrive here because a record in insitution tables is found. login process is as normal.
        $sitelog = new SiteLog();

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
        //loggout funciton which update the site log with the logout activity and destroy the session
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

        if ($_SESSION['user_type'] == 'mod') { //updating the mod's log with the logout activity
            $modLog = new ModLog();
            $modLog->insert($dataset);
        }

        // Change the key name from 'mod' to 'user'
        // Check if the key exists
        if (isset($dataset['mod'])) {
            $dataset['user'] = $dataset['mod']; // Copy value to the new key
            unset($dataset['mod']); // Remove the old key
        }
        $sitelog->insert($dataset); //also adding entry to sitelog specifically mentioning its a mod that logged out.


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
}
