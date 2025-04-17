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

}