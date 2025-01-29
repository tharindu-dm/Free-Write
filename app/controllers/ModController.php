<?php
class ModController extends Controller
{
    public function index()
    {
        //echo "this is the Mod Controller\n";
        header('location: /Free-Write/public/Mod/Dashboard');
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
        $userTable = new User();
        $users = $userTable->findAll();

        $this->view('moderator/modUserManagement', ['users' => $users]);
    }

    public function Search()
    {
        $user = new User();
        $userDetails = new UserDetails();

        $criteria = '';
        if (isset($_GET['filter'])) {
            $criteria = $_GET['filter'];
        } else {
            $criteria = 'id';
        }

        $input = '';
        if (isset($_POST['searchInput'])) {
            $input = $_POST['searchInput'];
        } else if (isset($_GET['uid'])) {
            $input = $_GET['uid'];
        } else {
            header('location: /Free-Write/public/Mod/Users');
        }

        switch ($criteria) {
            case 'id':
                $data = $user->WHERE(['userID' => $input]);
                break;
            case 'name':
                $data = $user->getUserByName($input);
                break;
            case 'email':
                $data = $user->WHERE(['email' => $input]);
                break;
            default:
                header('location: /Free-Write/public/Mod/Users');
        }

        if (sizeof($data) == 1) {
            $userDetails = $userDetails->WHERE(['user' => $data[0]['userID']]);
            $this->view('moderator/modUserManagement', ['users' => $data, 'userDetails' => $userDetails]);
        } else {
            $this->view('moderator/modUserManagement', ['users' => $data]);
        }
    }

    public function DeactivateUser()
    {
        //deactivate user
        $user = new User();
        $user->update($_GET['usr_id'], ['isActivated' => 0], 'userID');
    }

    public function DeleteUser()
    {
        //delete user
        $user = new User();
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
        $reportTable = new Report();
        $reports = null;

        if (isset($_GET['filter']) && $_GET['filter'] == 'unhandled') {
            $reports = $reportTable->where(['status' => 'Pending']);
            $unfinishedReports = $reportTable->where(['status' => 'Unfinished']);

            // Merge the two arrays
            $reports = array_merge($reports, $unfinishedReports);
        } elseif (isset($_GET['filter']) && $_GET['filter'] == 'handled') {
            $reports = $reportTable->where(['status' => 'Handled']);
        } elseif (isset($_GET['filter']) && $_GET['filter'] == 'escalated') {
            $reports = $reportTable->where(['status' => 'Escalated']);
        } else {
            $reports = $reportTable->findAll();
        }

        $this->view('moderator/reportHandlePage', ['reports' => $reports]);
    }

    public function HandleReport()
    {
        error_log("Handling report"); // Add server-side logging
        echo "<script>console.log('Handling report - Function reached');</script>";

        // Debug POST data
        error_log("POST data: " . print_r($_POST, true));

        if (!isset($_POST['reportID'], $_POST['reportstatus'], $_POST['newstatus'], $_POST['modResponse'])) {
            error_log("Missing required fields");
            echo "<script>console.log('Missing required fields:', " .
                json_encode($_POST) . ");</script>";
            return;
        }

        $reportTable = new Report();

        $reportID = $_POST['reportID'];
        $reportOldStatus = $_POST['reportstatus'];
        $reportStatus = $_POST['newstatus'];
        $modResponse = $_POST['modResponse'];

        //validations
        if (($reportStatus == 'handled' || $reportStatus == 'Escalated') && $modResponse == '') {
            echo "<script>console.log(Please provide a response to the report)</script>";
            return;
        }

        if ($reportID == '' || $reportStatus == '') {
            echo "<script>console.log(please refresh the site)</script>";
            return;
        }

        //update report
        $reportTable->update($reportID, ['status' => $reportStatus, 'modResponse' => $modResponse, 'handler' => $_SESSION['user_id']], 'reportID');

        //moglog update
        $modlog = new ModLog();
        $ModLogActivity = 'Accessed REPORT: ' . $reportID . ' status changed from: ' . $reportOldStatus . ' to: ' . $reportStatus;

        $modlog->insert(['mod' => $_SESSION['user_id'], 'activity' => $ModLogActivity, 'occurrence' => date('Y-m-d H:i:s')]);

        header('location: /Free-Write/public/Mod/Reports');
        exit();
    }
}