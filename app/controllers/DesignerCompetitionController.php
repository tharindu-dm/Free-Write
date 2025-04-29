<?php

class DesignerCompetitionController extends Controller
{

    public function index()
    {
        $submissionModel = new DesignSubmissions();
        $userDetailsModel = new UserDetails();


        $joinedCompetitions = $submissionModel->getJoinedCompetitions($_SESSION['user_id']);


        $userDetails = $userDetailsModel->first(['user' => $_SESSION['user_id']]);


        error_log("Joined Competitions for View: " . json_encode($joinedCompetitions));

        $data = [
            'userDetails' => $userDetails,
            'joinedCompetitions' => $joinedCompetitions
        ];


        $this->view('CoverPageDesigner/Competition', $data);
    }

    public function createSubmission()
    {

        if (!isset($_SESSION['user_id'])) {
            header("Location: /Free-Write/public/login");
            exit;
        }


        $URL = splitURL();
        $competitionID = $URL[2] ?? null;

        if (!$competitionID) {
            echo "Competition ID is missing.";
            exit;
        }


        $competitionModel = new Competition();
        $competition = $competitionModel->first(['competitionID' => $competitionID]);

        if (!$competition) {
            echo "Competition not found.";
            exit;
        }


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


            $covID = uniqid('COV-');


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

                error_log("Submission Data: " . json_encode($submissionData));


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

        if (!isset($_SESSION['user_id'])) {
            header("Location: /Free-Write/public/login");
            exit;
        }


        $URL = splitURL();

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


        $this->view('publisher/CompetitionProfileAfterSubmission', [
            'competitionName' => 'Example Competition Name',
            'competitionDescription' => 'Example competition description.',
            'submission' => $submission[0]
        ]);
        unset($_SESSION['competitionID']);
    }

    public function deleteSubmission()
    {
        $submissionID = splitURL()[2];
        $submissionModel = new DesignSubmissions();


        $submission = $submissionModel->first(['submissionID' => $submissionID]);


        error_log("Fetched Submission: " . json_encode($submission));

        if (!$submission) {
            echo "Submission not found";
            exit;
        }


        $imagePath = "../app/images/DesignSubmissions/" . $submission['name'];
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }


        if ($submissionModel->delete($submissionID, 'submissionID')) {

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


            $submission = $submissionModel->first(['submissionID' => $submissionID]);

            if (!$submission) {
                echo "Submission not found.";
                exit;
            }

            $title = $_POST['title'];
            $description = $_POST['description'] ?? $submission['description'];
            $updated_at = date('Y-m-d H:i:s');

            $newFileName = $submission['name'];


            if (isset($_FILES['submissionImage']) && $_FILES['submissionImage']['error'] === UPLOAD_ERR_OK) {
                $file = $_FILES['submissionImage'];
                $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
                $dateTime = date('Y-m-d_H-i-s');
                $newFileName = "COVER_" . $submission['userID'] . "_" . $dateTime . "." . $fileExtension;
                $targetDirectory = "../app/images/DesignSubmissions/";

                if (!is_dir($targetDirectory)) {
                    mkdir($targetDirectory, 0777, true);
                }


                if (move_uploaded_file($file['tmp_name'], $targetDirectory . $newFileName)) {

                    $oldImagePath = $targetDirectory . $submission['name'];
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                } else {
                    echo "Failed to upload new image.";
                    exit;
                }
            }


            $updateData = [
                'title' => $title,
                'description' => $description,
                'name' => $newFileName,
                'updated_at' => $updated_at
            ];

            if ($submissionModel->update($submissionID, $updateData, 'submissionID')) {

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