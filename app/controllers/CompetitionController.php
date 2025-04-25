<?php

class CompetitionController extends Controller
{

    public function index()
    {
        $competition = new Competition();
        $competition_writer = null;
        $competition_cover = null;

        $competition_writer = $competition->getCompetitionDetails("writer");
        $competition_cover = $competition->getCompetitionDetails("covdes");

        $publisherTable = new Publisher();
        $publisherName = null;


        $data = [
            'writer' => $competition_writer,
            'covdes' => $competition_cover,
        ];

        $this->view('OpenUser/competitions', $data);
    }
    public function MyCompetitions()
    {

        $competition_table = new Competition();
        $competition_table->updateCompetitionStatus();
        $competitionDetails = $competition_table->where(['publisherID' => $_SESSION['user_id']]);


        $this->view('publisher/competitionDetails4Publisher', ['competitionDetails' => $competitionDetails]);
    }

    public function New()
    {
        $this->view('publisher/creatingnewcompetition');
    }

    public function CreateCompetition()
    {
        $title = $_POST['title'];
        $desc = $_POST['description'];
        $rules = $_POST['rules'];
        $firstPrize = $_POST['first_prize'];
        $secondPrize = $_POST['second_prize'];
        $thirdPrize = $_POST['third_prize'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $category = $_POST['category'];
        $status = 'active';
        $competitionID = $_POST['compID'];
        $competitionFor = $_POST['type'];
        $competition_table = new Competition();

        $image_path = null;
        if (isset($_FILES['competition_image']) && $_FILES['competition_image']['error'] == 0) {
            $upload_dir = '../app/images/competition/';
            $filename = time() . '_' . $_FILES['competition_image']['name'];
            $upload_path = $upload_dir . $filename;

            if (move_uploaded_file($_FILES['competition_image']['tmp_name'], $upload_path)) {
                $image_path = $filename;
            }
        }

        $competition_table->insert([
            'title' => $title,
            'description' => $desc,
            'rules' => $rules,
            'first_prize' => $firstPrize,
            'second_prize' => $secondPrize,
            'third_prize' => $thirdPrize,
            'status' => $status,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'category' => $category,
            'compImage' => $image_path,
            'type' => $competitionFor,
            'publisherID' => $_SESSION['user_id']
        ]);

        header('Location: /Free-Write/public/Competition/MyCompetitions');
    }

    public function Manage()
    {
        $URL = splitURL();
        $competitionID = $URL[2];        //model-method-id
        $competition_table = new Competition();        //creating the model and assiging to a variable 
        $competitionDetails = $competition_table->first(['competitionID' => $competitionID]);   //orange one is table name and blue one is the variable we created 
        // above one should be returned so put it into the arguement 
        $this->view('publisher/editingcompetitiondetails', ['competitionDetails' => $competitionDetails]);
    }

    public function editCompetition()
    {
        // Check if user is logged in
        if (!isset($_SESSION['user_id'])) {
            header('Location: /Free-Write/public/Login');
            exit;
        }

        // Get form data
        $title = $_POST['title'];
        $desc = $_POST['description'];
        $rules = $_POST['rules'];
        $firstPrize = $_POST['first_prize'];
        $secondPrize = $_POST['second_prize'];
        $thirdPrize = $_POST['third_prize'];
        $category = $_POST['category'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $competitionID = $_POST['compID'];
        $competitionType = $_POST['type'] ?? null;

        // Verify competition exists and belongs to this user
        $competition_table = new Competition();
        $existingCompetition = $competition_table->first(['competitionID' => $competitionID]);

        if (!$existingCompetition || $existingCompetition['publisherID'] != $_SESSION['user_id']) {
            $_SESSION['error'] = "You don't have permission to edit this competition";
            header('Location: /Free-Write/public/Competition/MyCompetitions');
            exit;
        }

        // Prepare update data
        $updateData = [
            'title' => $title,
            'description' => $desc,
            'rules' => $rules,
            'first_prize' => $firstPrize,
            'second_prize' => $secondPrize,
            'third_prize' => $thirdPrize,
            'category' => $category,
            'start_date' => $start_date,
            'end_date' => $end_date
        ];

        // Add competition type if provided
        if ($competitionType) {
            $updateData['type'] = $competitionType;
        }

        // Handle image upload if a new image is provided
        if (isset($_FILES['competition_image']) && $_FILES['competition_image']['error'] == 0) {
            $upload_dir = '../app/images/competition/';
            $filename = time() . '_' . $_FILES['competition_image']['name'];
            $upload_path = $upload_dir . $filename;

            if (move_uploaded_file($_FILES['competition_image']['tmp_name'], $upload_path)) {
                // Delete old image if it exists
                if (!empty($existingCompetition['compImage'])) {
                    $oldImagePath = $upload_dir . $existingCompetition['compImage'];
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }

                $updateData['compImage'] = $filename;
            }
        }

        // Update the competition
        $competition_table->update($competitionID, $updateData, 'competitionID');

        $_SESSION['success'] = "Competition updated successfully";
        header('Location: /Free-Write/public/Competition/MyCompetitions');
    }

    public function deleteCompetition()
    {
        $URL = splitURL();
        $competitionID = $_POST['compID'];
        $competition_table = new competition();
        $competitionEntries = new CompetitionEntries();
        $competitionEntries->delete($competitionID, 'competitionID');
        $competition_table->update($competitionID, ['status' => 'deleted'], 'competitionID');
          //ensure what are id and id column
        header('Location: /Free-Write/public/Competition/MyCompetitions');
    }

    public function Profile() //shows the publisher's POV for a competition
    {
        $URL = splitURL();
        $compID = $URL[2];        //model-method-id
        $competition_table = new Competition();        //creating the model and assiging to a variable 
        $competitionDetails = $competition_table->first(['competitionID' => $compID]);

        $this->view('publisher/aCompetitionProfile4Publisher', ['competitionDetails' => $competitionDetails]);
    }


    public function Completed()
    {
        $completedCompetition_table = new Competition();
        $completedCompetition_details = $completedCompetition_table->where(['status' => 'ended', 'publisherID' => $_SESSION['user_id']]);
        $this->view('publisher/completedCompetition', ['completedCompetition_details' => $completedCompetition_details]);
    }

    public function Active()
    {
        $activeCompetition_table = new Competition();
        $activeCompetition_details = $activeCompetition_table->where([
            'status' => 'active',
            'publisherID' => $_SESSION['user_id']
        ]);
        $this->view('publisher/activeCompetition', ['activeCompetition_details' => $activeCompetition_details]);
    }

    public function ViewStats()
    {
        $URL = splitURL();
        $compID = $URL[2];

        if (!$compID) {
            header('Location: /Free-Write/public/Competition/MyCompetitions');
            exit;
        }

        $competition_table = new Competition();
        $competitionDetails = $competition_table->first(['competitionID' => $compID]);
        $competition_entries_table = new CompetitionEntries();
        $competition_entries = $competition_entries_table->where(['competitionID' => $compID]);

        // Initialize an array to store all entry data
        $entriesData = [];

        // Check if we have any entries
        if (!empty($competition_entries)) {
            // Loop through each entry
            foreach ($competition_entries as $entry) {
                $user_details_table = new UserDetails();
                $user_details = $user_details_table->first(['user' => $entry['participantID']]);

                // Check if user details exist
                $participantName = '';
                if ($user_details) {
                    $participantName = $user_details['firstName'] . ' ' . $user_details['lastName'];
                }

                $book_table = new Book();
                $book = $book_table->first(['bookID' => $entry['bookID']]);

                // Check if book exists
                $bookTitle = '';
                if ($book) {
                    $bookTitle = $book['title'];
                }

                // Create entry data for this participant
                $entryData = [
                    'entryID' => $entry['entryID'],
                    'competitionID' => $compID,
                    'participantID' => $entry['participantID'],
                    'bookID' => $entry['bookID'],
                    'submissionDate' => $entry['submittedAt'], // Fixed: was using bookID
                    'status' => $entry['status'],
                    'participantName' => $participantName,
                    'bookTitle' => $bookTitle,
                ];

                // Add to our collection
                $entriesData[] = $entryData;
            }
        }



        if (!$competitionDetails) {
            header('Location: /Free-Write/public/Competition/MyCompetitions');
            exit;
        }

        $this->view('publisher/viewStats', [
            'compID' => $compID,
            'competition' => $competitionDetails,
            'entryData' => $entriesData
        ]);
    }

    public function Test()
    {
        $this->view('publisher/bookUploadForm4Publishers');
    }

    public function WriterCompetition()
    {
        $competiion = new Competition();
        $compID = $_GET['compID'] ?? null;
        $compDetails = null;
        $competitionEntries = new CompetitionEntries();
        $competition = null;
        if (isset($_SESSION['user_id'])) {
            $competition = $competitionEntries->first(['competitionID' => $compID, 'participantID' => $_SESSION['user_id']]);
        }

        if ($compID != null) {
            $compDetails = $competiion->first(['competitionID' => $compID]);
        }
        $userTable = new User();
        if (isset($_SESSION['user_id'])) {
            $user = $userTable->first(['userID' => $_SESSION['user_id']]);
        } else {
            $user = null;
        }

        $data = [
            'details' => $compDetails,
            'user' => $user,
            'competitionEntries' => $competition
        ];
        $this->view('publisher/aCompetitionProfile4users', $data);
    }

    public function CoverCompetition()
    {
        $competiion = new Competition();
        $compID = $_GET['compID'] ?? null;
        $compDetails = null;

        if ($compID != null) {
            $compDetails = $competiion->first(['competitionID' => $compID]);
        }
        $userTable = new User();
        if (isset($_SESSION['user_id'])) {
            $user = $userTable->first(['userID' => $_SESSION['user_id']]);
        } else {
            $user = null;
        }

        $data = [
            'details' => $compDetails,
            'user' => $user
        ];
        $this->view('publisher/aCompetitionProfile4users', $data);
    }
    public function Enter()
    {
        $url = splitURL();
        $compID = $url[2];
        $competition_table = new Competition();
        $competitionDetails = $competition_table->first(['competitionID' => $compID]);
        $book = new Book();
        $author = $_SESSION['user_id'];
        $MyBooks = null;

        if ($competitionDetails['type'] == 'writer') {
            $MyBooks = $book->getBook4Competition($author);
            $this->view('publisher/submission4Competition', [
                'books' => $MyBooks,
                'competition' => $competitionDetails
            ]);
        } else {
            $this->view('CoverPageDesigner/competitionSubmissionForm', [
                'competition' => $competitionDetails
            ]);
        }
    }

    public function SubmitEntry()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /Free-Write/public/Login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /Free-Write/public/Competition');
            exit;
        }

        $competitionID = $_POST['competition_id'] ?? null;
        $title = $_POST['title'] ?? '';
        $description = $_POST['description'] ?? '';
        $selectedItemID = $_POST['selected_item_id'] ?? null;
        $type = $_POST['type'] ?? null;

        $competition = new Competition();
        $competitionDetails = $competition->first(['competitionID' => $competitionID]);

        if (!$competitionDetails) {
            $_SESSION['error_message'] = "Competition not found";
            header('Location: /Free-Write/public/Competition');
            exit;
        }

        if ($competitionDetails['status'] !== 'active') {
            $_SESSION['error_message'] = "This competition is no longer accepting entries";
            header('Location: /Free-Write/public/Competition');
            exit;
        }

        $submission = new CompetitionEntries();
        $existingSubmission = $submission->first([
            'competitionID' => $competitionID,
            'participantID' => $_SESSION['user_id']
        ]);

        if ($existingSubmission) {
            $_SESSION['error_message'] = "You have already submitted an entry for this competition";
            header('Location: /Free-Write/public/Competition');
            exit;
        }

        $submissionData = [
            'competitionID' => $competitionID,
            'participantID' => $_SESSION['user_id'],
            'entryTitle' => $title,
            'entryDescription' => $description,
            'submittedAt' => date('Y-m-d H:i:s'),
            'status' => 'submitted',
            'type' => $type,

        ];


        if ($competitionDetails['type'] == 'writer') {
            $submissionData['bookID'] = $selectedItemID;
        } elseif ($competitionDetails['type'] == 'CoverDesigners') {
            $submissionData['coverID'] = $selectedItemID;
        }
        $submission->insert($submissionData);

        $competition = new Competition();
        $currentCompetition = $competition->first(['competitionID' => $competitionID]);


        $participantsCount = isset($currentCompetition['participants']) ? $currentCompetition['participants'] + 1 : 1;

        $competition->update($competitionID, ['participants' => $participantsCount], 'competitionID');



        $_SESSION['success_message'] = "Your entry has been submitted successfully";
        $userType = $_SESSION['user_type'] ?? '';

        if ($userType == 'writer' || $userType == 'wricov') {
            header("Location: /Free-Write/public/Competition/WriterCompetition?compID={$competitionID}");
        } elseif ($userType == 'covdes') {
            header("Location: /Free-Write/public/Competition/CoverCompetition?compID={$competitionID}");

        }

    }

