<?php

class AdminController extends Controller
{
    public function index()
    {
        //echo "this is the Admin Controller\n";
        $URL = splitURL();

        if (count($URL) == 2) {
            switch ($URL[1]) {
                case 'Dashboard':

                default:
                    $this->view('adminDashboard');
                    break;
            }

        } else {
            $this->view('adminDashboard');
        }
    }
}