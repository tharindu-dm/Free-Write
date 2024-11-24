<?php

class BookController extends Controller
{

    public function index()
    {
        $URL = splitURL();
        switch ($URL[1]) {

            case 'List':
                switch ($URL[2]) {
                    case 'update':
                        $this->updateList($_POST['List_bid'], $_POST['chapterCount'], $_POST['status']);
                        break;
                    case 'delete':
                        $this->deleteFromList($_POST['List_bid']);
                        break;
                    default:
                        $this->addToList($_POST['List_uid'], $_POST['List_bid'], $_POST['list']);
                        break;
                }
                break;
            default:
                $this->view('error');
                break;
        }


    }

    public function Overview($bookID = 0)
    {
        $URL = splitURL();
        if ($URL[2] < 1)
            $this->view('error');

        if ($bookID < 1 || !is_numeric($bookID))
            $bookID = $URL[2]; //get the book id from the url

        $book = new Book();

        $bookFound = $book->getBookByID($bookID);
        $bookChapters = $book->getBookChapters($bookID); //list of chapters related to the specific book

        $spinoff = new Spinoff();
        $spinoffs = $spinoff->where(['fromBook' => $bookID]);

        $this->view('book/Overview', ['book' => $bookFound, 'chapters' => $bookChapters, 'spinoffs' => $spinoffs]);
    }

    public function Chapter($chapterID = 0)
    {
        $URL = splitURL();

        if ($URL[2] < 1) {
            $this->view('error');
        }
        if ($chapterID < 1 || !is_numeric($chapterID))
            $chapterID = $URL[2]; //get the chapter id from the url

        $chapter = new Chapter();
        $chapterFound = $chapter->getChapterByID($chapterID);

        $this->view('book/Chapter', $chapterFound);
    }

    private function addToList($uid, $bookID, $status)
    {
        $list = new BookList(); //get chapter to be added to the list
        $list->addToList($uid, $bookID, $status);
        $this->Overview($bookID);
    }

    private function updateList($bookID, $chapterCount, $BookStatus)
    {
        $list = new BookList();

        $uid = $_SESSION['user_id'];
        $list->updateList($uid, $bookID, $chapterCount, $BookStatus);
        $this->Overview($bookID);
    }

    private function deleteFromList($bookID)
    {
        $list = new BookList();

        $uid = $_SESSION['user_id'];
        $list->deleteFromList($uid, $bookID);
        $this->Overview($bookID);
    }
}