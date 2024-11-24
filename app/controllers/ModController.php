<?php

class ModController extends Controller
{
    public function index()
    {
        //echo "this is the Mod Controller\n";
        $URL = splitURL();

        if (count($URL) == 2) {
            switch ($URL[1]) {
                case 'viewTable':
                    $this->view('moderator/adminViewTable');
                    break;
                case 'siteLogs':
                    $this->getSiteLogs();
                    break;
                case 'modLogs':
                    $this->view('moderator/adminModLogs');
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
        $this->view('moderator/adminDashboard', $data);
    }

    public function viewTable()
    {
        $modlog = new ModLog();
        $tables = $modlog->getAllTables();
        $this->view('moderator/adminViewTable', $tables);
    }

    public function getSiteLogs()
    {
        $sitelog = new SiteLog();
        $logs = $sitelog->findAll();
        $this->view('moderator/adminSiteLogs', $logs);
    }

    public function Users()
    {
        //query details
        $this->view('moderator/modUserManagement' );
    }

    public function Reports()
    {
        //query details
        $this->view('moderator/reportHandlePage');
    }

}