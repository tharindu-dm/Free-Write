<?php

class DesignerCompetitionController extends Controller
{

    public function index()
    {
        $submissionModel = new DesignSubmissions();
        $userDetailsModel = new UserDetails();

        // Fetch competitions the user has joined
        $joinedCompetitions = $submissionModel->getJoinedCompetitions($_SESSION['user_id']);

        //Fetch user details
        $userDetails = $userDetailsModel->first(['user' => $_SESSION['user_id']]);

        // Debug the joined competitions
        error_log("Joined Competitions for View: " . json_encode($joinedCompetitions));

        $data = [
            'userDetails' => $userDetails,
            'joinedCompetitions' => $joinedCompetitions
        ];

        // Load the user's competition page
        $this->view('CoverPageDesigner/Competition', $data);
    }

    public function createSubmission()
    {
        // Check if the user is logged in
        if (!isset($_SESSION['user_id'])) {
            header("Location: /Free-Write/public/login");
            exit;
        }

        // Retrieve competitionID from the URL
        $URL = splitURL();
        $competitionID = $URL[2] ?? null;

        if (!$competitionID) {
            echo "Competition ID is missing.";
            exit;
        }

        //fetch competition data
        $competitionModel = new Competition();
        $competition = $competitionModel->first(['competitionID' => $competitionID]);

        if (!$competition) {
            echo "Competition not found.";
            exit;
        }

        // Pass the competition ID and user ID to the view
        $this->view('CoverPageDesigner/CompetitionSubmissionForm', [
            'competitionID' => $competitionID,
            'competitionName' => $competition['title'],
            'userID' => $_SESSION['user_id']
        ]);
    }


    public function submitCompetition()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $submissionModel = new DesignSubmissions();

            // Validate required fields
            if (empty($_POST['competitionID']) || !is_numeric($_POST['competitionID'])) {
                echo "Invalid competition ID.";
                exit;
            }

            if (empty($_SESSION['user_id']) || !is_numeric($_SESSION['user_id'])) {
                echo "Invalid user ID.";
                exit;
            }

            if (empty($_POST['title'])) {
                echo "Title is required.";
                exit;
            }

            $competitionID = (int) $_POST['competitionID'];
            $title = $_POST['title'];
            $description = $_POST['content'] ?? '';
            $designerID = (int) $_SESSION['user_id'];
            $uploadDate = date('Y-m-d H:i:s');

            $newFileName = null;

            // Handle cover image upload
            if (isset($_FILES['submissionImage']) && $_FILES['submissionImage']['error'] === UPLOAD_ERR_OK) {
                $file = $_FILES['submissionImage'];
                $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
                $dateTime = date('Y-m-d_H-i-s');
                $newFileName = "COVER_" . $designerID . "_" . $dateTime . "." . $fileExtension;
                $targetDirectory = "../app/images/DesignSubmissions/";

                if (!is_dir($targetDirectory)) {
                    mkdir($targetDirectory, 0777, true);
                }

                if (!move_uploaded_file($file['tmp_name'], $targetDirectory . $newFileName)) {
                    die("Failed to upload image.");
                }
            } else {
                echo "Image upload is required.";
                exit;
            }

            // Generate a unique covID
            $covID = uniqid('COV-');

            // Insert the submission details into the DesignSubmissions table
            $submissionData = [
                'competitionID' => $competitionID,
                'userID' => $designerID,
                'covID' => $covID,
                'title' => $title,
                'name' => $newFileName,
                'description' => $description,
                'status' => 'Pending',
                'created_at' => $uploadDate,
                'updated_at' => $uploadDate
            ];

