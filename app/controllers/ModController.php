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
        $users = $userTable->getNormalUsers();

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

    public function DeleteUser()
    {
        // First verify the delete confirmation was typed correctly
        if (!isset($_POST['deleteConfirmText']) || $_POST['deleteConfirmText'] !== "DELETE THIS USER") {
            // Redirect back with error if confirmation text is wrong
            $_SESSION['error'] = 'Delete confirmation text was incorrect';
            header('location: /Free-Write/public/Mod/Users');
            exit();
        }

        // Check if userId exists in POST
        if (!isset($_POST['userId'])) {
            $_SESSION['error'] = 'No user ID provided';
            header('location: /Free-Write/public/Mod/Users');
            exit();
        }

        $userId = $_POST['userId'];

        // Initialize models
        $user = new User();
        $userDetails = new UserDetails();

        try {
            // Perform deletions
            $user->delete($userId, 'userID');
            $userDetails->delete($userId, 'user');

            // Log the moderation action
            $modlog = new ModLog();
            $ModLogActivity = sprintf(
                'Mod: %s deleted USER: %s (Email: %s)',
                $_SESSION['user_name'],
                $userId,
                $userData['email'] ?? 'unknown'  // Include email in log if available

                //sprintf is used to format the string with the variables
            );

            $modlog->insert([
                'mod' => $_SESSION['user_id'],
                'activity' => $ModLogActivity,
                'occurrence' => date('Y-m-d H:i:s')
            ]);

            $_SESSION['success'] = 'User successfully deleted';
        } catch (Exception $e) {
            $_SESSION['error'] = 'Error deleting user: ' . $e->getMessage();
        }

        header('location: /Free-Write/public/Mod/Users');
        exit();
    }

    public function UpdateUser()
    {
        // UpdateUser 
        $user = new User();
        $userDetails = new UserDetails();

        // Validations
        if (!isset($_POST['userId'])) {  // User ID
            $_SESSION['error'] = 'No user ID provided';
            header('location: /Free-Write/public/Mod/Users');
            exit();
        }

        $userId = $_POST['userId'];

        if (!isset($_POST['userType'])) { // User Type
            $_SESSION['error'] = 'No user type provided';
            header('location: /Free-Write/public/Mod/Users');
            exit();
        }

        if (!isset($_POST['loginAttempts'])) { // Login Attempts
            $_SESSION['error'] = 'No login attempts provided';
            header('location: /Free-Write/public/Mod/Users');
            exit();
        }

        if (!isset($_POST['premium'])) { // Premium
            $_SESSION['error'] = 'No premium status provided';
            header('location: /Free-Write/public/Mod/Users');
            exit();
        }

        if (!isset($_POST['activated'])) { // Activated
            $_SESSION['error'] = 'No activation status provided';
            header('location: /Free-Write/public/Mod/Users');
            exit();
        }

        if (!isset($_POST['firstName'])) { // First Name
            $_SESSION['error'] = 'No first name provided';
            header('location: /Free-Write/public/Mod/Users');
            exit();
        }

        if (!isset($_POST['lastName'])) { // Last Name
            $_SESSION['error'] = 'No last name provided';
            header('location: /Free-Write/public/Mod/Users');
            exit();
        }

        if (!isset($_POST['country'])) { // Country
            $_SESSION['error'] = 'No country provided';
            header('location: /Free-Write/public/Mod/Users');
            exit();
        }

        if (!isset($_POST['dob'])) { // Date of Birth
            $_SESSION['error'] = 'No date of birth provided';
            header('location: /Free-Write/public/Mod/Users');
            exit();
        }

        if (!isset($_POST['bio'])) { // Bio
            $_SESSION['error'] = 'No bio provided';
            header('location: /Free-Write/public/Mod/Users');
            exit();
        }

        // Length validations
        if (strlen($_POST['firstName']) > 45) {
            $_SESSION['error'] = 'First name exceeds maximum length of 45 characters';
            header('location: /Free-Write/public/Mod/Users');
            exit();
        }

        if (strlen($_POST['lastName']) > 45) {
            $_SESSION['error'] = 'Last name exceeds maximum length of 45 characters';
            header('location: /Free-Write/public/Mod/Users');
            exit();
        }

        if (strlen($_POST['country']) > 45) {
            $_SESSION['error'] = 'Country exceeds maximum length of 45 characters';
            header('location: /Free-Write/public/Mod/Users');
            exit();
        }

        if (strlen($_POST['bio']) > 255) {
            $_SESSION['error'] = 'Bio exceeds maximum length of 255 characters';
            header('location: /Free-Write/public/Mod/Users');
            exit();
        }

        // Update user details in the database
        try {
            $user->update($userId, [
                'userType' => $_POST['userType'],
                'email' => $_POST['email'],
                'loginAttempt' => $_POST['loginAttempts'],
                'isPremium' => $_POST['premium'],
                'isActivated' => $_POST['activated']
            ], 'userID');
            
            $userDetails->update($userId, [
                'firstName' => $_POST['firstName'],
                'lastName' => $_POST['lastName'],
                'country' => $_POST['country'],
                'dob' => $_POST['dob'],
                'bio' => $_POST['bio']
            ], 'user');

            // Log the moderation action
            $modlog = new ModLog();
            $ModLogActivity = sprintf(
                'Mod: %s updated USER: %s (Email: %s)',
                $_SESSION['user_name'],
                $userId,
                $_POST['email'] ?? 'unknown'  // Include email in log if available
            );

            $modlog->insert([
                'mod' => $_SESSION['user_id'],
                'activity' => $ModLogActivity,
                'occurrence' => date('Y-m-d H:i:s')
            ]);

            $_SESSION['success'] = 'User  successfully updated';
        } catch (Exception $e) {
            $_SESSION['error'] = 'Error updating user: ' . $e->getMessage();
        }

        header('location: /Free-Write/public/Mod/Users');
        exit();
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