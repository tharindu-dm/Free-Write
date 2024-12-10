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
        if ($URL[2] < 1) {
            $this->view('error');
            return;
        }

        if ($bookID < 1 || !is_numeric($bookID)) // if the book id is not valid
            $bookID = $URL[2]; //get the book id from the url

        $book = new Book();
        $BookChapter_table = new BookChapter();
        $spinoff = new Spinoff();
        $buybook = new BuyBook();
        $bookList = new BookList();
        $rating = new Rating();

        $bookFound = $book->getBookByID($bookID);
        $bookChapters = $BookChapter_table->getBookChapters($bookID); //list of chapters related to the specific book
        $spinoffs = $spinoff->where(['fromBook' => $bookID]);
        $bookRating = $rating->getBookRating($bookID);
        $bookBought = null;
        $bookInListStatus = null;
        $chapterProgress = null;

        if (isset($_SESSION['user_id'])) {
            $bookBought = $buybook->first(['user' => $_SESSION['user_id'], 'book' => $bookID]);
            if ($bookBought)
                $bookBought = true;
            else
                $bookBought = false;
            $bookInList = $bookList->first(['user' => $_SESSION['user_id'], 'book' => $bookID]);
            if ($bookInList) {
                $bookInListStatus = $bookInList['status'];
                $chapterProgress = $bookInList['chapterProgress'];
            }
        }

        //if the user decided to see a book and that book is added to the viewed list to avoid viewCount++ abuse
        if (!isset($_SESSION['viewed_books'])) {
            $_SESSION['viewed_books'] = [];
        }

        if (!in_array($bookFound[0]['bookID'], $_SESSION['viewed_books'])) {
            //increase viewCOunt of the book
            $book->update($bookID, ['viewCount' => $bookFound[0]['viewCount'] + 1], 'bookID');

            // Add the book ID to the session
            $_SESSION['viewed_books'][] = $bookID;
        }

        $this->view(
            'book/Overview',
            [
                'book' => $bookFound,
                'chapters' => $bookChapters,
                'spinoffs' => $spinoffs,
                'rating' => $bookRating,
                'bought' => $bookBought,
                'inList' => $bookInListStatus,
                'chapterProgress' => $chapterProgress
            ]
        );


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
        $bookchap = new BookChapter();
        $chapterFound = $chapter->getChapterByID($chapterID);
        $chapterList = $bookchap->getBookChapters($chapterFound['title_author'][0]['BookID']);

        $this->view('book/Chapter', ['chapterDetails' => $chapterFound, 'chapterList' => $chapterList]);
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