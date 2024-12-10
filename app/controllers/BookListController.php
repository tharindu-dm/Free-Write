<?php

class BookListController extends Controller
{
    public function index()
    {
        $URL = splitURL();
        if (
            $URL[2] == 'Reading' ||
            $URL[2] == 'Completed' ||
            $URL[2] == 'Onhold' ||
            $URL[2] == 'Dropped' ||
            $URL[2] == 'Planned'
        )
            $this->listPage();
        else
            $this->view('error');

    }

    public function listPage()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->view('login');
            return;
        }
        $uid = $_SESSION['user_id'];
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

        $list = new BookList(); //get chapter to be added to the list
        $list->addToList($uid, $bookID, $status);
        header('Location: /Free-Write/public/Book/Overview/' . $bookID);
    }

    public function updateList()
    {
        $bookID = $_POST['List_bid'];
        $chapterCount = 0;

        if (isset($_POST['chapterCount']))
            $chapterCount = $_POST['chapterCount'];

        $BookStatus = $_POST['status'];

        $list = new BookList();

        $uid = $_SESSION['user_id'];
        $list->updateList($uid, $bookID, $chapterCount, $BookStatus);

        if (!isset($_POST['chapterCount']))
            header('Location: /Free-Write/public/Book/Overview/' . $bookID);
        else
            header('Location: /Free-Write/public/User/Profile');
    }

    public function deleteFromList()
    {
        $bookID = $_POST['List_bid'];
        $list = new BookList();

        $uid = $_SESSION['user_id'];
        $list->deleteFromList($uid, $bookID);
        header('Location: /Free-Write/public/User/Profile');
    }


}