<?php

class UserController extends Controller
{
    public function index()
    {

        $URL = splitURL();

        $this->view('login');

    }

    public function Profile()
    {
        if (isset($_SESSION['user_id'])) {
            if (isset($_GET['user']) && $_GET['user'] == $_SESSION['user_id'])
                header('Location: /Free-Write/public/User/Profile');
        } else {
            header('Location: /Free-Write/public/Login');
        }
        $uid = isset($_GET['user']) ? $_GET['user'] : $_SESSION['user_id'];


        $user = new User();
        $userDetailsTable = new UserDetails();
        $Booklist = new BookList();
        $spinoff = new Spinoff();
        $follow = new Follow();
        $BuyBook = new BuyBook();
        $bookGenre = new BookGenre();
        $collection = new Collection();
        $orderTable = new Order();
        $publisherTable = new Publisher();
        $advertisement_table = new Advertisement();
        $publisherBook_table = new publisherBooks();

        $bookDetails = null;
        $advertisements = null;
        $orders = null;
        $publisher = null;

        if (isset($_SESSION['user_id'])) {
            $bookDetails = $publisherBook_table->where(['publisherID' => $_SESSION['user_id']]);
            $advertisements = $advertisement_table->where(['pubID' => $_SESSION['user_id']]);
            $orders = $orderTable->where(['customer_userID' => $_SESSION['user_id']]);
            $publisher = $publisherTable->first(['pubID' => $_SESSION['user_id']]);
        }

        $activatingID = $advertisement_table->getAdIDwithinCurrentDateRange();
        if (!empty($activatingID)) {
            $adID = $activatingID[0]['adID'];
            $advertisement_table->update($adID, ['status' => 'active'], 'adID');
        }

        $expiredAds = $advertisement_table->getAdIDExpired();
        if (!empty($expiredAds) && isset($expiredAds[0]) && isset($expiredAds[0]['adID'])) {
            $expiredAdID = $expiredAds[0]['adID'];
            $updateData = [
                'status' => 'expired',
            ];
            $advertisement_table->update($expiredAdID, $updateData, 'adID');
        }


        $userDetails = $userDetailsTable->first(['user' => $uid]);
        $list = $Booklist->getBookListCount($uid);
        $userAcc = $user->first(['userID' => $uid]);
        $myspinoffs = $spinoff->getUserSpinoff($uid);
        $myfollowers = $follow->getFollowCount($uid);
        $myboughtBooks = $BuyBook->getBoughtBooks($uid);
        $genreFrequency = $bookGenre->getGenreFrequency($uid);
        $getUserCollections = $collection->getUserCollections($uid);

        $isFollowing = null;
        if (isset($_SESSION['user_id']))
            $isFollowing = $follow->first(['FollowedID' => $uid, 'FollowerID' => $_SESSION['user_id']]);

        $followingList = $follow->getUserDetails(['FollowerID' => $uid]);
        $followedByList = $follow->getUserDetails(['FollowedID' => $uid]);


        $quotationData = [];
        if ($_SESSION['user_type'] == 'pub') {
            $quotationData = $this->getQuotation4Pub();
        } elseif ($_SESSION['user_type'] == 'writer') {
            $quotationData = $this->getQuotation4Wri();
        }

        $cartItems = [];
        if (isset($_SESSION['user_id'])) {
            $cartTable = new Cart();
            $cartItems = $cartTable->getCartItems($_SESSION['user_id']);
        }

        $this->view(
            'Profile/userProfile',
            [
                'userAccount' => $userAcc,
                'userDetails' => $userDetails,
                'listCounts' => $list,
                'spinoffs' => $myspinoffs,
                'follows' => $myfollowers,
                'isFollowing' => $isFollowing,
                'followingList' => $followingList,
                'followedByList' => $followedByList,
                'orders' => $orders,
                'purchasedBooks' => $myboughtBooks,
                'genreFrequency' => $genreFrequency,
                'collections' => $getUserCollections,
                'bookDetails' => $bookDetails,
                'publisher' => $publisher,
                'advertisements' => $advertisements,
                'quotationData' => $quotationData,
                'cartItems' => $cartItems,
            ]
        );
    }