            if ($submissionModel->createSubmission($submissionData)) {
                // Debug the inserted data
                error_log("Submission Data: " . json_encode($submissionData));

                // Redirect to the competition page
                header("Location: /Free-Write/public/DesignerCompetition/index");
                exit;
            } else {
                echo "Failed to create submission.";
                exit;
            }
        } else {
            echo "Invalid request method.";
            exit;
        }
    }

    public function viewCompetitionAfterSubmission()
    {
        // Check if the user is logged in
        if (!isset($_SESSION['user_id'])) {
            header("Location: /Free-Write/public/login");
            exit;
        }

        // Retrieve competitionID from the URL
        $URL = splitURL();
        //$competitionID = $URL[2] ?? null;
        $competitionID = $_SESSION['competitionID'] ?? $URL[2] ?? null;

        if (!$competitionID) {
            echo "Competition ID is missing.";
            exit;
        }

        $submissionModel = new DesignSubmissions();
        $submission = $submissionModel->where([
            'userID' => $_SESSION['user_id'],
            'competitionID' => $competitionID
        ]);

        if (!$submission) {
            echo "No submission found for this competition.";
            exit;
        }

        // Pass the competition and submission details to the view
        $this->view('publisher/CompetitionProfileAfterSubmission', [
            'competitionName' => 'Example Competition Name', // Replace with actual competition name
            'competitionDescription' => 'Example competition description.', // Replace with actual description
            'submission' => $submission[0]
        ]);
        unset($_SESSION['competitionID']);
    }

    public function deleteSubmission()
    {
        $submissionID = splitURL()[2];
        $submissionModel = new DesignSubmissions();

        //fetch the submission details to get the image name
        $submission = $submissionModel->first(['submissionID' => $submissionID]);

        // Debug the fetched submission
        error_log("Fetched Submission: " . json_encode($submission));

        if (!$submission) {
            echo "Submission not found";
            exit;
        }

        //delete the submission image
        $imagePath = "../app/images/DesignSubmissions/" . $submission['name'];
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        //delete the submission data from the database
        if ($submissionModel->delete($submissionID, 'submissionID')) {
            // Redirect back to the competition page
            header("Location: /Free-Write/public/DesignerCompetition/index");
            exit;
        } else {
            echo "Failed to delete submission.";
            exit;

        }

    }

    public function editSubmission()
    {
        $URL = splitURL();
        $submissionID = $URL[2] ?? null;

        $submissionModel = new DesignSubmissions();

        // Fetch the submission details
        $submission = $submissionModel->first(['submissionID' => $submissionID]);

        if (!$submission) {
            echo "Submission not found.";
            exit;
        }

        $this->view('CoverPageDesigner/editSubmissionForm', [
            'submission' => $submission
        ]);
    }

    public function updateSubmission()
    {
        $URL = splitURL();
        $submissionID = $URL[2] ?? null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $submissionModel = new DesignSubmissions();

            // Fetch the existing submission
            $submission = $submissionModel->first(['submissionID' => $submissionID]);

            if (!$submission) {
                echo "Submission not found.";
                exit;
            }

            $title = $_POST['title'];
            $description = $_POST['description'] ?? $submission['description'];
            $updated_at = date('Y-m-d H:i:s');

            $newFileName = $submission['name']; // Keep the existing image by default

            // Handle image upload if a new image is provided
            if (isset($_FILES['submissionImage']) && $_FILES['submissionImage']['error'] === UPLOAD_ERR_OK) {
                $file = $_FILES['submissionImage'];
                $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
                $dateTime = date('Y-m-d_H-i-s');
                $newFileName = "COVER_" . $submission['userID'] . "_" . $dateTime . "." . $fileExtension;
                $targetDirectory = "../app/images/DesignSubmissions/";

                if (!is_dir($targetDirectory)) {
                    mkdir($targetDirectory, 0777, true);
                }

                // Move the new file
                if (move_uploaded_file($file['tmp_name'], $targetDirectory . $newFileName)) {
                    // Delete the old image
                    $oldImagePath = $targetDirectory . $submission['name'];
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                } else {
                    echo "Failed to upload new image.";
                    exit;
                }
            }

            // Update the submission in the database
            $updateData = [
                'title' => $title,
                'description' => $description,
                'name' => $newFileName,
                'updated_at' => $updated_at
            ];

            if ($submissionModel->update($submissionID, $updateData, 'submissionID')) {
                // Redirect to the competition page
                header("Location: /Free-Write/public/DesignerCompetition/index");
                exit;
            } else {
                echo "Failed to update submission.";
                exit;
            }
        } else {
            echo "Invalid request method.";
            exit;
        }
    }
}