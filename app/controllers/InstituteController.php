<?php

class InstituteController extends Controller
{
    public function index()
    {
        $this->Dashboard();
    }

    public function Dashboard()
    {
        $institute_table = new Institution();
        $instDetails = $institute_table->first(['creator' => $_SESSION['user_id']]);
        $this->view('Institute/InstituteDashboard', ['instDetails' => $instDetails]);
    }

    public function Library()
    {
        $this->view('OpenUser/browse');
    }

    public function Setting()
    {
        $institute_table = new Institution();
        $userID = $_SESSION['user_id'];

        $instDetails = $institute_table->first(['creator' => $userID]);

        $success = $_GET['success'] ?? null;
        $error = $_GET['error'] ?? null;

        $this->view('Institute/InstituteSetting', [
            'instDetails' => $instDetails,
            'success' => $success,
            'error' => $error
        ]);
    }

    public function updateSetting()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $institute_table = new Institution();
            $userID = $_SESSION['user_id'];

            // Find the institution where the creator is the current user
            $instDetails = $institute_table->first(['creator' => $userID]);
            if ($instDetails) {
                $id = $instDetails['institutionID'];

                //check exsisting name
                // $existingInst = $institute_table->first(['creator' =>  $userID]);
                // if ($existingInst && $existingInst['institutionID'] != $id) {
                //     header('Location: /Free-Write/public/Institute/Setting?error=Username+already+exists');
                //     exit;
                // }

                // Check if username ends with @inst.fw
                if (!str_ends_with($_POST['username'], '@inst.fw')) {
                    header('Location: /Free-Write/public/Institute/Setting?error=Username+must+end+with+@inst.fw');
                    exit;
                }

                // Check length of name and username
                if (strlen($_POST['name']) > 25) {
                    header('Location: /Free-Write/public/Institute/Setting?error=Institution+name+too+long');
                    exit;
                }
                if (strlen($_POST['username']) > 25) {
                    header('Location: /Free-Write/public/Institute/Setting?error=Username+too+long');
                    exit;
                }

                $data = [
                    'name' => $_POST['name'],
                    'username' => $_POST['username'],
                ];

                $result = $institute_table->updateInstitution($id, $data);
                if ($result) {
                    header('Location: /Free-Write/public/Institute/Setting?success=1');
                } else {
                    header('Location: /Free-Write/public/Institute/Setting?error=1');
                }
                exit;
            } else {
                header('Location: /Free-Write/public/Institute/Setting?error=1');
                exit;
            }
        }
        header('Location: /Free-Write/public/Institute/Setting');
    }

    public function ManageUser()
    {

        $institute_table = new Institution();
        $user_table = new User();
        $instDetails = $institute_table->first(['creator' => $_SESSION['user_id']]); // to get institute name

        if (!$instDetails) {
            // Handle the case where no institution is found
            $data = [
                'instDetails' => null,
                'instUsers' => null,
                'error' => 'Institution not found'
            ];
        } else {
            // Only proceed if we have valid institution details
            $instDomainName = explode('@', $instDetails['username'])[0];
            $instUsers = $user_table->getInstituteUsers($instDomainName);

            $data = [
                'instDetails' => $instDetails,
                'instUsers' => $instUsers
            ];
        }

        $this->view('Institute/InstituteManageUser', $data);
    }
    public function Register()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /Free-Write/public/Login');
        }

        $user = new User();
        $email = $user->first(['userID' => $_SESSION['user_id']]);
        $this->view('Institute/InstituteSignUpForm', ['user' => $email]);
    }

    public function signup()
    {
        $institution_table = new Institution();
        echo "<script>alert('now in signup funct')</script>";
        $name = $_POST['institutionName'];
        $username = $_POST['username'] . "@inst.fw";
        $username = $_POST['username'] . "@inst.fw";
        $password = $_POST['password'];
        $subStartDate = date("Y-m-d H:i:s");
        //$subEndDate = nope
        //subplan is fixed
        $creator = $_SESSION['user_id'];


        //add a new institution with its own login and pw
        $institution_table->insert(['name' => $name, 'username' => $username, 'password' => $password, 'subStartDate' => $subStartDate, 'subPlan' => 4, 'creator' => $creator]);

        $user = new User(); //updating the user as a creator of an institution
        $user->update($creator, ['userType' => 'inst'], 'userID');

        //end session
        session_destroy();
        header('Location: /Free-Write/public/Login');
        //end session
        session_destroy();
        header('Location: /Free-Write/public/Login');
    }

    /**
     * INSERT
     * UPDATE
     * DELETE
     */

    public function addNewUser()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user_table = new User();
            $userDetails_table = new UserDetails();

            $userEmail = $_POST['username'] . "" . $_POST['instUserDomain'];

            // Check if email already exists
            $existingUser = $user_table->first(['email' => $userEmail]);

            if ($existingUser) {
                // Store error message in session
                $_SESSION['add_user_error'] = "User email already exists!";
                header('Location: /Free-Write/public/Institute/ManageUser');
                exit();
            }

            $dataUser = [
                'email' => $userEmail,
                'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                'userType' => 'instUser',
                'isPremium' => 0,
                'isActivated' => 1,
                'loginAttempt' => 0,
            ];

            $user_table->insert($dataUser);
            $user = $user_table->first(['email' => $dataUser['email']]);

            $dataDetails = [
                'user' => $user['userID'],
                'firstName' => $_POST['firstName'],
                'lastName' => $_POST['lastName'],
                'regDate' => date("Y-m-d H:i:s"),
                'lastLogDate' => date("Y-m-d H:i:s"),
                'bio' => 'User from Institute: ' . $_POST['instName'],
            ];

            $userDetails_table->insert($dataDetails);
        } else {
            echo "Failed to add user.";
        }

        header('Location: /Free-Write/public/Institute/ManageUser');
    }

    public function updateUser()
    {
        $user_table = new User();
        $userDetails_table = new UserDetails();

        $userID = $_POST['userID'];
        $username = $_POST['user_username'];
        $firstName = $_POST['user_firstName'];
        $lastName = $_POST['user_lastName'];

        $query = "SELECT * FROM User WHERE email = :email AND userID != :userID LIMIT 1";
        $result = $user_table->query($query, ['email'=>$username, 'userID'=>$userID]);

        if($result){
            die("Error: This email is already taken by another user.");
        }

        $userDetails_table->update($userID, ['firstName' => $firstName, 'lastName' => $lastName], 'user');
        $user_table->update($userID, ['email' => $username], 'userID');


        header('Location: /Free-Write/public/Institute/ManageUser');
    }

    public function deleteUser()
    {
        $userID = $_POST['userID'];

        $userModel = new User();
        $userModelData = $userModel->first(['userID' => $userID]);

        $userModel->update($userID,['isActivated' => 9,'password' => "", 'email' => $userModelData['email']."-deleted"], 'userID');

        header('Location: /Free-Write/public/Institute/ManageUser');
    }

    public function checkEmailExists()
    {
        if (isset($_GET['email']) && isset($_GET['userID'])) {
            $email = $_GET['email'];
            $userID = $_GET['userID'];

            $user_table = new User();

            // Find user by email but exclude the current user
            $query = "SELECT * FROM user WHERE email = :email AND userID != :userID LIMIT 1";
            $result = $user_table->query($query, ['email' => $email, 'userID' => $userID]);

            if ($result) {
                echo json_encode(['exists' => true]);
            } else {
                echo json_encode(['exists' => false]);
            }
        } else {
            echo json_encode(['exists' => false]);
        }
    }

}
