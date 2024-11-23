<?php

class BookController extends Controller
{

    public function index()
    {
        $this->view('error');
    }

    public function Overview($bookID = 0)
    {
        $URL = splitURL();
        if ($URL[2] < 1)
            $this->view('error');

        if ($bookID < 1 || !is_numeric($bookID))
            $bookID = $URL[2]; //get the book id from the url

        $book = new Book();
        $chapter = new BookChapter();
        $spinoff = new Spinoff();
        $buybook = new BuyBook();
        $rating = new Rating();

        $bookFound = $book->getBookByID($bookID);
        $bookChapters = $chapter->getBookChapters($bookID); //list of chapters related to the specific book
        $spinoffs = $spinoff->where(['fromBook' => $bookID]);
        $bookRating = $rating->getBookRating($bookID);

        //check buy book with userID and bookID

        $this->view('book/Overview', ['book' => $bookFound, 'chapters' => $bookChapters, 'spinoffs' => $spinoffs, '374' => $bookRating]);
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

}