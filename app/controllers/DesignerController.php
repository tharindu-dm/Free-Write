<?php

class DesignerController extends Controller
{
    public function index()
    {
        $model = new CoverImage();
        $userModel = new User();

        $designers = $userModel->getCoverDesigners();
        $designs = $model->getAllCoverImages();

        $this->view('CoverPageDesigner/Designers_and_Design',[
            'designers' => $designers,
            'designs' => $designs
        ]);
        //$this->view('CoverPage/index', ['designs' => $designs]);
    }


    public function Dashboard()
    {
        // Get the logged-in designer's ID from the session
        $designerId = $_SESSION['user_id'];

        // Fetch designer details
        $userDetailsModel = new UserDetails();
        $userDetails = $userDetailsModel->getDetails($designerId);

        // Fetch designs created by the designer
        $coverModel = new CoverImage();
        $designs = $coverModel->getByDesigner($designerId);

        // Fetch collections created by the designer
        $collectionDetails = new CollectionDetails();
        $collections = $collectionDetails->getCollectionsByUser($designerId);

        // Add: Fetch first image for each collection
        $collectionDesigns = new CollectionDesigns();
        $coverModel = new CoverImage();
        foreach ($collections as &$collection) {
            $firstDesignLink = $collectionDesigns->getFirstDesignByCollection($collection['collectionID']);
            if ($firstDesignLink) {
                // Now fetch the actual design to get the image filename
                $design = $coverModel->first(['covID' => $firstDesignLink['designID']]);
                $collection['frontImage'] = $design ? $design['license'] : null;
            } else {
                $collection['frontImage'] = null;
            }
        }

        // Pass the data to the Dashboard view
        $this->view('CoverPageDesigner/Dashboard', [
            'userDetails' => $userDetails,
            'designs' => $designs,
            'collections' => $collections
        ]);
    }

    public function New()
    {
        $this->view('CoverPageDesigner/CreateDesign');
    }

    public function Competition(){
        $this->view('CoverPageDesigner/Competition');
    }

    public function createCover()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $coverModel = new CoverImage();

            $title = $_POST['title'];
            $description = $_POST['description'] ?? ''; 
            $price = $_POST['price'] ?? null; 
            $designer_id = $_SESSION['user_id']; 
            $uploadDate = date('Y-m-d H:i:s');

            $newFileName = null;

            // Handle cover image upload
            if (isset($_FILES['coverImage']) && $_FILES['coverImage']['error'] == UPLOAD_ERR_OK) {
                $file = $_FILES['coverImage'];
                $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
                $dateTime = date('Y-m-d_H-i-s');
                $newFileName = "COVER_" . $designer_id . "_" . $dateTime . "." . $fileExtension;
                $targetDirectory = "../app/images/coverDesign/";

                if (!is_dir($targetDirectory)) {
                    mkdir($targetDirectory, 0777, true);
                }

                if (!move_uploaded_file($file['tmp_name'], $targetDirectory . $newFileName)) {
                    die("Failed to upload image.");
                }
            }

            $data = [
                'artist' => $designer_id,
                'name' => $title,
                'description' => $description,
                'price' => $price,
                'uploadDate' => $uploadDate,
                'license' => $newFileName,
            ];

