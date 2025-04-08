<?php

class UserController extends Controller
{
    public function index()
    {
        //echo "this is the User Controller\n";
        $URL = splitURL();

        $this->view('login');

    }

    public function Profile()
    {

        if (isset($_SESSION['user_id']))
            if (isset($_GET['user']) && $_GET['user'] == $_SESSION['user_id'])
                header('Location: /Free-Write/public/User/Profile'); //to avoid user to see his own public view profile.

        $uid = isset($_GET['user']) ? $_GET['user'] : $_SESSION['user_id'];

        $publisherBook_table = new publisherBooks();
        $bookDetails = $publisherBook_table->where(['publisherID' => $_SESSION['user_id']]);

        //echo "inside the userProfile function\n";
        $user = new User();
        $userDetailsTable = new UserDetails();
        $Booklist = new BookList(); //List Table
        $spinoff = new Spinoff(); //get my spinoffs
        $follow = new Follow(); //get my followers
        $BuyBook = new BuyBook();
        $bookGenre = new BookGenre();
        $collection = new Collection();

        $userDetails = $userDetailsTable->first(['user' => $uid]);//getUserDetails($uid);
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
                'purchasedBooks' => $myboughtBooks,
                'genreFrequency' => $genreFrequency,
                'collections' => $getUserCollections,
                'bookDetails' => $bookDetails
            ]
        );
    }

    public function editProfile()
    {
        $uid = $_SESSION['user_id'];
        $user = new User();
        $userDetailsTable = new UserDetails();

        // Validate email
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            // Handle invalid email error
            die('Invalid email format.');
        }

        $data = [
            'email' => $_POST['email']
        ];

        $user->update($uid, $data, 'userID');

        // Validate first name
        if (!preg_match('/^[a-zA-Z_ ]{1,45}$/', $_POST['firstName'])) {
            die('First name must contain only letters, spaces, or underscores and be 45 characters or less.');
        }

        // Validate last name
        if (!preg_match('/^[a-zA-Z_ ]{1,45}$/', $_POST['lastName'])) {
            die('Last name must contain only letters, spaces, or underscores and be 45 characters or less.');
        }

        // Validate date of birth
        $dob = $_POST['dob'];
        if ($dob) {
            $dobDate = DateTime::createFromFormat('Y-m-d', $dob);
            if ($dobDate === false || $dobDate > (new DateTime())->modify('-13 years')) {
                // Handle invalid date of birth error
                die('You must be at least 13 years old.');
            }
        }

        // Validate bio
        if (strlen($_POST['bio']) > 255) {
            // Handle invalid bio error
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

        // Handle profile image upload
        if (isset($_FILES['profileImage']) && $_FILES['profileImage']['error'] == UPLOAD_ERR_OK) {
            $profileImage = $_FILES['profileImage'];

            // Get the file extension
            $fileExtension = pathinfo($profileImage['name'], PATHINFO_EXTENSION);

            // Generate a new filename
            $dateTime = date('Y-m-d_H-i-s'); // Format: YYYY-MM-DD_HH-MM-SS
            $newFileName = "PROFILE_{$uid}_{$dateTime}.{$fileExtension}";

            // Define the target directory
            $targetDirectory = 'C:/xampp/htdocs/Free-Write/app/images/profile/';

            // Move the uploaded file to the target directory with the new name
            if (move_uploaded_file($profileImage['tmp_name'], $targetDirectory . $newFileName)) {
                // File uploaded successfully
                $data['profileImage'] = $newFileName;
            } else {
                // Handle file upload error
                die('Failed to move uploaded file.');
            }
        } else {
            // No file uploaded or an error occurred, set the variable to null
            //$newFileName = null; //by default the #$data at abouve regarding profile image is set to null
        }

        $userDetailsTable->update($uid, $data, 'user');

        header('Location: /Free-Write/public/User/Profile');
    }

    public function DeleteProfile()
    {
        $uid = $_SESSION['user_id'];
        $user = new User();
        $userDetailsTable = new UserDetails();

        $userTableData = $user->first(['userID' => $uid]);
        $userDetailsTableData = $userDetailsTable->first(['user' => $uid]);

        //deleting the data from the user and userdetails table
        $userDetailsTable->delete($uid, 'user');
        $user->delete($uid, 'userID');
        //this will activate the trigger to archive the data

        session_destroy();
        header('Location: /Free-Write/public/User/Login');
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
        // Initialize an array to hold error messages
        $errors = [];

        // Validate email
        if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Please enter a valid email address.";
        }

        // Validate selectReason
        if (empty($_POST['selectReason'])) {
            $errors[] = "Please select a reason.";
        }

        // Validate description
        if (empty($_POST['description']) || strlen($_POST['description']) > 600) {
            $errors[] = "Description is required and cannot exceed 600 characters.";
        }

        // If there are validation errors, handle them
        if (!empty($errors)) {
            // You can either redirect back with errors or display them
            // For example, redirecting back with error messages in the session
            session_start();
            $_SESSION['errors'] = $errors;
            header('Location: /Free-Write/public/User/Profile?user=' . $_GET['user']);
            exit; // Make sure to exit after header redirection
        }

        // If validation passes, proceed to insert the report
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

        // Redirect to the profile page after successful submission
        header('Location: /Free-Write/public/User/Profile?user=' . $_POST['reportedUserID']);
        exit; // Make sure to exit after header redirection
    }

    public function NewCollection()
    {
        $this->view('Profile/createCollection');
    }

    public function CreateCollection()
    {
        // Initialize an array to hold error messages
        $errors = [];

        // Validate title
        if (empty($_POST['title'])) {
            $errors['title'] = "Title is required";
        } elseif (strlen($_POST['title']) < 3) {
            $errors['title'] = "Title must be at least 3 characters long";
        } elseif (strlen($_POST['title']) > 100) {
            $errors['title'] = "Title must be less than 100 characters";
        }

        // Validate description
        if (empty($_POST['Collect_description'])) {
            $errors['description'] = "Description is required";
        } elseif (strlen($_POST['Collect_description']) < 10) {
            $errors['description'] = "Description must be at least 10 characters long";
        } elseif (strlen($_POST['Collect_description']) > 500) {
            $errors['description'] = "Description must be less than 500 characters";
        }

        // Check if there are any validation errors
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            header('Location: /Free-Write/public/User/Profile');
            exit;
        }

        // If validation passes, proceed to insert the collection
        $collection = new Collection();
        $data = [
            'title' => $_POST['title'],
            'user' => $_SESSION['user_id'],
            'description' => $_POST['Collect_description'],
            'isPublic' => $_POST['visibility'],
        ];

        $collection->insert($data);

        // Redirect to the user's profile after successful creation
        header('Location: /Free-Write/public/User/Profile');
        exit;
    }
}