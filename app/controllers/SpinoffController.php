<?php

class SpinoffController extends Controller
{
    public function index()
    {
        $this->view('error');
    }

    public function New()
    {
        $URL = splitURL();
        $bookID = $URL[2];
        $book = new Book();
        $book_chapter = new BookChapter();

        $bookDetails = $book->first(['bookID' => $bookID]);
        $chapters = $book_chapter->getChapters($bookID);

        $this->view('Spinoff/writeSpinoff', ['book' => $bookDetails, 'chapters' => $chapters]);
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

        $chapters = [];

        $content = $spinoff->getSpinoffDetails($spinoffID);
        $chapters = $spinoff_chapter->getChapters($spinoffID);


        $this->view('spinoff/Overview', ['content' => $content[0], 'chapters' => $chapters]);
    }

    public function Edit()
    {
        //get spinoff content and the new writing page view values should be setted
    }

    public function Delete()
    {
        //delete the chapter
    }

    public function write_chapter()
    {
        $spinoffID = $_GET['spinoff'];
        $spinoff = new Spinoff();



        $spinoffDetails = $spinoff->first(['spinoffID' => $spinoffID]);
        $data =
            [
                'spinoff' => $spinoffDetails
            ];
        $this->view('spinoff/createChapter', $data);
    }

    public function saveChapter()
    {
        $Chapter = new Chapter();
        $spinoffChapter = new SpinoffChapter();

        $spinoffID = $_POST['spinoffID'];
        $chapterTitle = $_POST['chapter_title'];
        $chapterContent = $_POST['chapter_content'];
        $datetime = date('Y-m-d H:i:s');

        $Chapter->insert(['title' => $chapterTitle, 'content' => $chapterContent, 'lastUpdated' => $datetime]);

        $chapterID = $Chapter->first(['title' => $chapterTitle, 'content' => $chapterContent, 'lastUpdated' => $datetime])['chapterID'];

        $spinoffChapter->insert(['spinoff' => $spinoffID, 'chapter' => $chapterID]);

        header('location: /Free-Write/public/Spinoff/Overview/' . $spinoffID);
    }
}