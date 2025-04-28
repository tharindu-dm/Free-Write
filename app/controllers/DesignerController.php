<?php

class DesignerController extends Controller
{
    public function index()
    {
        $model = new CoverImage();
        $userModel = new User();

        
        $designerPerPage = 5;
        $designerPage = isset($_GET['designer_page']) ? max(1, (int) $_GET['designer_page']) : 1;
        $totalDesigners = $userModel->getTotalCoverDesignersCount();
        $totalDesignerPages = max(1, ceil($totalDesigners / $designerPerPage));
        $designerOffset = ($designerPage - 1) * $designerPerPage;
        $designers = $userModel->getCoverDesignersPaginated($designerPerPage, $designerOffset);

        
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
        
        $designerId = $_SESSION['user_id'];

        
        $userDetailsModel = new UserDetails();
        $userDetails = $userDetailsModel->getDetails($designerId);

        
        $coverModel = new CoverImage();
        $designs = $coverModel->getByDesigner($designerId);

        
        $collectionDetails = new CollectionDetails();
        $collections = $collectionDetails->getCollectionsByUser($designerId);

        
        $collectionDesigns = new CollectionDesigns();
        $coverModel = new CoverImage();
        foreach ($collections as &$collection) {
            $firstDesignLink = $collectionDesigns->getFirstDesignByCollection($collection['collectionID']);
            if ($firstDesignLink) {
                
                $design = $coverModel->first(['covID' => $firstDesignLink['designID']]);
                $collection['frontImage'] = $design ? $design['license'] : null;
            } else {
                $collection['frontImage'] = null;
            }
        }

        
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

    
    
    

    
    

    
    

    
    
    
    
    

    public function showCollectionForUsers()
    {
        $collectionID = splitURL()[2];
        $collectionDetailsModel = new CollectionDetails();
        $collectionDesignsModel = new CollectionDesigns();
        $coverImageModel = new CoverImage();

        
        $collection = $collectionDetailsModel->first(['collectionID' => $collectionID]);
        if (!$collection) {
            echo "Collection not found.";
            return;
        }

        
        $designLinks = $collectionDesignsModel->getDesignsByCollection($collectionID);
        $designs = [];
        foreach ($designLinks as $link) {
            $design = $coverImageModel->first(['covID' => $link['designID']]);
            if ($design) {
                $designs[] = $design;
            }
        }

        
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
                
                
                $this->view('CoverPageDesigner/Dashboard', [
                    'userDetails' => $userDetails,
                    'designs' => $designs
                ]);
            } else {
                echo "Failed to upload cover page.";
            }
        } else {
            
            $this->view('CoverUploadForm');
        }
    }


    public function edit()
    {
        $id = splitURL()[2];
        $coverModel = new CoverImage();

        
        $design = $coverModel->first(['covID' => $id]);

        if (!$design) {
            echo "Design not found.";
            return;
        }

        
        $loggedInUserId = $_SESSION['user_id'];
        if ($design['artist'] != $loggedInUserId) {
            echo "You are not authorized to edit this design.";
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $data = [
                'name' => $_POST['title'],
                'description' => $_POST['description']
            ];

            
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

        
        $this->view('CoverPageDesigner/EditDesign', ['design' => $design]);
    }

    public function viewDesign()
    {
        $id = splitURL()[2];
        $coverModel = new CoverImage();
        $ratingModel = new CovDesignRating();

        
        $design = $coverModel->first(['covID' => $id]);
        $ratingData = $ratingModel->getAverageRating($id);

        if ($design) {
            
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

        
        $design = $coverModel->first(['covID' => $id]);

        if ($design) {
            
            $filePath = "../app/images/coverDesign/" . $design['license'];
            if (file_exists($filePath)) {
                unlink($filePath); 
            }

            
            if ($coverModel->delete($id, 'covID')) {
                
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
            if (!isset($_SESSION['user_id'])) {
                echo json_encode(['success' => false, 'error' => 'User not logged in']);
                return;
            }

            $data = json_decode(file_get_contents('php://input'), true);

            $userID = $_SESSION['user_id']; 
            $covID = $data['covID']; 
            $rating = $data['rating']; 

            $covDesignRatingModel = new CovDesignRating();

            
            if ($covDesignRatingModel->addOrUpdateRating($userID, $covID, $rating)) {
                
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

        
        $design = $coverModel->first(['covID' => $id]);

        if ($design) {
            
            $designer = $userDetailsModel->first(['user' => $design['artist']]);

            
            $ratingData = $covDesignRatingModel->getAverageRating($id);

            
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

        
        foreach ($collections as &$collection) {
            $firstDesignLink = $collectionDesignsModel->getFirstDesignByCollection($collection['collectionID']);
            if ($firstDesignLink) {
                
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

    

    public function createCollection()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $collectionDetails = new CollectionDetails();

            $data = [
                'userID' => $_SESSION['user_id'], 
                'title' => $_POST['collectionTitle'],
                'description' => $_POST['CollectionDescription'],
                'isPublic' => $_POST['collectionVisibility'],
            ];

            $collectionDetails->insert($data);

            
            header('Location: /Free-Write/public/Designer/Dashboard');
            exit;
        }
    }

}