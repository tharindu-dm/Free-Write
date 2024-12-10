<?php

class ModController extends Controller
{
    public function index()
    {
        //echo "this is the Mod Controller\n";
        $this->view('error');
    }

    public function modLogs()
    {
        $modlog = new ModLog();
        $logs = $modlog->findAll();
        $this->view('moderator/adminModLogs', $logs);
    }

    public function Dashboard()
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

    public function siteLogs()
    {
        $sitelog = new SiteLog();
        $logs = $sitelog->findAll();
        $this->view('moderator/adminSiteLogs', $logs);
    }

    //USER MANAGEMENT
    public function Users()
    {
        //query details
        //getting mod name

        $this->view('moderator/modUserManagement');
    }

    public function Search()
    {
        $user = new User();
        $userDetails = new UserDetails();

        $criteria = $_POST['searchCriteria'];
        $input = $_POST['searchInput'];

        switch ($criteria) {
            case 'id':
                $data = $user->WHERE(['userID' => $input]);
                break;
            case 'name':
                $data = $userDetails->WHERE(['' => $input]);
                break;
            case 'email':
                $data = $user->WHERE(['email' => $input]);
                break;
            default:
                header('location: /Free-Write/public/Mod/Users');
        }
    }

    public function DeactivateUser()
    {
        //deactivate user
        $user = new User();
        $user->update($_GET['usr_id'], ['isActivated' => 0], 'userID');
    }

    //INSTIUTION MANAGEMENT
    public function Institutes()
    {
        //query details
        $this->view('moderator/modInstituteManagement');
    }

    //REPORT HANDLING
    public function Reports()
    {
        //query details
        $this->view('moderator/reportHandlePage');
    }

}