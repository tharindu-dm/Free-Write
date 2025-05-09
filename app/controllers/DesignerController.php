<?php

class DesignerController extends Controller
{
    public function index()
    {
        $model = new CoverImage();
        $userModel = new User();

        // Designers pagination
        $designerPerPage = 5;
        $designerPage = isset($_GET['designer_page']) ? max(1, (int) $_GET['designer_page']) : 1;
        $totalDesigners = $userModel->getTotalCoverDesignersCount();
        $totalDesignerPages = max(1, ceil($totalDesigners / $designerPerPage));
        $designerOffset = ($designerPage - 1) * $designerPerPage;
        $designers = $userModel->getCoverDesignersPaginated($designerPerPage, $designerOffset);

        // Designs pagination 
        $perPage = 5;
        $page = isset($_GET['page']) ? max(1, (int) $_GET['page']) : 1;
        $totalDesigns = $model->getTotalCoverImagesCount();
        $totalPages = max(1, ceil($totalDesigns / $perPage));
        $offset = ($page - 1) * $perPage;
        $designs = $model->getCoverImagesPaginated($perPage, $offset);

        $this->view('CoverPageDesigner/Designers_and_Design', [
            'designers' => $designers,
            'designs' => $designs,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'designerCurrentPage' => $designerPage,
            'designerTotalPages' => $totalDesignerPages
        ]);
    }

    private function checkLoggedUser()
    {
        if ($_SESSION['user_type'] != 'covdes' && $_SESSION['user_type'] != 'wricov') {
            header('location: /Free-Write/public/');
            exit();
        }
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

    // public function Competition()
    // {
    //     $designerId = $_SESSION['user_id'];

    //     $userDetailsModel = new UserDetails();
    //     $userDetails = $userDetailsModel->getDetails($designerId);

    //     $submissionModel = new DesignSubmissions();
    //     $joinedCompetitions = $submissionModel->getJoinedCompetitions($designerId);

    //     $this->view('CoverPageDesigner/Competition', [
    //         'userDetails' => $userDetails,
    //         'joinedCompetitions' => $joinedCompetitions ?? []
    //     ]);
    // }

    public function showCollectionForUsers()
    {
        $collectionID = splitURL()[2];
        $collectionDetailsModel = new CollectionDetails();
        $collectionDesignsModel = new CollectionDesigns();
        $coverImageModel = new CoverImage();

        // Fetch the collection details
        $collection = $collectionDetailsModel->first(['collectionID' => $collectionID]);
        if (!$collection) {
            echo "Collection not found.";
            return;
        }

        // Fetch all designs in the collection
        $designLinks = $collectionDesignsModel->getDesignsByCollection($collectionID);
        $designs = [];
        foreach ($designLinks as $link) {
            $design = $coverImageModel->first(['covID' => $link['designID']]);
            if ($design) {
                $designs[] = $design;
            }
        }

        // Pass the data to the view
        $this->view('CoverPageDesigner/showCollectionForUsers', [
            'collection' => $collection,
            'designs' => $designs
        ]);
    }

    public function createCover()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $coverModel = new CoverImage();

            $title = $_POST['title'];
            $description = $_POST['description'] ?? '';
            $designer_id = $_SESSION['user_id'];
            $uploadDate = date('Y-m-d H:i:s');

            $newFileName = null;

            // Handle cover image upload
            if (isset($_FILES['coverImage']) && $_FILES['coverImage']['error'] == UPLOAD_ERR_OK) {
                $file = $_FILES['coverImage'];
                $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
                $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif'];

                if (!in_array($fileExtension, $allowedExtensions) || !in_array(mime_content_type($file['tmp_name']), $allowedMimeTypes)) {
                    die("Invalid file type. Only JPG, PNG, and GIF files are allowed.");
                }

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
                'uploadDate' => $uploadDate,
                'license' => $newFileName
            ];

            if ($coverModel->insert($data)) {
                // Re-fetch the updated list of designs
                $userDetailsModel = new UserDetails();
                $userDetails = $userDetailsModel->getDetails($designer_id);

                $designs = $coverModel->getByDesigner($designer_id);

                $userModel = new User();


                $userType = $_SESSION['user_type'];
                if ($userType === 'reader') {
                    $userModel->updateUserTypeToCovdes($designer_id);
                    $userType = 'covdes';
                } elseif ($userType === 'writer') {
                    $userModel->updateUserTypeToWricov($designer_id);
                    $userType = 'wricov';
                }

                $_SESSION['user_type'] = $userType;
                // show($userType);
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


    public function edit()
    {
        $id = splitURL()[2];
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
                'description' => $_POST['description']
            ];

            // Handle optional image upload
            if (!empty($_FILES['coverImage']['name'])) {
                $file = $_FILES['coverImage'];
                $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
                $allowedExtensions = ['jpeg', 'png', 'gif'];
                $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif'];

                if (!in_array($fileExtension, $allowedExtensions) || !in_array(mime_content_type($file['tmp_name']), $allowedMimeTypes)) {
                    die("Invalid file type. Only JPG, PNG, and GIF files are allowed.");
                }

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

    public function viewDesign()
    {
        $id = splitURL()[2];
        $coverModel = new CoverImage();
        $ratingModel = new CovDesignRating();

        // Fetch the design details by ID
        $design = $coverModel->first(['covID' => $id]);
        $ratingData = $ratingModel->getAverageRating($id);

        if ($design) {
            // Pass the design details to the CoverPageDesign view
            $this->view(
                'CoverPageDesigner/CoverPageDesign',
                [
                    'design' => $design,
                    'ratingData' => $ratingData
                ]
            );
        } else {
            echo "Design not found.";
        }
    }

    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            die("Invalid request method");
        }

        $id = splitURL()[2];
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


    //Designer and Design page
    public function rateDesign()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_SESSION['user_id'])) {
                echo json_encode(['success' => false, 'error' => 'User not logged in']);
                return;
            }