    public function editProfile()
    {
        $uid = $_SESSION['user_id'];
        $user = new User();
        $userDetailsTable = new UserDetails();


        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {

            die('Invalid email format.');
        }

        $data = [
            'email' => $_POST['email']
        ];

        $user->update($uid, $data, 'userID');


        if (!preg_match('/^[a-zA-Z_ ]{1,45}$/', $_POST['firstName'])) {
            die('First name must contain only letters, spaces, or underscores and be 45 characters or less.');
        }


        if (!preg_match('/^[a-zA-Z_ ]{1,45}$/', $_POST['lastName'])) {
            die('Last name must contain only letters, spaces, or underscores and be 45 characters or less.');
        }


        $dob = $_POST['dob'];
        if ($dob) {
            $dobDate = DateTime::createFromFormat('Y-m-d', $dob);
            if ($dobDate === false || $dobDate > (new DateTime())->modify('-13 years')) {

                die('You must be at least 13 years old.');
            }
        }


        if (strlen($_POST['bio']) > 255) {

            die('Bio must be 255 characters or less.');
        }

        $country = $_POST['country'];
        if ($country == '')
            $country = null;


        $data = [
            'firstName' => $_POST['firstName'],
            'lastName' => $_POST['lastName'],
            'dob' => $dob,
            'country' => $_POST['country'],
            'bio' => $_POST['bio'],
            'profileImage' => null
        ];


        if (isset($_FILES['profileImage']) && $_FILES['profileImage']['error'] == UPLOAD_ERR_OK) {
            $profileImage = $_FILES['profileImage'];


            $fileExtension = pathinfo($profileImage['name'], PATHINFO_EXTENSION);


            $dateTime = date('Y-m-d_H-i-s');
            $newFileName = "PROFILE_{$uid}_{$dateTime}.{$fileExtension}";


            $targetDirectory = 'C:/xampp/htdocs/Free-Write/app/images/profile/';


            if (move_uploaded_file($profileImage['tmp_name'], $targetDirectory . $newFileName)) {

                $data['profileImage'] = $newFileName;
            } else {

                die('Failed to move uploaded file.');
            }
        } else {


        }

        $userDetailsTable->update($uid, $data, 'user');

        header('Location: /Free-Write/public/User/Profile');
    }

    public function DeleteUser()
    {
        $uid = $_SESSION['user_id'];
        $pw = $_POST['deleteConfirmText'];
        $user = new User();

        $userTableData = $user->first(['userID' => $uid]);

        if (password_verify($pw, $userTableData['password'])) {


            $user->update($uid, ['isActivated' => 9, 'password' => "", 'email' => $userTableData['email'] . "-deleted"], 'userID');


            session_destroy();
            header('Location: /Free-Write/public/Home');
            exit;
        } else {
            echo json_encode(['status' => 0, 'msg' => 'Account Not Deleted - Incorrect Password']);
        }

        header('Location: /Free-Write/public/User/Profile');
    }

    public function followUser()
    {
        $follow = new Follow();
        $follow->insert(['FollowerID' => $_SESSION['user_id'], 'FollowedID' => $_GET['user']]);
        header('Location: /Free-Write/public/User/Profile?user=' . $_GET['user']);
    }
    public function unfollowUser()
    {
        $follow = new Follow();
        $follow->unfollow(['followerID' => $_SESSION['user_id'], 'followedID' => $_GET['user']]);
        header('Location: /Free-Write/public/User/Profile?user=' . $_GET['user']);
    }

    public function ReportProfile()
    {

        $errors = [];


        if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Please enter a valid email address.";
        }


        if (empty($_POST['selectReason'])) {
            $errors[] = "Please select a reason.";
        }


        if (empty($_POST['description']) || strlen($_POST['description']) > 600) {
            $errors[] = "Description is required and cannot exceed 600 characters.";
        }


        if (!empty($errors)) {
            session_start();
            $_SESSION['errors'] = $errors;
            header('Location: /Free-Write/public/User/Profile?user=' . $_GET['user']);
            exit;
        }


        $report = new Report();
        $data = [
            "email" => $_POST['email'],
            "type" => "User  with ID=" . $_POST['reportedUserID'] . " | " . $_POST['selectReason'],
            "description" => $_POST['description'],
            "submitTime" => date('Y-m-d H:i:s'),
            "handler" => null,
            "status" => "Pending"
        ];
        $report->insert($data);


