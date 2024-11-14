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

        $userDetails = $userDetailsTable->getUserDetails($uid);
        $list = $Booklist->getBookListCount($uid);
        $userAcc = $user->first(['userID' => $uid]);

        $this->view('Profile/userProfile', ['userAccount' => $userAcc, 'userDetails' => $userDetails, 'listCounts' => $list]);
    }
}