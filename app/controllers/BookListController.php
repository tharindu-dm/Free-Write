<?php

class BookListController extends Controller
{
    public function index()
    {
        $URL = splitURL();
        if (
            $URL[1] == 'Reading' ||
            $URL[1] == 'Completed' ||
            $URL[1] == 'Onhold' ||
            $URL[1] == 'Dropped' ||
            $URL[1] == 'Planned'
        )
            $this->listPage();
        else
            $this->view('error');

    }

    public function listPage()
    {
        if (!isset($_GET['user']) && !isset($_SESSION['user_id'])) {
            $this->view('login');
            return;
        }

        $uid = $_GET['user'];
        $Booklist = new BookList(); //List Table

        $Reading = $Booklist->getUserBookList($uid, 'reading');
        $Completed = $Booklist->getUserBookList($uid, 'completed');
        $Onhold = $Booklist->getUserBookList($uid, 'hold');
        $Dropped = $Booklist->getUserBookList($uid, 'dropped');
        $Planned = $Booklist->getUserBookList($uid, 'planned');


        $this->view('myBookList', [ //view the list of books
            'readingList' => $Reading,
            'completedList' => $Completed,
            'onholdList' => $Onhold,
            'droppedList' => $Dropped,
            'plannedList' => $Planned
        ]);
    }

    public function addToList()
    {
        $uid = $_SESSION['user_id'];
        $bookID = $_POST['List_bid'];
        $status = $_POST['status'];
        $readchapters = $_POST['chapterCount'] ?? 0;

        $list = new BookList(); //get chapter to be added to the list
        $bookchapter = new BookChapter();
        $noOfChapters = $bookchapter->getChapterCount($bookID);

        if (empty($noOfChapters['ChapterCount']) || $readchapters < 0) {
            $readchapters = 0;
        }

        if ($status == "completed" || $readchapters > $noOfChapters['ChapterCount']) {
            $readchapters = $noOfChapters['ChapterCount'];
        }

        $list->addToList($uid, $bookID, $status);
        header('Location: /Free-Write/public/Book/Overview/' . $bookID);
    }

    public function updateList()
    {
        $bookID = $_POST['List_bid'];
        $readchapters = 0;

        if (isset($_POST['chapterCount']))
            $readchapters = $_POST['chapterCount'];

        $BookStatus = $_POST['status'];

        $bookchapter = new BookChapter();
        $noOfChapters = $bookchapter->getChapterCount($bookID);

        if (empty($noOfChapters['ChapterCount']) || $readchapters < 0) {
            $readchapters = 0;
        }

        if ($BookStatus == "completed" || $readchapters > $noOfChapters['ChapterCount']) {
            $readchapters = $noOfChapters['ChapterCount'];
        }

        $list = new BookList();

        $uid = $_SESSION['user_id'];
        $list->updateList($uid, $bookID, $readchapters, $BookStatus);

        if (!isset($_POST['chapterCount']))
            header('Location: /Free-Write/public/Book/Overview/' . $bookID);
        else
            header('Location: /Free-Write/public/BookList/Reading?user=' . $uid);
    }

    public function deleteFromList()
    {
        $bookID = $_POST['List_bid'];
        $list = new BookList();

        $uid = $_SESSION['user_id'];
        $list->deleteFromList($uid, $bookID);
        header('Location: /Free-Write/public/BookList/Reading?user=' . $uid);
    }


}