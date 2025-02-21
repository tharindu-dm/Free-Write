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

        $userDetailsTable = new UserDetails();
        $userDetails = $userDetailsTable->first(['user' => $author]);

        $Followers = new Follow();
        $followers = $Followers->getFollowCount($author);
       
        $view = new Book();
        $totViewsArray = $view->getAuthorViews($author);
        $views = $totViewsArray[0]['totalViews'] ?? 0;

        $MyBooks = $book->getBookByAuthor($author);
        $this->view('writer/writerDashboard', ['MyBooks' => $MyBooks, 'userDetails' => $userDetails, 'followers' => $followers, 'views' => $views]);

    }


    // QUOTES
    public function Quotes()
    {
        $quoteModel = new Quote();
        $author = $_SESSION['user_id'];

        $userDetailsTable = new UserDetails();
        $userDetails = $userDetailsTable->first(['user' => $author]);

        $Followers = new Follow();
        $followers = $Followers->getFollowCount($author);

        $view = new Book();
        $totViewsArray = $view->getAuthorViews($author);
        $views = $totViewsArray[0]['totalViews'] ?? 0;

        // Fetch all quotes
        $quotes = $quoteModel->getQuoteByAuthor($author);

        // Pass the quotes to the view
        $this->view('writer/quotes', ['quotes' => $quotes, 'userDetails' => $userDetails, 'followers' => $followers, 'views' => $views]);
    }
    
    public function ViewQuote($qID = 0)
    {
        $URL = splitURL();
        if ($URL[2] < 1)
            $this->view('error');

        if ($qID < 1 || !is_numeric($qID))
            $qID = $URL[2]; 

        $quote = new Quote();
        $quoteDetails = $quote->getQuoteByID($qID);
        $this->view('writer/viewQuote', ['quote' => $quoteDetails]);
    }

    public function NewQuote()
    {
        $book = new Book();
        $book_chapter = new BookChapter();
        $author = $_SESSION['user_id'];
    
        // Fetch all books of the author
        $MyBooks = $book->getBookByAuthor($author);
    
        // Check if the request is AJAX and contains book_id
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['book_id'])) {
            $bookID = $_POST['book_id'];
    
            $chapters = $book_chapter->getChapters($bookID);
    
            // Return JSON response for AJAX
            header('Content-Type: application/json');
            echo json_encode($chapters);
            exit;
        }
    
        // Load the view with books, no chapters initially
        $this->view('writer/createQuote', ['books' => $MyBooks, 'chapters' => []]);
    }
    
    public function editQuote($qID = 0){
        $URL = splitURL();
        if ($URL[2] < 1)
            $this->view('error');

        if ($qID < 1 || !is_numeric($qID))
            $qID = $URL[2]; 

            $quote = new Quote();
            $quoteDetails = $quote->getQuoteByID($qID);
            $this->view('writer/editQuote', ['quote' => $quoteDetails]);
    }
    

    public function saveQuote()
    {
        $chapter= $_POST['chapter'] ?? '';
        $content = $_POST['quote'] ?? '';
        

        $quote = new Quote();

        if ($quote->insert(['chapter' => $chapter, 'quote' => $content])) {
        
        header('Location: /Free-Write/public/Writer/quotes');
    }
    

}
    public function updateQuote()
    {
        $quoteID = $_POST['quoteID'];
        $content = $_POST['quote'] ?? '';

        $data = [
            'quote' => $content,
        ];
    $quote = new Quote();

    if ($quote->update($quoteID, $data, 'quoteID')) {
        header('location: /Free-Write/public/Writer/Quotes');
        exit;
    } else {
        echo "Failed to update the book.";
    }
}

