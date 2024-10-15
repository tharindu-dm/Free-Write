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
        //echo "inside the userProfile function\n";
        $userDetails = new UserDetails();
        $list = new BookList(); //List Table
        $this->view('userProfile', ['user' => $userDetails, 'list' => $list]);
    }
}