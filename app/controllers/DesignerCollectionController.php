<?php

class DesignerCollectionController extends Controller
{
    public function index()
    {
        // Redirect to dashboard or show a message
        header('Location: /Free-Write/public/DesignerCollection/dashboard');
        exit;
    }

    public function dashboard()
    {
        $collectionDetails = new CollectionDetails();
        $userID = $_SESSION['user_id'];
        $collections = $collectionDetails->getCollectionsByUser($userID);

        // Add: Fetch first image for each collection
        $collectionDesigns = new CollectionDesigns();
        $coverModel = new CoverImage();
        foreach ($collections as &$collection) {
            $firstDesignLink = $collectionDesigns->getFirstDesignByCollection($collection['collectionID']);
            if ($firstDesignLink) {
                // Fetch the actual design to get the image filename
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

    // View a single collection 
    public function viewCollection($collectionID)
    {
        $collectionDetails = new CollectionDetails();
        $collectionDesigns = new CollectionDesigns();
        $coverModel = new CoverImage();

        // Fetch the collection details
        $collection = $collectionDetails->first(['collectionID' => $collectionID]);
        if (!$collection) {
            echo "Collection not found.";
            return;
        }

        // Get all design IDs in this collection
        $designLinks = $collectionDesigns->getDesignsByCollection($collectionID);

        // Fetch full design details for each design in the collection
        $designs = [];
        foreach ($designLinks as $link) {
            $design = $coverModel->first(['covID' => $link['designID']]);
            if ($design) {
                $designs[] = $design;
            }
        }

        // Fetch all designs by this user for the "add" dropdown
        $allDesigns = $coverModel->getByDesigner($_SESSION['user_id']);

        // Pass to the view
        $this->view('CoverPageDesigner/ViewCollection', [
            'collection' => $collection,
            'designs' => $designs,
            'allDesigns' => $allDesigns,
            'designsInCollection' => $designLinks // for add/remove logic
        ]);
    }

    public function editCollection()
    {
        $collectionID = splitURL()[2];
        $collectionDetails = new CollectionDetails();

        // Fetch the collection to edit
        $collection = $collectionDetails->first(['collectionID' => $collectionID]);

        if (!$collection) {
            $this->view('error');
            return;
        }

        // Show the edit form with current data
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

            // Redirect back to the dashboard or collection view
            header('Location: /Free-Write/public/Designer/dashboard');
            exit;
        }
    }

    public function deleteCollection()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $collectionID = $_POST['collectionID'];
            $collectionDetails = new CollectionDetails();

            // Optionally: delete related designs from the collection if needed
            // $collectionDesigns = new CollectionDesigns();
            // $collectionDesigns->deleteByCollection($collectionID);

            $collectionDetails->delete($collectionID, 'collectionID');

            // Redirect to dashboard after deletion
            header('Location: /Free-Write/public/DesignerCollection/dashboard');
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