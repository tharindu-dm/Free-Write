<?php

class LoginController extends Controller
{
    public function index()
    {
        //echo "this is the User Controller\n";
        $this->view('login');
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //echo "inside the post request\n";
            $user = new User();
            $userDetails = new UserDetails();

            $hashedpw = password_hash($_POST['pw'], PASSWORD_DEFAULT);

            $result = $user->createUser($_POST['signup-email'], $hashedpw /*$_POST['pw']*/ , "reader", 0, 1);

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

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user_email = $_POST['log-email'] ?? '';
            $password = $_POST['log-password'] ?? '';

            $response = ['success' => false, 'message' => '', 'lockout' => false, 'remainingTime' => 0];

            $user = new User();
            $userData = $user->first(['email' => $user_email, 'isActivated' => 1]); //checking email in user table 

            // Check institution - if user not found
            if ($userData == null) {
                $institution = new Institution();
                $userData = $institution->first(['username' => $user_email]);

                if ($userData) {
                    $this->InstitutionLogin($userData);
                    return;
                } else {
                    $response['message'] = 'user_not_found';
                    header('Content-Type: application/json');
                    echo json_encode($response);
                    exit;
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

                    echo json_encode($response);
                    return;
                } else {
                    // Reset lockout if time expired
                    $this->resetLoginAttempts($userData['userID'], $user);
                    $userData['loginAttempt'] = 0;
                }
            }

            // Verify password
            if (password_verify($password, $userData['password'])) {/*$password === $userData['password']*/
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

                if ($userData['isPremium'] != 1 || !isset($_SESSION['user_id'])) {
                    $advertisement = new Advertisement();
                    $ad = $advertisement->first(['status' => 'active']);

                    ($ad) ? $_SESSION['user_ads'] = $ad['adImage'] : null;
                }

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
        $userModel->update($userId, ['loginAttempt' => 0], 'userID');
        if (isset($_COOKIE['lockout_time'])) {
            setcookie('lockout_time', '', time() - 3600, "/"); // Clear the cookie
        }
    }

    public function InstitutionLogin($institutionData)
    {
        $sitelog = new SiteLog();

        // Start the session if it's not already started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $pw = $_POST['log-password'];
        $response = ['success' => false, 'message' => '', 'redirect' => ''];

        if ($institutionData) {

            if (password_verify($pw, $institutionData['password'])) {
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

                $response['success'] = true;
                $response['message'] = 'login_success';
                $response['redirect'] = '/Free-Write/public/Institute';

                //header('Location: /Free-Write/public/Institute');
                echo json_encode($response);
                exit;
            } else {
                $response['message'] = 'invalid_password';
            }
        } else {
            $response['message'] = 'user_not_found';
        }
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
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