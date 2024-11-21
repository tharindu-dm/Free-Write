<?php

class BookListController extends Controller
{
    public function index()
    {
        $URL = splitURL();
        switch ($URL[1]) {
            case 'Add':
                $this->addToList($_POST['List_uid'], $_POST['List_bid'], $_POST['list']);
                break;
            case 'Update':
                $this->updateList($_POST['List_bid'], $_POST['chapterCount'], $_POST['status']);
                break;
            case 'Delete':
                $this->deleteFromList($_POST['List_bid']);

            default:
                $this->listPage();
                break;
        }

    }

    private function listPage()
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

    private function addToList($uid, $bookID, $status)
    {
        $list = new BookList(); //get chapter to be added to the list
        $list->addToList($uid, $bookID, $status);
        header('Location: /Free-Write/public/Book/Overview/' . $bookID);
    }

    private function updateList($bookID, $chapterCount, $BookStatus)
    {
        $list = new BookList();

        $uid = $_SESSION['user_id'];
        $list->updateList($uid, $bookID, $chapterCount, $BookStatus);
        header('Location: /Free-Write/public/User/Profile');
    }

    private function deleteFromList($bookID)
    {
        $list = new BookList();

        $uid = $_SESSION['user_id'];
        $list->deleteFromList($uid, $bookID);
        header('Location: /Free-Write/public/User/Profile');
    }


}