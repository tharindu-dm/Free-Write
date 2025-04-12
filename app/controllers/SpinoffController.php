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
        $book_chapter = new BookChapter();

        $chapters = [];
        $bookChapters = [];

        $content = $spinoff->getSpinoffDetails($spinoffID);

        if (empty($content)) {
            $this->view('error');
            return;
        }

        $chapters = $spinoff_chapter->getChapters($spinoffID);
        $bookChapters = $book_chapter->getChapters($content[0]['fromBookID']);

        $this->view('spinoff/Overview', ['content' => $content[0], 'chapters' => $chapters, 'bookChapters' => $bookChapters]);
    }

    public function ChapEdit()
    {
        //get spinoff content and the new writing page view values should be setted $spinoffID = $_GET['spinoff'];
        $chapID = splitURL()[2];
        $Chapter = new Chapter();
        $spinoff = new Spinoff();

        $spinoffDetails = $spinoff->getFromChapterID($chapID);
        $ChapterDetails = $Chapter->first(['chapterID' => $chapID]);
        $data =
            [
                'spinoff' => $spinoffDetails[0],
                'chapter' => $ChapterDetails
            ];
        $this->view('spinoff/createChapter', $data);
    }

    public function deleteChap()
    {
        //delete the chapter
        $Chapter = new Chapter();
        $spinoffChapter = new SpinoffChapter();

        $chapterID = $_POST['chapterID'];
        $spinoffID = $_POST['spinoffID'];

        $spinoffChapter->delete($chapterID, 'chapter');
        $Chapter->delete($chapterID, 'chapterID');

        header('location: /Free-Write/public/Spinoff/Overview/' . $_POST['spinoffID']);
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

    public function updateChapter()
    {
        $Chapter = new Chapter();

        $chapterID = $_POST['chapterID'];
        $spinoffID = $_POST['spinoffID'];
        $chapterTitle = $_POST['chapter_title'];
        $chapterContent = $_POST['chapter_content'];
        $datetime = date('Y-m-d H:i:s');

        $Chapter->update(
            $chapterID,
            ['title' => $chapterTitle, 'content' => $chapterContent, 'lastUpdated' => $datetime],
            'chapterID'
        );

        header('location: /Free-Write/public/Spinoff/Overview/' . $spinoffID);
    }

    public function Chapter($chapterID = 0)
    { //read the spinoff chapter

        $URL = splitURL();

        if ($URL[2] < 1) {
            $this->view('error');
        }
        if ($chapterID < 1 || !is_numeric($chapterID))
            $chapterID = $URL[2]; //get the chapter id from the url

        $chapter = new Chapter();
        $spinoffchap = new SpinoffChapter();
        $chapterFound = $chapter->getSpinoffChapterByID($chapterID);
        $chapterList = $spinoffchap->getChapters($chapterFound['title_author'][0]['BookID']);

        $this->view('book/Chapter', ['chapterDetails' => $chapterFound, 'chapterList' => $chapterList]);
    }

    public function editSpinoff()
    {
        $spinoff = new Spinoff();
        $spinoffID = $_POST['spinoffID'];
        $title = $_POST['title'];
        $synopsis = $_POST['synopsis'];
        $access = $_POST['access'];
        $chapter = $_POST['chapter'];
        $datetime = date('Y-m-d H:i:s');

        $spinoff->update($spinoffID, ['title' => $title, 'synopsis' => $synopsis, 'accessType' => $access, 'startingChapter' => $chapter, 'lastUpdated' => $datetime], 'spinoffID');

        header('location: /Free-Write/public/Spinoff/Overview/' . $spinoffID);
    }

    public function deleteSpinoff()
    {
        //remove spinoff chapters from spinoffchapters, comments then chapters, then spinoff

        $spinoffChapter = new SpinoffChapter();
        //$spinoffComment = new Comment(); -handled by trigger
        //$Chapter = new Chapter(); -handled by trigger
        $spinoff = new Spinoff();

        $spinoffID = $_POST['spinoffID'];
        $spinoffChapter->deleteChapters($spinoffID);
        $spinoff->delete($spinoffID, 'spinoffID');

        header('location: /Free-Write/public/Spinoff/Overview/' . $spinoffID);
        
    }
}