public function deleteQuote($qID = 0)
{
    $URL = splitURL();
    if (!isset($URL[2]) || $URL[2] < 1) {
        $this->view('error');
        return;
    }

    if ($qID < 1 || !is_numeric($qID)) {
        $qID = $URL[2]; 
    }

    $quote = new Quote();

    if ($quote->delete($qID, 'quoteID')) {
        header('Location: /Free-Write/public/Writer/Quotes');
        exit;
    } else {
        die('Failed to delete the quote.');
    }
}



    // SPINOFFS
    public function Spinoffs()
    {
        $author = $_SESSION['user_id'];

        $pendingSpinoff = new Spinoff();
        $pendingSpinoffDetails = $pendingSpinoff->getPendingSpinoff($author);

        $rejectedSpinoff = new Spinoff();
        $rejectedSpinoffDetails = $rejectedSpinoff->getRejectedSpinoff($author);

        $acceptedSpinoff = new Spinoff();
        $acceptedSpinoffDetails = $acceptedSpinoff->getAcceptedSpinoff($author);

        $userDetailsTable = new UserDetails();
        $userDetails = $userDetailsTable->first(['user' => $author]);

        $Followers = new Follow();
        $followers = $Followers->getFollowCount($author);

        $view = new Book();
        $totViewsArray = $view->getAuthorViews($author);
        $views = $totViewsArray[0]['totalViews'] ?? 0;

        $this->view('writer/spin-offs',['userDetails' => $userDetails, 'followers' => $followers, 'pendingSpinoffs' => $pendingSpinoffDetails, 'acceptedSpinoffs' => $acceptedSpinoffDetails,'rejectedSpinoffs' => $rejectedSpinoffDetails, 'views' => $views]);
    }

    public function ViewSpinoff($sID = 0)
    {
        $URL = splitURL();
        if ($URL[2] < 1)
            $this->view('error');

        if ($sID < 1 || !is_numeric($sID))
            $sID = $URL[2]; 

        $spinoff = new Spinoff();
        $spinoffDetails = $spinoff->getSpinoffDetails($sID);
        $spinoffDetails = $spinoffDetails[0] ?? [];
        $this->view('writer/viewSpinoff', ['spinoff' => $spinoffDetails]);
    }

    public function acceptSpinoff($sID = 0)
    {
        $URL = splitURL();
        if ($URL[2] < 1)
            $this->view('error');

        if ($sID < 1 || !is_numeric($sID))
            $sID = $URL[2]; 
        $data = [
            'isAcknowledge' => 1,
            'lastUpdated' => date('Y-m-d H:i:s')
        ];

        $spinoff = new Spinoff();
        if($spinoff->update($sID, $data, 'spinoffID')){   $this->Spinoffs();
            exit;
        } else {
            echo "Failed to accept the spinoff.";
        }

        $this->Spinoffs();
    }

    public function rejectSpinoff($sID = 0)
    {
        $URL = splitURL();
        if ($URL[2] < 1)
            $this->view('error');

        if ($sID < 1 || !is_numeric($sID))
            $sID = $URL[2]; 
        $data = [
            'isAcknowledge' => 2,
            'lastUpdated' => date('Y-m-d H:i:s')
        ];

        $spinoff = new Spinoff();
        if($spinoff->update($sID, $data, 'spinoffID')){   $this->Spinoffs();
            exit;
        } else {
            echo "Failed to reject the spinoff.";
        }

        $this->Spinoffs();
    }

    // COMPETITIONS
    public function Competitions()
    {
        $author = $_SESSION['user_id'];
        $userDetailsTable = new UserDetails();
        $userDetails = $userDetailsTable->first(['user' => $author]);

        $Followers = new Follow();
        $followers = $Followers->getFollowCount($author);

        $view = new Book();
        $totViewsArray = $view->getAuthorViews($author);
        $views = $totViewsArray[0]['totalViews'] ?? 0;

        $this->view('writer/competitions',['userDetails' => $userDetails, 'followers' => $followers, 'views' => $views]);
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



    public function Overview($bookID = 0)
    {
        $URL = splitURL();
        if ($URL[2] < 1)
            $this->view('error');

        if ($bookID < 1 || !is_numeric($bookID))
            $bookID = $URL[2]; //get the book id from the url

        $book = new Book();
        $rating = new Rating();
        $bookChapter_table = new BookChapter();
        $bookFound = $book->getBookByID($bookID);
        $bookRating = $rating->getBookRating($bookID);
        $bookChapters = $bookChapter_table->getBookChapters($bookID); //list of chapters related to the specific book


        $this->view('writer/bookDetail', ['book' => $bookFound, 'chapters' => $bookChapters, 'rating' => $bookRating]);
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

    public function editChapter($chapterID = 0)
    {
        $URL = splitURL();
        if ($URL[2] < 1)
            $this->view('error');

        if ($chapterID < 1 || !is_numeric($chapterID))
            $chapterID = $URL[2]; //get the book id from the url

        $chapter = new Chapter();
        $chapterDetails = $chapter->getChapterByID($chapterID);
        $this->view('writer/editStory', ['chapter' => $chapterDetails]);
    }

    public function UpdateChapter()
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