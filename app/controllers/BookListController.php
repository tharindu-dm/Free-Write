<?php

class BookListController extends Controller
{
    public function index()
    {
        //echo "this is the List Controller\n";
        $URL = splitURL();

        if (count($URL) == 2) {
            switch ($URL[1]) {
                case 'Reading':
                case 'Completed':
                case 'Onhold':
                case 'Dropped':
                case 'Planned':
                    $this->listPage($URL[1]);
                    break;
                default:
                    $this->view('error');
                    break;
            }

        } else {
            $this->view('login');
        }
    }

    private function listPage($listType)
    {
        if(!isset($_SESSION['user_id'])){
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


}