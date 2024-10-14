<?php

class BookController extends Controller
{
    public function index()
    {
        $URL = splitURL();
        //show($URL);

        if ($URL[2] >=1) {
            $this->viewBook($URL[2]);

        }
    }

    private function viewBook($bookID)//set as private
    {
        $book = new Book();

        $bookFound = $book->getBookByID($bookID);
        $bookChapters = $book->getBookChapters($bookID); //list of chapters related to the specific book

        $this->view('book/Overview', ['book' => $bookFound, 'chapters' => $bookChapters]);
    }

}