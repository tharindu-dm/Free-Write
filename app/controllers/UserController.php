<?php

class UserController extends Controller
{
    public function index()
    {
        //echo "this is the User Controller\n";
        $URL = splitURL();

        if (count($URL) == 2) {
            switch ($URL[1]) {
                case 'profile':
                    $this->userProfile();
                    break;
                default:
                    $this->view('login');
                    break;
            }

        } else {
            $this->view('login');
        }
    }

    public function userProfile()
    {
        $uid = $_SESSION['user_id'];
        //echo "inside the userProfile function\n";
        $userDetailsTable = new UserDetails();
        $Booklist = new BookList(); //List Table

        $userDetails = $userDetailsTable->getUserDetails($uid);
        $list = $Booklist->getBookListCount($uid);
        
        $this->view('userProfile', ['user' => $userDetails, 'listCounts' => $list]);
    }
}