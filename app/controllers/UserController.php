<?php

class UserController extends Controller
{
    public function index()
    {
        //echo "this is the User Controller\n";
        $URL = splitURL();

        $this->view('login');

    }

    public function Profile()
    {
        $uid = $_SESSION['user_id'];
        //echo "inside the userProfile function\n";
        $user = new User();
        $userDetailsTable = new UserDetails();
        $Booklist = new BookList(); //List Table
        $spinoff = new Spinoff(); //get my spinoffs

        $userDetails = $userDetailsTable->first(['user' => $uid]);//getUserDetails($uid);
        $list = $Booklist->getBookListCount($uid);
        $userAcc = $user->first(['userID' => $uid]);
        $myspinoffs = $spinoff->getUserSpinoff($uid);

        $this->view('Profile/userProfile', ['userAccount' => $userAcc, 'userDetails' => $userDetails, 'listCounts' => $list, 'spinoffs' => $myspinoffs]);
    }

    public function editProfile()
    {
        $uid = $_SESSION['user_id'];
        $user = new User();
        $userDetailsTable = new UserDetails();

        $data = [
            'email' => $_POST['email']
        ];

        $user->update($uid, $data, 'userID');

        $data = [
            'firstName' => $_POST['firstName'],
            'lastName' => $_POST['lastName'],
            'dob' => $_POST['dob'],
            'country' => $_POST['country'],
            'bio' => $_POST['bio']
        ];

        $userDetailsTable->update($uid, $data, 'user');

        header('Location: /Free-Write/public/User/Profile');
    }

    public function DeleteProfile()
    {
        $uid = $_SESSION['user_id'];
        $user = new User();
        $userDetailsTable = new UserDetails();

        $userDetailsTable->delete($uid, 'user');
        $user->delete($uid, 'userID');
        
        session_destroy();
        header('Location: /Free-Write/public/User/Login');
    }
}