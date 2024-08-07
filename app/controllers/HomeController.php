<?php

class HomeController extends Controller
{
    function show($stuff)
    {
        echo "<pre>";
        print_r($stuff);
        echo "</pre>";
    }    

    public function index()
    {
        //echo "this is the Home Controller";
        $model = new Model;
        $arr['username'] = 'user1';
        $arr['password'] = '0a041b9462caa4a31bac3567e0b6e6fd9100787db2ab433d96f6d178cabfce90';
        $arr['userType'] = 'reader';
        $arr['isPremium' ] = 0;
        $arr['isActivated'] = 1;
        $arr['loginAttempt'] = 0;

        $result = $model->insert($arr);

        $this->show($result);

        $this->view("home");
    }
}