    /*public function ProfileUser()
     {

         $this->view('publisher/aCompetitionProfile4users');
     }*/

    // public function WriterCompetition()
    // {
    //     $competiion = new Competition();
    //     $compID = $_GET['compID'] ?? null;
    //     $compDetails = null;

    //     if ($compID != null) {
    //         $compDetails = $competiion->first(['competitionID' => $compID]);
    //     }

    //     $data = [
    //         'details' => $compDetails,
    //     ];
    //     $this->view('publisher/aCompetitionProfile4users', $data);
    // }

    // public function CoverCompetition()
    // {
    //     $competiion = new Competition();
    //     $compID = $_GET['compID'] ?? null;
    //     $compDetails = null;

    //     if ($compID != null) {
    //         $compDetails = $competiion->first(['competitionID' => $compID]);
    //     }

    //     $data = [
    //         'details' => $compDetails,
    //     ];
    //     $this->view('publisher/aCompetitionProfile4users', $data);
    // }

    // public function Competitions()
    // {
    //     $competitionModel = new Competition();

    //     // Fetch competitions based on their status
    //     $activeCompetitions = $competitionModel->where(['status' => 'active']);
    //     $previousCompetitions = $competitionModel->where(['status' => 'ended']);
    //     $upcomingCompetitions = $competitionModel->where(['status' => 'upcoming']);

    //     // Pass data to the view
    //     $this->view('CoverPageDesigner/Competition', [
    //         'activeCompetitions' => $activeCompetitions,
    //         'previousCompetitions' => $previousCompetitions,
    //         'upcomingCompetitions' => $upcomingCompetitions
    //     ]);
    // }

}