<?php

class CollectionController extends Controller
{
    public function index()
    {
        $this->view('error');
    }

    public function viewCollection()
    {
        $collectionID = splitURL()[2];
        $collection = new Collection();
        $collectionBook = new CollectionBook();

        $collectionData = $collection->first(['collectionID' => $collectionID]);
        $books = $collectionBook->getBooksInCollection($collectionID);

        //checking privacy
        if ($collectionData['isPublic'] == '0') {
            if (!isset($_SESSION['user_id']) || $collectionData['user'] != $_SESSION['user_id']) {
                $this->view('error');
                return;
            }
        }

        $this->view('Profile/collectionView', [
            'collection' => $collectionData,
            'books' => $books
        ]);
    }

    public function deleteCollection()
    {

        $collectionID = $_POST['collectionID'];
        $collection = new Collection();
        $collectionBook = new CollectionBook();

        $collectionBook->delete($collectionID, 'collection');
        $collection->delete($collectionID, 'collectionID');

        header('Location: /Free-Write/public/User/Profile');
    }

    public function editCollection()
    {
        $collectionID = $_POST['id'];
        $collection = new Collection();

        $title = $_POST['collectionTitle'] ?? null;
        $description = $_POST['collectionDescription'] ?? null;
        $isPublic = $_POST['collectionStatus'] ?? null;

        if (strlen($title) > 45 || strlen($description) > 255) { //checking for max length - if exceeded, redirect back to collection
            header('Location: /Free-Write/public/Collection/viewCollection/' . $collectionID);
            return;
        }

        $collection->update(
            $collectionID,
            [
                'title' => $title,
                'description' => $description,
                'isPublic' => $isPublic
            ],
            'collectionID'
        );

        header('Location: /Free-Write/public/Collection/viewCollection/' . $collectionID);
    }
}

?>