<?php

class DesignerCollectionController extends Controller
{
    public function index()
    {

        header('Location: /Free-Write/public/DesignerCollection/dashboard');
        exit;
    }

    public function dashboard()
    {
        $collectionDetails = new CollectionDetails();
        $userID = $_SESSION['user_id'];
        $collections = $collectionDetails->getCollectionsByUser($userID);


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
            'collections' => $collections
        ]);
    }


    public function viewCollection()
    {
        $collectionID = splitURL()[2];
        $collectionDetails = new CollectionDetails();
        $collectionDesigns = new CollectionDesigns();
        $coverModel = new CoverImage();


        $collection = $collectionDetails->first(['collectionID' => $collectionID]);
        if (!$collection) {
            echo "Collection not found.";
            return;
        }


        $designLinks = $collectionDesigns->getDesignsByCollection($collectionID);


        $designs = [];
        foreach ($designLinks as $link) {
            $design = $coverModel->first(['covID' => $link['designID']]);
            if ($design) {
                $designs[] = $design;
            }
        }


        $allDesigns = $coverModel->getByDesigner($_SESSION['user_id']);


        $this->view('CoverPageDesigner/ViewCollection', [
            'collection' => $collection,
            'designs' => $designs,
            'allDesigns' => $allDesigns,
            'designsInCollection' => $designLinks
        ]);
    }

    public function editCollection()
    {
        $collectionID = splitURL()[2];
        $collectionDetails = new CollectionDetails();


        $collection = $collectionDetails->first(['collectionID' => $collectionID]);

        if (!$collection) {
            $this->view('error');
            return;
        }


        $this->view('CoverPageDesigner/editCollection', [
            'collection' => $collection
        ]);
    }

    public function updateCollection()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $collectionID = $_POST['collectionID'];
            $collectionDetails = new CollectionDetails();

            $data = [
                'title' => $_POST['collectionTitle'],
                'description' => $_POST['collectionDescription'],
                'isPublic' => $_POST['collectionVisibility']
            ];

            $collectionDetails->update($collectionID, $data, 'collectionID');


            header('Location: /Free-Write/public/Designer/dashboard');
            exit;
        }
    }

    public function deleteCollection()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $collectionID = $_POST['collectionID'];
            $collectionDetails = new CollectionDetails();





            $collectionDetails->delete($collectionID, 'collectionID');

            // Redirect to dashboard after deletion
            header('Location: /Free-Write/public/Designer/dashboard');
            exit;
        }
    }

    public function addDesignToCollection()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $collectionID = $_POST['collectionID'];
            $designID = $_POST['designID'];
            $collectionDesigns = new CollectionDesigns();
            $collectionDesigns->addDesignToCollection($collectionID, $designID);

            header('Location: /Free-Write/public/DesignerCollection/viewCollection/' . $collectionID);
            exit;
        }
    }

    public function removeDesignFromCollection()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $collectionID = $_POST['collectionID'];
            $designID = $_POST['designID'];
            $collectionDesigns = new CollectionDesigns();
            $collectionDesigns->removeDesignFromCollection($collectionID, $designID);

            header('Location: /Free-Write/public/DesignerCollection/viewCollection/' . $collectionID);
            exit;
        }
    }
}