<?php

class WriterController extends Controller
{
    public function index()
    {
        $this->Dashboard();
    }

    // DASHBOARD

    public function Dashboard()
    {
        $book = new Book();
        $author = $_SESSION['user_id'];

        //echo"<script>alert(".$_SESSION['user_id'].")</script>";

        $MyBooks = $book->getBookByAuthor($author);
        $this->view('writer/writerDashboard', ['MyBooks' => $MyBooks]);

    }


    // QUOTES
    public function Quotes()
    {
        $quoteModel = new Quote();

        // Fetch all quotes
        $quotes = $quoteModel->getQuotes();

        // Pass the quotes to the view
        $this->view('writer/quotes', ['quotes' => $quotes]);
    }

    public function NewQuote()
    {

        $this->view('writer/createQuote');
    }



    public function saveQuote()
    {
        $chapter = $_POST['chapter_name'] ?? '';
        $content = $_POST['quote'] ?? '';


        $quote = new Quote();

        if ($quote->insert(['chapter' => $chapter, 'quote' => $content])) {

            header('Location: /Free-Write/public/Writer/quotes');
        }

    }


    // SPINOFFS
    public function Spinoffs()
    {
        $this->view('writer/spin-offs');
    }

    public function ViewSpinoff()
    {
        $this->view('writer/spinoffDetails');
    }

    // COMPETITIONS
    public function Competitions()
    {
        $this->view('writer/competitions');
    }

    public function ViewCompetitions()
    {
        $this->view('writer/viewCompetitions');
    }


    public function NewCompetition()
    {
        $this->view('writer/createCompetition');
    }


    public function DeleteCompetition()
    {
        //implement delete competition
    }


    public function viewCompetition()
    {
        //implement view competition
    }

    //new book

    public function New()
    {
        $this->view('writer/createBook');
    }

    public function createBook()
    {
        $book = new Book();


        $title = $_POST['title'] ?? '';
        $synopsis = $_POST['Synopsis'] ?? '';
        $privacy = $_POST['privacy'] ?? 'public';
        $type = $_POST['type'] ?? 'book';
        //$coverFilePath = null;
        $datetime = date('Y-m-d H:i:s');
        $author = $_SESSION['user_id'];
        $price = $_POST['price'] ?? null;

        if ($book->insert(['title' => $title, 'Synopsis' => $synopsis, 'price' => $price, 'accessType' => $privacy, 'publishType' => $type, 'author' => $author, 'creationDate' => $datetime, 'lastUpdateDate' => $datetime, 'isCompleted' => 0])) {
            header('location: /Free-Write/public/Writer/');
            exit;
        } else {
            echo "Failed to create the book.";
        }
        ;
    }

    //edit book details
    public function Edit($bookID = 0)
    {
        $URL = splitURL();
        if ($URL[2] < 1)
            $this->view('error');

        if ($bookID < 1 || !is_numeric($bookID))
            $bookID = $URL[2]; //get the book id from the url

        $book = new Book();
        $bookDetails = $book->first(['bookID' => $bookID]);
        $this->view('writer/editBook', ['book' => $bookDetails]);
    }

    public function Update()
    {
        $bookID = $_POST['bID'];
        $title = $_POST['title'] ?? '';
        $Synopsis = $_POST['Synopsis'] ?? '';
        $accessType = $_POST['accessType'] ?? 'public';
        $publishType = $_POST['publishType'] ?? 'book';
        $author = $_SESSION['user_id'];
        $price = $_POST['price'] ?? null;

        $data = [
            'title' => $title,
            'Synopsis' => $Synopsis,
            'accessType' => $accessType,
            'publishType' => $publishType,
            'price' => $price,
            'author' => $author
        ];

        $book = new Book();

        if ($book->update($bookID, $data, 'bookID')) {
            header('location: /Free-Write/public/Writer/');
            exit;
        } else {
            echo "Failed to update the book.";
        }
    }



    public function Overview($bookID = 0)
    {
        $URL = splitURL();
        if ($URL[2] < 1)
            $this->view('error');

        if ($bookID < 1 || !is_numeric($bookID))
            $bookID = $URL[2]; //get the book id from the url

        $book = new Book();
        $bookChapter_table = new BookChapter();
        $bookFound = $book->getBookByID($bookID);
        $bookChapters = $bookChapter_table->getBookChapters($bookID); //list of chapters related to the specific book


        $this->view('writer/bookDetail', ['book' => $bookFound, 'chapters' => $bookChapters]);
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

        $this->view('writer/bookDetails', $chapterFound);
    }

    public function EditStory()
    {
        $this->view('writer/editStory');
    }


    public function GetChapters($bookID)
    {
        if (!is_numeric($bookID)) {
            http_response_code(400); // Bad Request
            echo json_encode(['error' => 'Invalid book ID']);
            exit;
        }

        $Chapter = new Chapter();
        $chapters = $Chapter->getChaptersByBookID($bookID);

        if ($chapters) {
            header('Content-Type: application/json');
            echo json_encode($chapters);
            error_log(json_encode($chapters)); // Log the chapters for debugging

        } else {
            http_response_code(404); // Not Found
            echo json_encode(['error' => 'No chapters found']);
        }
        exit;
    }

    public function saveChapter()
    {
        $title = $_POST['story-editor-chapter'] ?? '';
        $content = $_POST['story-editor'] ?? '';
        $datetime = date('Y-m-d H:i:s');
        $bookID = $_POST['bID'] ?? null;

        $chapter = new Chapter();

        if ($chapter->insert(['title' => $title, 'content' => $content, 'lastUpdated' => $datetime])) {
            /*    $chapterID = $chapter->lastInsertId();
            // Data for BookChapter table
            $data = [
                'book' => $bookID,
                'chapter' => $chapterID,
            ];

                $bookChapter = new BookChapter();

                $bookChapter->insert($data);
                exit;
            */
            header('Location: /Free-Write/public/Writer/');
        }

    }

    public function WriteStory($bookID = 0)
    {
        $URL = splitURL();
        if ($URL[2] < 1)
            $this->view('error');

        if ($bookID < 1 || !is_numeric($bookID))
            $bookID = $URL[2]; //get the book id from the url

        $book = new Book();
        $bookDetails = $book->first(['bookID' => $bookID]);
        $this->view('writer/WriteStory', ['book' => $bookDetails]);

    }

    public function DeleteBook()
    {
        $bookID = $_POST['bID'];

        $book = new Book(); // Instantiate the Book model

        // Attempt to delete the book
        if ($book->delete($bookID, 'bookID')) {
            header('location: /Free-Write/public/Writer/'); // Redirect to the writer dashboard
            exit;
        } else {
            die('Failed to delete the book.'); // Handle failure case
        }
    }

    public function DeleteChapter()
    {
        $chapterID = $_POST['cID'];

        $chapter = new Chapter();


        if ($chapter->delete($chapterID, 'chapterID')) {
            header('location: /Free-Write/public/Writer/'); // Redirect to the writer dashboard
            exit;
        } else {
            die('Failed to delete the book.'); // Handle failure case
        }
    }
}