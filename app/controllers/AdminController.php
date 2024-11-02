<?php

class AdminController extends Controller
{
    public function index()
    {
        //echo "this is the Admin Controller\n";
        $URL = splitURL();

        if (count($URL) == 2) {
            switch ($URL[1]) {
                case 'viewTable':
                    $this->view('admin/adminViewTable');
                    break;
                case 'siteLogs':
                    $this->view('admin/adminSiteLogs');
                    break;
                case 'modLogs':
                    $this->view('admin/adminModLogs');
                    break;
                default:
                    $this->retrieveDashboardData();
                    break;
            }

        } else {
            $this->retrieveDashboardData();
        }
    }

    public function retrieveDashboardData()
    {
        $user = new User();
        $data = $user->getUserTypeCounts();
        $this->view('admin/adminDashboard', $data);
    }

}