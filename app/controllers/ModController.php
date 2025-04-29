<?php
class ModController extends Controller
{
    public function index()
    {

        $this->checkLoggedUser();
        header('location: /Free-Write/public/Mod/Dashboard');
    }

    private function checkLoggedUser()
    {
        if (!isset($_SESSION['user_id']) && $_SESSION['user_type'] != 'admin' && $_SESSION['user_type'] != 'mod') {
            header('location: /Free-Write/public/');
            exit();
        }
    }

    public function modLogs()
    {
        $this->checkLoggedUser();
        $modlog = new ModLog();
        $logs = null;
        $date = null;
        $whereParams = [];

        if (!empty($_GET['logid']))
            $whereParams['modlogID'] = $_GET['logid'];

        if (!empty($_GET['userID']))
            $whereParams['mod'] = $_GET['userID'];

        if (!empty($whereParams) && empty($_GET['logdate'])) {
            $logs = $modlog->where($whereParams);

        }

        if (!empty($_GET['logdate'])) {
            $date = $_GET['logdate'];
            $logs = $modlog->filterByDate($whereParams, $date);
        }

        if (empty($whereParams) && empty($logs)) {
            $logs = $modlog->findAll();
        }

        $this->view('moderator/adminModLogs', $logs);

    }

    public function Dashboard()
    {
        $this->checkLoggedUser();
        $user = new User();
        $data = $user->getUserTypeCounts();
        $this->view('moderator/adminDashboard', $data);
    }

    public function sendAnnouncement()
    {
        $this->checkLoggedUser();
        $notification = new Notification();


        $subject = trim($_POST['subject'] ?? '');
        if (strlen($subject) > 45) {
            die("Error: Subject must be 45 characters or less.");
        }

        $description = trim($_POST['description'] ?? '');
        $datetime = date('Y-m-d H:i:s');


        if (!isset($_POST['roles']) || !is_array($_POST['roles'])) {
            die("Error: No roles selected.");
        }

        $roles = $_POST['roles'];


        $validRoles = ['mod', 'reader', 'writer', 'covdes', 'inst', 'pub', 'courier'];


        $filteredRoles = array_intersect($roles, $validRoles);


        if (in_array('writer', $filteredRoles) && in_array('covdes', $filteredRoles)) {
            $filteredRoles[] = 'wricov';
        }


        $userTypes = implode(',', array_unique($filteredRoles));

        if (empty($userTypes)) {
            die("Error: No valid roles selected.");
        }

        $notify_data = [
            'subject' => $subject,
            'message' => $description,
            'sentDate' => $datetime,
            'userTypes' => $userTypes
        ];


        $notification->insert($notify_data);

        header('location: /Free-Write/public/Mod/Dashboard');


    }

    public function siteLogs()
    {
        $this->checkLoggedUser();
        $sitelog = new SiteLog();
        $logs = null;
        $date = null;
        $whereParams = [];

        if (!empty($_GET['logid']))
            $whereParams['siteLogID'] = $_GET['logid'];

        if (!empty($_GET['userID']))
            $whereParams['user'] = $_GET['userID'];

        if (!empty($whereParams) && empty($_GET['logdate'])) {
            $logs = $sitelog->where($whereParams);

        }

        if (!empty($_GET['logdate'])) {
            $date = $_GET['logdate'];
            $logs = $sitelog->filterByDate($whereParams, $date);
        }

        if (empty($whereParams) && empty($logs)) {
            $logs = $sitelog->todayLogs();
        }

        $this->view('moderator/adminSiteLogs', $logs);
    }


    public function Users()
    {
        $this->checkLoggedUser();
        $userTable = new User();
        $users = $userTable->getNormalUsers();

        $this->view('moderator/modUserManagement', ['users' => $users]);
    }