            if ($coverModel->insert($data)) {
                // Re-fetch the updated list of designs
                $userDetailsModel = new UserDetails();
                $userDetails = $userDetailsModel->getDetails($designer_id);

                $designs = $coverModel->getByDesigner($designer_id);

                // Pass the updated data to the Dashboard view
                $this->view('CoverPageDesigner/Dashboard', [
                    'userDetails' => $userDetails,
                    'designs' => $designs
                ]);
            } else {
                echo "Failed to upload cover page.";
            }
        } else {
            // If not POST, show the upload form
            $this->view('CoverUploadForm');
        }
    }
    

    public function edit($id)
    {
        $coverModel = new CoverImage();

        // Fetch the current design details
        $design = $coverModel->first(['covID' => $id]);

        if (!$design) {
            echo "Design not found.";
            return;
        }

        // Check if the logged-in user is the owner of the design
        $loggedInUserId = $_SESSION['user_id'];
        if ($design['artist'] != $loggedInUserId) {
            echo "You are not authorized to edit this design.";
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Handle form submission to update the design
            $data = [
                'name' => $_POST['title'],
                'description' => $_POST['description'],
                'price' => $_POST['price']
            ];

            // Handle optional image upload
            if (!empty($_FILES['coverImage']['name'])) {
                $file = $_FILES['coverImage'];
                $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
                $newFileName = "COVER_" . $id . "_" . time() . "." . $fileExtension;
                $targetDirectory = "../app/images/coverDesign/";

                if (!is_dir($targetDirectory)) {
                    mkdir($targetDirectory, 0777, true);
                }

                if (move_uploaded_file($file['tmp_name'], $targetDirectory . $newFileName)) {
                    $data['license'] = $newFileName;

                    // Delete the old image
                    $oldFilePath = "../app/images/coverDesign/" . $design['license'];
                    if (file_exists($oldFilePath)) {
                        unlink($oldFilePath);
                    }
                }
            }

            if ($coverModel->update($id, $data, 'covID')) {
                header("Location: /Free-Write/public/Designer/viewDesign/$id");
                exit;
            } else {
                echo "Failed to update the design.";
            }
        }

        // Pass the design details to the create/edit form
        $this->view('CoverPageDesigner/EditDesign', ['design' => $design]);
    }

    public function viewDesign($id)
    {
        var_dump($id);

        $coverModel = new CoverImage();

        // Fetch the design details by ID
        $design = $coverModel->first(['covID' => $id]);

        if ($design) {
            // Pass the design details to the CoverPageDesign view
            $this->view('CoverPageDesigner/CoverPageDesign', ['design' => $design]);
        } else {
            echo "Design not found.";
        }
    }

    public function delete($id)
    {
        $coverModel = new CoverImage();

        // Fetch the design details to get the file name
        $design = $coverModel->first(['covID' => $id]);

        if ($design) {
            // Delete the image file from the target directory
            $filePath = "../app/images/coverDesign/" . $design['license'];
            if (file_exists($filePath)) {
                unlink($filePath); // Delete the file
            }

            // Delete the design from the database
            if ($coverModel->delete($id, 'covID')) {
                // Redirect to the dashboard after successful deletion
                header('Location: /Free-Write/public/Designer/Dashboard');
                exit;
            } else {
                echo "Failed to delete the design from the database.";
            }
        } else {
            echo "Design not found.";
        }
    }

    public function rateDesign()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);

            $userID = $_SESSION['user_id']; // Logged-in user ID
            $covID = $data['covID']; // Cover design ID
            $rating = $data['rating']; // Rating (1-5)

            $covDesignRatingModel = new CovDesignRating();

            // Add or update the rating
            if ($covDesignRatingModel->addOrUpdateRating($userID, $covID, $rating)) {
                // Fetch the updated average rating
                $ratingData = $covDesignRatingModel->getAverageRating($covID);
                echo json_encode(['success' => true, 'newAverageRating' => $ratingData['averageRating']]);
            } else {
                echo json_encode(['success' => false]);
            }
        }
    }

    public function viewDesignForNonOwner($id)
    {
        $coverModel = new CoverImage();
        $userDetailsModel = new UserDetails();
        $covDesignRatingModel = new CovDesignRating();

        // Fetch the design details by ID
        $design = $coverModel->first(['covID' => $id]);

        if ($design) {
            //fetch the designer details using the artistID
            $designer = $userDetailsModel -> first(['user' => $design['artist']]);

            //fetch the average rating
            $ratingData = $covDesignRatingModel->getAverageRating($id);

            // Pass the design details to the correct view
            $this->view('CoverPageDesigner/viewDesign', [
                'design' => $design,
                'designer' => $designer,
                'ratingData' => $ratingData
            ]);
        } else {
            echo "Design not found.";
        }
    }

    //collection

    public function createCollection()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $collectionDetails = new CollectionDetails();

            $data = [
                'userID' => $_SESSION['user_id'], // Ensure the user is logged in
                'title' => $_POST['collectionTitle'],
                'description' => $_POST['CollectionDescription'],
                'isPublic' => $_POST['collectionVisibility'],
            ];

            $collectionDetails->createCollection($data);

            // Redirect to the dashboard after creation
            header('Location: /Free-Write/public/Designer/Dashboard');
            exit;
        }
    }

}