            $data = json_decode(file_get_contents('php://input'), true);

            $userID = $_SESSION['user_id']; // Logged-in user ID
            $covID = $data['covID']; // Cover design ID
            $rating = $data['rating']; 

            $covDesignRatingModel = new CovDesignRating();

            // Add or update the rating
            if ($covDesignRatingModel->addOrUpdateRating($userID, $covID, $rating)) {
                // Fetch the updated average rating
                $ratingData = $covDesignRatingModel->getAverageRating($covID);
                echo json_encode(['success' => true, 'newAverageRating' => $ratingData['averageRating']]);
            } else {
                echo json_encode(['success' => false]);
            }
        } else{
            echo json_encode(['success' => false]);
        }
    }

    public function viewDesignForNonOwner()
    {
        $id = splitURL()[2];

        $coverModel = new CoverImage();
        $userDetailsModel = new UserDetails();
        $covDesignRatingModel = new CovDesignRating();

        // Fetch the design details by ID
        $design = $coverModel->first(['covID' => $id]);

        if ($design) {
            //fetch the designer details using the artistID
            $designer = $userDetailsModel->first(['user' => $design['artist']]);

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

    public function publicProfile()
    {
        $userID = splitURL()[2];
        //create objects
        $userModel = new User();
        $userDetailsModel = new UserDetails();
        $coverImageModel = new CoverImage();
        $collectionDetailsModel = new CollectionDetails();
        $collectionDesignsModel = new CollectionDesigns();
        $followModel = new Follow();

        $designer = $userModel->first(['userID' => (int) $userID]);
        if (!$designer) {
            echo 'designer not found';
            return;
        }

        $designerDetails = $userDetailsModel->first(['user' => $userID]);

        $designs = $coverImageModel->getByDesigner($userID);

        $collections = $collectionDetailsModel->where(['userID' => $userID]);

        // Assign the first image as the front image for each collection
        foreach ($collections as &$collection) {
            $firstDesignLink = $collectionDesignsModel->getFirstDesignByCollection($collection['collectionID']);
            if ($firstDesignLink) {
                // Fetch the actual design to get the image filename
                $design = $coverImageModel->first(['covID' => $firstDesignLink['designID']]);
                $collection['frontImage'] = $design ? $design['license'] : 'default-collection.jpg';
            } else {
                $collection['frontImage'] = 'default-collection.jpg';
            }
        }

        $followersCount = $followModel->getFollowCount($userID);

        $isFollowing = false;
        if (isset($_SESSION['user_id'])) {
            $isFollowing = $followModel->isFollowing($_SESSION['user_id'], $userID);
        }
        //$isFollowing = $followModel->isFollowing($_SESSION['user_id'], $userID);

        //pass data to view page
        $this->view('CoverPageDesigner/PublicProfile', [
            'designer' => $designer,
            'designerDetails' => $designerDetails,
            'designs' => $designs,
            'collections' => $collections,
            'followersCount' => $followersCount,
            'isFollowing' => $isFollowing
        ]);
    }

    public function follow()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            die("Invalid request method");
        }

        $userID = $_SESSION['user_id'];
        $designerID = $_POST['designerID'];

        $followersModel = new Follow();
        $followersModel->insert(['FollowerID' => $userID, 'FollowedID' => $designerID]);

        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

    public function unfollow()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            die("Invalid request method");
        }

        $userID = $_SESSION['user_id'];
        $designerID = $_POST['designerID'];

        $followersModel = new Follow();
        $followersModel->unfollow(['followerID' => $userID, 'followedID' => $designerID]);

        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
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

            $collectionDetails->insert($data);

            // Redirect to the dashboard after creation
            header('Location: /Free-Write/public/Designer/Dashboard');
            exit;
        }
    }

}