    public function Search()
    {
        $this->checkLoggedUser();
        $user = new User();
        $userDetails = new UserDetails();

        $criteria = '';
        if (isset($_GET['filter'])) {
            $criteria = $_GET['filter'];
        } else if (isset($_POST['searchCriteria'])) {
            $criteria = $_POST['searchCriteria'];
        } else {
            header('location: /Free-Write/public/Mod/Users');
        }


        $input = '';
        if (isset($_POST['searchInput'])) {
            $input = $_POST['searchInput'];
        } else if (isset($_GET['user'])) {
            $input = $_GET['user'];
        } else {

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
            case 'premium':
                $data = $user->WHERE(['isPremium' => 1]);
                break;
            case 'normal':
                $data = $user->WHERE(['isPremium' => 0]);
                break;

            case 'reader':
                $data = $user->WHERE(['userType' => "reader"]);
                break;
            case 'writer':
                $data = $user->WHERE(['userType' => "writer"]);
                break;
            case 'covdes':
                $data = $user->WHERE(['userType' => "covdes"]);
                break;
            case 'wricov':
                $data = $user->WHERE(['userType' => "wricov"]);
                break;
            case 'pub':
                $data = $user->WHERE(['userType' => "pub"]);
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
        $this->checkLoggedUser();

        if (!isset($_POST['deleteConfirmText']) || $_POST['deleteConfirmText'] !== "DELETE THIS USER") {

            $_SESSION['error'] = 'Delete confirmation text was incorrect';
            header('location: /Free-Write/public/Mod/Users');
            exit();
        }


        if (!isset($_POST['userId'])) {
            $_SESSION['error'] = 'No user ID provided';
            header('location: /Free-Write/public/Mod/Users');
            exit();
        }

        $userId = $_POST['userId'];


        $user = new User();
        $userDetails = new UserDetails();

        $userTableData = $user->first(['userID' => $userId]);

        try {

            $user->update($userId, ['isActivated' => 9, 'password' => "", 'email' => $userTableData['email'] . "-deleted"], 'userID');
            $userDetails->delete($userId, 'user');


            $modlog = new ModLog();
            $ModLogActivity = sprintf(
                'Mod: %s deleted USER: %s (Email: %s)',
                $_SESSION['user_name'],
                $userId,
                $userData['email'] ?? 'unknown'


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
        $this->checkLoggedUser();

        $user = new User();
        $userDetails = new UserDetails();


        if (!isset($_POST['userId'])) {
            $_SESSION['error'] = 'No user ID provided';
            header('location: /Free-Write/public/Mod/Users');
            exit();
        }

        $userId = $_POST['userId'];

        if (!isset($_POST['userType'])) {
            $_SESSION['error'] = 'No user type provided';
            header('location: /Free-Write/public/Mod/Users');
            exit();
        }

        if (!isset($_POST['loginAttempts'])) {
            $_SESSION['error'] = 'No login attempts provided';
            header('location: /Free-Write/public/Mod/Users');
            exit();
        }

        if (!isset($_POST['premium'])) {
            $_SESSION['error'] = 'No premium status provided';
            header('location: /Free-Write/public/Mod/Users');
            exit();
        }

        if (!isset($_POST['activated'])) {
            $_SESSION['error'] = 'No activation status provided';
            header('location: /Free-Write/public/Mod/Users');
            exit();
        }

        if (!isset($_POST['firstName'])) {
            $_SESSION['error'] = 'No first name provided';
            header('location: /Free-Write/public/Mod/Users');
            exit();
        }

        if (!isset($_POST['lastName'])) {
            $_SESSION['error'] = 'No last name provided';
            header('location: /Free-Write/public/Mod/Users');
            exit();
        }

        if (!isset($_POST['country'])) {
            $_SESSION['error'] = 'No country provided';
            header('location: /Free-Write/public/Mod/Users');
            exit();
        }

        if (!isset($_POST['dob'])) {
            $_SESSION['error'] = 'No date of birth provided';
            header('location: /Free-Write/public/Mod/Users');
            exit();
        }

        if (!isset($_POST['bio'])) {
            $_SESSION['error'] = 'No bio provided';
            header('location: /Free-Write/public/Mod/Users');
            exit();
        }


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


            $modlog = new ModLog();
            $ModLogActivity = sprintf(
                'Mod: %s updated USER: %s (Email: %s)',
                $_SESSION['user_name'],
                $userId,
                $_POST['email'] ?? 'unknown'
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


    public function Institutes()
    {
        $this->checkLoggedUser();
        $userTable = new User();
        $insts = $userTable->where(['userType' => 'inst']);


        $this->view('moderator/modInstituteManagement', ['insts' => $insts]);
    }


    public function Reports()
    {
        $this->checkLoggedUser();

        $reportTable = new Report();
        $reports = null;

        if (isset($_GET['filter']) && $_GET['filter'] == 'unhandled') {
            $reports = $reportTable->where(['status' => 'Pending']);
            $unfinishedReports = $reportTable->where(['status' => 'Unfinished']);


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
        $this->checkLoggedUser();
        error_log("Handling report");
        echo "<script>console.log('Handling report - Function reached');</script>";


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


        if (($reportStatus == 'handled' || $reportStatus == 'Escalated') && $modResponse == '') {
            echo "<script>console.log(Please provide a response to the report)</script>";
            return;
        }

        if ($reportID == '' || $reportStatus == '') {
            echo "<script>console.log(please refresh the site)</script>";
            return;
        }


        $reportTable->update($reportID, ['status' => $reportStatus, 'modResponse' => $modResponse, 'handler' => $_SESSION['user_id']], 'reportID');


        $modlog = new ModLog();
        $ModLogActivity = 'Accessed REPORT: ' . $reportID . ' status changed from: ' . $reportOldStatus . ' to: ' . $reportStatus;

        $modlog->insert(['mod' => $_SESSION['user_id'], 'activity' => $ModLogActivity, 'occurrence' => date('Y-m-d H:i:s')]);

        header('location: /Free-Write/public/Mod/Reports');
        exit();
    }


    public function Feedbacks()
    {
        $this->checkLoggedUser();

        $feedbackTable = new Feedback();
        $feedbacks = null;

        if (isset($_GET['filter']) && $_GET['filter'] == 'unhandled') {
            $feedbacks = $feedbackTable->where(['status' => 'Pending']);
            $unfinishedfeedbacks = $feedbackTable->where(['status' => 'Unfinished']);


            $feedbacks = array_merge($feedbacks, $unfinishedfeedbacks);
        } elseif (isset($_GET['filter']) && $_GET['filter'] == 'unread') {
            $feedbacks = $feedbackTable->where(['status' => 'unread']);
        } elseif (isset($_GET['filter']) && $_GET['filter'] == 'read') {
            $feedbacks = $feedbackTable->where(['status' => 'read']);
        } else {
            $feedbacks = $feedbackTable->findAll();
        }

        $this->view('moderator/FeedbackHandlePage', ['feedbacks' => $feedbacks]);
    }

    public function HandleFeedback()
    {
        $this->checkLoggedUser();

        $feedbackTable = new Feedback();
        $action = $_POST['Feedbackstatus'] ?? 'unread';
        $fid = $_POST['FeedbackID'] ?? null;

        switch ($action) {
            case 'read':
                $feedbackTable->update($fid, ['isRead' => 1], "feedbackID");
                break;
            case 'unread':
                $feedbackTable->update($fid, ['isRead' => 0], "feedbackID");
                break;
        }

        header('location: /Free-Write/public/Mod/Feedbacks');
        exit();
    }


    public function AddCourier()
    {

        $userTable = new User();
        $users = $userTable->where(['userType' => 'Courier']);

        $this->view('moderator/modAddCourier', ['users' => $users]);
    }


    public function CouSearch()
    {
        $this->checkLoggedUser();
        $user = new User();
        $userDetails = new UserDetails();

        $criteria = '';
        if (isset($_GET['filter'])) {
            $criteria = $_GET['filter'];


            if (is_int((int) $criteria)) {
                $criteria = 'id';

            }
        } else if (isset($_POST['searchCriteria'])) {
            $criteria = $_POST['searchCriteria'];
        } else {
            header('location: /Free-Write/public/Mod/AddCourier');
        }


        $input = '';
        if (isset($_POST['searchInput'])) {
            $input = $_POST['searchInput'];
        } else if (isset($_GET['filter'])) {
            $input = $_GET['filter'];
        } else {

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
                header('location: /Free-Write/public/Mod/AddCourier');
        }

        if (sizeof($data) == 1) {
            $userDetails = $userDetails->WHERE(['user' => $data[0]['userID']]);
            $this->view('moderator/modAddCourier', ['users' => $data, 'userDetails' => $userDetails]);
        } else {
            $this->view('moderator/modAddCourier', ['users' => $data]);
        }
    }


    public function AddMod()
    {

        if (isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'admin') {
            $this->index();
            return;
        }

        $userTable = new User();
        $users = $userTable->where(['userType' => 'mod']);

        $this->view('moderator/modAddMod', ['users' => $users]);
    }


    public function ModSearch()
    {
        $this->checkLoggedUser();
        $user = new User();
        $userDetails = new UserDetails();

        $criteria = '';
        if (isset($_GET['filter'])) {
            $criteria = $_GET['filter'];


            if (is_int((int) $criteria)) {
                $criteria = 'id';
            }
        } else if (isset($_POST['searchCriteria'])) {
            $criteria = $_POST['searchCriteria'];
        } else {
            header('location: /Free-Write/public/Mod/AddMod');
        }


        $input = '';
        if (isset($_POST['searchInput'])) {
            $input = $_POST['searchInput'];
        } else if (isset($_GET['filter'])) {
            $input = $_GET['filter'];
        } else {

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
                header('location: /Free-Write/public/Mod/AddMod');
        }

        if (sizeof($data) == 1) {
            $userDetails = $userDetails->WHERE(['user' => $data[0]['userID']]);
            $this->view('moderator/modAddMod', ['users' => $data, 'userDetails' => $userDetails]);
        } else {
            $this->view('moderator/modAddMod', ['users' => $data]);
        }
    }


    public function GenerateReport()
    {
        $data = [];

        $startDate = $_POST['startDate'] ?? null;
        $endDate = $_POST['endDate'] ?? null;
        $today = date('Y-m-d');

        if ($endDate !== null && strtotime($endDate) > time()) {
            $endDate = $today;
        }


        $user = new User();

        $feedback = new Feedback();
        $report = new Report();

        $buybook = new BuyBook();
        $buychapter = new BuyChapter();

        $book = new Book();
        $spinoff = new Spinoff();
        $coverImage = new CoverImage();
        $competition = new Competition();

        $UserSubscription = new UserSubscription();



        $userTypeCounts = $user->getUserTypeCounts();
        $INRANGE_feedbacks = $feedback->getDetailsInDateRange($startDate, $endDate);
        $INRANGE_reports = $report->getDetailsInDateRange($startDate, $endDate);

        $INRANGE_buybooks = $buybook->getDetailsInDateRange($startDate, $endDate);
        $INRANGE_buychapters = $buychapter->getDetailsInDateRange($startDate, $endDate);

        $INRANGE_book = $book->getDetailsInDateRange($startDate, $endDate);
        $INRANGE_spinoff = $spinoff->getDetailsInDateRange($startDate, $endDate);
        $INRANGE_coverImage = $coverImage->getDetailsInDateRange($startDate, $endDate);
        $INRANGE_competition = $competition->getDetailsInDateRange($startDate, $endDate);


        $feedbackCount = count($INRANGE_feedbacks);


        $totalReports = count($INRANGE_reports);
        $handledReports = 0;
        $escalatedReports = 0;

        foreach ($INRANGE_reports as $report) {
            if ($report['status'] === 'handled') {
                $handledReports++;
            } elseif ($report['status'] === 'escalated') {
                $escalatedReports++;
            }
        }


        $totalBookSales = 0;
        foreach ($INRANGE_buybooks as $purchase) {
            $totalBookSales += $purchase['price'];
        }

        $totalChapterSales = 0;
        foreach ($INRANGE_buychapters as $purchase) {
            $totalChapterSales += $purchase['price'];
        }


        $total_subs = $UserSubscription->getMonthlySubscriptionSummary($startDate, $endDate);


        $booksCreated = count($INRANGE_book);
        $spinoffsCreated = count($INRANGE_spinoff);
        $coversCreated = count($INRANGE_coverImage);
        $competitionsCreated = count($INRANGE_competition);


        $totalviews = $book->totalViewsAndAverage();

        $data = [
            'startDate' => $startDate,
            'endDate' => $endDate,
            'today' => $today,
            'userTypeCounts' => $userTypeCounts,
            'feedbackCount' => $feedbackCount,
            'totalReports' => $totalReports,
            'handledReports' => $handledReports,
            'escalatedReports' => $escalatedReports,
            'totalBookSales' => $totalBookSales,
            'totalChapterSales' => $totalChapterSales,
            'totalSubs' => $total_subs,
            'booksCreated' => $booksCreated,
            'spinoffsCreated' => $spinoffsCreated,
            'coversCreated' => $coversCreated,
            'competitionsCreated' => $competitionsCreated,
            'totalViewDetails' => $totalviews,

        ];

        $this->view('moderator/adminGenerateReport', $data);
    }
}