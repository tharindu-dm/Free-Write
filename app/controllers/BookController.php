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
        $BookChapter_table = new BookChapter();
        $spinoff = new Spinoff();
        $buybook = new BuyBook();
        //addline to get place in BookLIst of user
        $rating = new Rating();

        $bookFound = $book->getBookByID($bookID);
        $bookChapters = $BookChapter_table->getBookChapters($bookID); //list of chapters related to the specific book
        $spinoffs = $spinoff->where(['fromBook' => $bookID]);
        $bookRating = $rating->getBookRating($bookID);

        //check buy book with userID and bookID

        $this->view('book/Overview', ['book' => $bookFound, 'chapters' => $bookChapters, 'spinoffs' => $spinoffs, 'rating' => $bookRating]);
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

    public function AddRating()
    {
        $rating = new Rating();
        $bookID = $_POST['book_id'];
        $userID = $_SESSION['user_id'];
        $ratingValue = $_POST['rating'];

        $rating_exists = $rating->where(['book' => $bookID, 'user' => $userID]);

        if ($rating_exists) {
            $rating->updateRating($ratingValue, $bookID, $userID);

        } else {
            $rating->insert(['book' => $bookID, 'user' => $userID, 'rating' => $ratingValue]);
        }

        header('Location: /Free-Write/public/Book/Overview/' . $bookID);
    }

}