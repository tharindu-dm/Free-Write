<?php

class CourierController extends Controller
{
    public function index()
    {
        $this->view('courier/courier');
    }

    public function Dashboard()
    {
        if ($_SESSION['user_type'] == 'courier')
            $this->view('courier/Dashboard');
        else
            header('location: /Free-Write/public/Login');
    }

}