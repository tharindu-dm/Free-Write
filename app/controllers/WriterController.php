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
   /* if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $quoteModel = new Quote();

        $title = isset($_POST['book_title']) ? trim($_POST['book_title']) : '';
        $quoteText = isset($_POST['quote']) ? trim($_POST['quote']) : '';


        // Add the quote to the database
        $success = $quoteModel->addQuote(['book_title' => $title, 'quote' => $quoteText]);

        if ($success) {
            $_SESSION['success'] = 'Quote added successfully!';
            header('Location: /Free-Write/public/Writer/Quotes');
            exit;
        } else {
            $_SESSION['error'] = 'Failed to add the quote. Please try again.';
            header('Location: /Free-Write/public/Writer/NewQuote');
            exit;
        }
    } else {
        // Show the quote creation form */
        $this->view('writer/createQuote');
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
    $synopsis = $_POST['synopsis'] ?? '';
    $privacy = $_POST['privacy'] ?? 'public';
    $type = $_POST['type'] ?? 'book';
    //$coverFilePath = null;
    $datetime = date('Y-m-d H:i:s');
    $author = $_SESSION['user_id'];
    $price = $_POST['price'] ?? null;

    if($book->insert(['title' => $title, 'Synopsis' => $synopsis, 'price' => $price, 'accessType' => $privacy, 'publishType' => $type, 'author' => $author, 'creationDate' => $datetime, 'lastUpdateDate' => $datetime, 'isCompleted' => 0])){
        header('location: /Free-Write/public/Writer/');
        exit;
    } else {
        echo "Failed to create the book.";
    };
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
    $bookDetails = $book->first(['bookID'=>$bookID]);
    $this->view('writer/editBook', ['book' => $bookDetails]);
}

public function Update()
    {
        $bookID = $_POST['bID'] ;      
        $title = $_POST['title'] ?? '';
        $Synopsis = $_POST['Synopsis'] ?? '';
        $accessType = $_POST['accessType'] ?? 'public';
        $publishType = $_POST['publishType'] ?? 'book';
        $author = $_SESSION['user_id'];
        $price = $_POST['price'] ?? null;
    
        $data = [
            'title' => $title,
            'Synopsis' => $Synopsis,
            'accessType' => $accessType ,
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

public function WriteStory()
    {
        $this->view('writer/writeStory');
        
    }

public function Delete($bookID = 0)
    {
        $URL = splitURL(); // Extract the URL segments
        
        // Validate the bookID, either from the parameter or the URL
        if ($bookID < 1 || !is_numeric($bookID)) {
            if (isset($URL[2]) && is_numeric($URL[2])) {
                $bookID = $URL[2]; // Get the book ID from the URL
            } else {
                $this->view('error'); // Redirect to an error page if no valid book ID is provided
                return;
            }
        }
    
        $book = new Book(); // Instantiate the Book model
    
        // Attempt to delete the book
        if ($book->delete($bookID, 'bookID')) {
            header('location: /Free-Write/public/Writer/'); // Redirect to the writer dashboard
            exit;
        } else {
            die('Failed to delete the book.'); // Handle failure case
        }
    }
}