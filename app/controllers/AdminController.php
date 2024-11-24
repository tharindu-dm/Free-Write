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
                    $this->getSiteLogs();
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

    public function viewTable()
    {
        $modlog = new ModLog();
        $tables = $modlog->getAllTables();
        $this->view('admin/adminViewTable', $tables);
    }

    public function getSiteLogs()
    {
        $sitelog = new SiteLog();
        $logs = $sitelog->findAll();
        $this->view('admin/adminSiteLogs', $logs);
    }

}