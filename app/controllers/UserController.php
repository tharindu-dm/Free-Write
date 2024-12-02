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
        $uid = $_SESSION['user_id'];
        //echo "inside the userProfile function\n";
        $user = new User();
        $userDetailsTable = new UserDetails();
        $Booklist = new BookList(); //List Table
        $spinoff = new Spinoff(); //get my spinoffs

        $userDetails = $userDetailsTable->first(['user' => $uid]);//getUserDetails($uid);
        $list = $Booklist->getBookListCount($uid);
        $userAcc = $user->first(['userID' => $uid]);
        $myspinoffs = $spinoff->getUserSpinoff($uid);

        $this->view('Profile/userProfile', ['userAccount' => $userAcc, 'userDetails' => $userDetails, 'listCounts' => $list, 'spinoffs' => $myspinoffs]);
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
            $targetDirectory = 'D:/XAMPP/htdocs/Free-Write/app/images/profile/';

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

        /*$userDetailsTable->delete($uid, 'user');
        $user->delete($uid, 'userID');*/

        session_destroy();
        header('Location: /Free-Write/public/User/Login');
    }
}