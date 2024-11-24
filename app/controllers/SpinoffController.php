<?php

class SpinoffController extends Controller
{
    public function index()
    {
        //display all spinoff section
    }

    public function New()
    {
        $URL = splitURL();
        $bookID = $URL[2];
        $book = new Book();
        $book_chapter = new BookChapter();

        $bookDetails = $book->first(['bookID' => $bookID]);
        $chapters = $book_chapter->getChapters($bookID);

        $this->view('Reader/writeSpinoff', ['book' => $bookDetails, 'chapters' => $chapters]);
    }

    public function Create()
    {
        $spinoff = new Spinoff();

        $title = $_POST['title'];
        $synopsis = $_POST['synopsis'];
        $bookID = $_POST['bookID'];
        $access = $_POST['access'];
        $chapter = $_POST['chapter'];
        $user = $_SESSION['user_id'];
        $datetime = date('Y-m-d H:i:s');

        $spinoff->insert(['title' => $title, 'synopsis' => $synopsis, 'creator' => $user, 'fromBook' => $bookID, 'accessType' => $access, 'startingChapter' => $chapter, 'isAcknowledge' => 0, 'lastUpdated' => $datetime]);

        header('location: /Free-Write/public/Book/Overview/' . $bookID);
    }

    public function Overview()
    {
        $URL = splitURL();
        $spinoffID = $URL[2];
        $spinoff = new Spinoff();
        $spinoff_chapter = new SpinoffChapter();

        $content = $spinoff->getSpinoffDetails($spinoffID);
        $chapters = $spinoff_chapter->where(['spinoff' => $spinoffID]);

        $this->view('spinoff/Overview', ['content' => $content, 'chapters' => $chapters]);
    }

    public function Edit()
    {
        //get spinoff content and the new writing page view values should be setted
    }

    public function Delete()
    {
        //delete the chapter
    }
}