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
        $instDetails = $institute_table->first(['institutionID' => $_SESSION['user_id']]);
        $this->view('Institute/InstituteDashboard', ['instDetails' => $instDetails]);
    }

    public function Library()
    {
        $this->view('OpenUser/browse');
    }

    public function PurchasePackage()
    {
        $this->view('Institute/InstitutePurchasePackage');
    }

    public function ManageUser()
    {

        $institute_table = new Institution();
        $user_table = new User();
        $instDetails = $institute_table->first(['institutionID' => $_SESSION['user_id']]); // to get institute name

        $instDomainName = explode('@', $instDetails['username'])[0]; //get the name from username

        $instUsers = null;
        if ($instDomainName)
            $instUsers = $user_table->getInstituteUsers($instDomainName);

        $data = [
            'instDetails' => $instDetails,
            'instUsers' => $instUsers
        ];

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
        $institution_table->insert(['name' => $name, 'username' => $username, 'password' => $password, 'subStartDate' => $subStartDate, 'subPlan' => 5, 'creator' => $creator]);
        $institution_table->insert(['name' => $name, 'username' => $username, 'password' => $password, 'subStartDate' => $subStartDate, 'subPlan' => 5, 'creator' => $creator]);

        $user = new User();//updating the user as a creator of an institution
        $user->update($creator, ['userType' => 'inst'], 'userID');
        $user->update($creator, ['userType' => 'inst'], 'userID');

        //end session
        session_destroy();
        header('Location: /Free-Write/public/Login');
        //end session
        session_destroy();
        header('Location: /Free-Write/public/Login');
    }

    // public function read()
    // {
    //     $institutionModel = new Institution();
    //     $institutions = $institutionModel->fetchAllInstitutions();
    //     $this->view('institution/InstituteManageUser', ['institutions' => $institutions]);
    // }

    // public function update($id) //uipdate institute details
    // {
    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //         $institutionModel = new Institution();
    //         $data = [
    //             'institutionName' => $_POST['institutionName'],
    //             'username' => $_POST['username'],
    //             'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
    //             'subStartDate' => $_POST['subStartDate'],
    //             'subEndDate' => $_POST['subEndDate'],
    //             'subPlan' => $_POST['subPlan'],
    //             'Creater' => $_POST['Creater']
    //         ];

    //         if ($institutionModel->updateInstitution($id, $data)) {
    //             echo "Institution updated successfully!";
    //         } else {
    //             echo "Failed to update institution.";
    //         }
    //     }

    //     $institutionModel = new Institution();
    //     $institution = $institutionModel->findInstitutionById($id);
    //     $this->view('editInstitution', ['institution' => $institution]);
    // }

    // public function delete($id)
    // {
    //     $institutionModel = new Institution();
    //     if ($institutionModel->deleteInstitution($id)) {
    //         echo "Institution deleted successfully!";
    //     } else {
    //         echo "Failed to delete institution.";
    //     }
    // }

    /**
     * USER MANAGEMENT
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

            $dataUser = [
                'email' => $userEmail,
                'password' => $_POST['password'],
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

        $userDetails_table->update($userID, ['firstName' => $firstName, 'lastName' => $lastName], 'user');
        $user_table->update($userID, ['email' => $username], 'userID');


        header('Location: /Free-Write/public/Institute/ManageUser');
    }

    public function deleteUser()
    {
        $user_table = new User();
        $userDetails_table = new UserDetails();

        $userID = $_POST['userID'];

        $userDetails_table->delete($userID, 'user');
        $user_table->delete($userID, 'userID');

        header('Location: /Free-Write/public/Institute/ManageUser');
    }


    /**
     * USER MANAGEMENT
     * INSERT
     * UPDATE
     * DELETE
     */

}