        header('Location: /Free-Write/public/User/Profile?user=' . $_POST['reportedUserID']);
        exit;
    }

    public function NewCollection()
    {
        $this->view('Profile/createCollection');
    }

    public function CreateCollection()
    {

        $errors = [];


        if (empty($_POST['title'])) {
            $errors['title'] = "Title is required";
        } elseif (strlen($_POST['title']) < 3) {
            $errors['title'] = "Title must be at least 3 characters long";
        } elseif (strlen($_POST['title']) > 100) {
            $errors['title'] = "Title must be less than 100 characters";
        }


        if (empty($_POST['Collect_description'])) {
            $errors['description'] = "Description is required";
        } elseif (strlen($_POST['Collect_description']) < 10) {
            $errors['description'] = "Description must be at least 10 characters long";
        } elseif (strlen($_POST['Collect_description']) > 500) {
            $errors['description'] = "Description must be less than 500 characters";
        }


        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            header('Location: /Free-Write/public/User/Profile');
            exit;
        }


        $collection = new Collection();
        $data = [
            'title' => $_POST['title'],
            'user' => $_SESSION['user_id'],
            'description' => $_POST['Collect_description'],
            'isPublic' => $_POST['visibility'],
        ];

        $collection->insert($data);


        header('Location: /Free-Write/public/User/Profile');
        exit;
    }

    public function Notifications()
    {
        if (isset($_SESSION["user_id"])) {
            $userNotification = new UserNotification();
            $allNotifications = $userNotification->getAllNotifications($_SESSION['user_id']);

            $this->view('Profile/MyNotifications', ['notifications' => $allNotifications]);
        } else {
            header('Location: /Free-Write/public/User/Login');
            exit;
        }
    }

    public function MarkAllRead()
    {
        if (empty($_SESSION['user_id'])) {
            header('Location: /Free-Write/public/User/Login');
            exit;
        }
        $un = new UserNotification();

        $un->update($_SESSION['user_id'], ['isRead' => 1, 'isReadDate' => date('Y-m-d H:i:s')], 'user');

        return;
    }


    public function uploadFirstDesign()
    {
        $userID = $_SESSION['user_id'];
        $user = new User();


        $user->updateUserTypeToCovdes($userID);


        $_SESSION['user type'] = 'covdes';


        header('Location: /Free-Write/public/Designer/new');


        exit;
    }



    public function getQuotation4Pub()
    {
        $quotationDetails = new Quotation();

        $userId = $_SESSION['user_id'];
        $quotations = $quotationDetails->where(['publisher' => $userId]);


        $quotationData = [];
        foreach ($quotations as $q) {

            $writer = new UserDetails();
            $writerDetails = $writer->first(['user' => $q['writer']]);

            if ($writerDetails) {
                $writerName = $writerDetails['firstName'] . ' ' . $writerDetails['lastName'];


                $messages = [];
                if (!empty($q['message'])) {
                    $lines = explode("\n", $q['message']);
                    foreach ($lines as $line) {
                        if (empty(trim($line)))
                            continue;


                        if (preg_match('/\[(.*?) - (.*?)\] (.*)/', $line, $matches)) {
                            $timestamp = $matches[1];
                            $senderType = strtolower($matches[2]);
                            $content = $matches[3];

                            $messages[] = [
                                'timestamp' => $timestamp,
                                'sender_type' => $senderType,
                                'sender_name' => $senderType == 'publisher' ? 'You' : $writerName,
                                'text' => $content
                            ];
                        }
                    }
                }

                $quotationData[] = [
                    'writerId' => $q['writer'],
                    'writerName' => $writerName,
                    'messages' => $messages
                ];
            }
        }


        return $quotationData;
    }

    public function getQuotation4Wri()
    {
        $quotationDetails = new Quotation();

        $userId = $_SESSION['user_id'];
        $quotations = $quotationDetails->where(['writer' => $userId]);

        $quotationData = [];
        foreach ($quotations as $q) {

            $publisher = new Publisher();
            $publisherDetails = $publisher->first(['pubID' => $q['publisher']]);

            if ($publisherDetails) {
                $publisherName = $publisherDetails['name'] ?? 'Publisher';


                $messages = [];
                if (!empty($q['message'])) {
                    $lines = explode("\n", $q['message']);
                    foreach ($lines as $line) {
                        if (empty(trim($line)))
                            continue;


                        if (preg_match('/\[(.*?) - (.*?)\] (.*)/', $line, $matches)) {
                            $timestamp = $matches[1];
                            $senderType = strtolower($matches[2]);
                            $content = $matches[3];

                            $messages[] = [
                                'timestamp' => $timestamp,
                                'sender_type' => $senderType,
                                'sender_name' => $senderType == 'writer' ? 'You' : $publisherName,
                                'text' => $content
                            ];
                        }
                    }
                }

                $quotationData[] = [
                    'publisherId' => $q['publisher'],
                    'publisherName' => $publisherName,
                    'messages' => $messages
                ];
            }
        }

        return $quotationData;
    }
}