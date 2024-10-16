<?php

class BookController extends Controller
{
    public function index()
    {
        $URL = splitURL();
        //show($URL);
        /*Array
            (
                [0] => book
                [1] => Overview
                [2] => 4
            )*/
        switch ($URL[1]) {
            case 'Overview':
                if ($URL[2] >= 1) {
                    $this->viewBook($URL[2]);
                } else {
                    $this->view('error');
                }

                break;

            case 'Chapter':
                if ($URL[2] >= 1) {
                    $this->viewChapter($URL[2]);
                } else {
                    $this->view('error');
                }

                break;

            case 'List':
                $this->addToList($_POST['List_uid'], $_POST['List_bid'], $_POST['list']);
                break;
            default:
                $this->view('error');
                break;
        }


    }

    private function viewBook($bookID)//set as private
    {
        $book = new Book();

        $bookFound = $book->getBookByID($bookID);
        $bookChapters = $book->getBookChapters($bookID); //list of chapters related to the specific book

        $this->view('book/Overview', ['book' => $bookFound, 'chapters' => $bookChapters]);
    }

    private function viewChapter($chapterID)
    {
        $chapter = new Chapter();
        //$chapterFound = $chapter->getChapterByID($chapterID);

        // $this->view('book/Chapter', ['chapter' => $chapterFound]);
    }

    private function addToList($uid, $bookID, $status)
    {
        $list = new BookList(); //get chapter to be added to the list
        $list->addToList($uid,$bookID, $status);
        $this->viewBook($bookID);
    }
}