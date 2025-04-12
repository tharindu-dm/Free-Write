<?php

class WriterController extends Controller
{
    public function index()
    {
        $this->DashboardNew();
    }

    public function DashboardNew()
    {   
        $book = new Book();
        $author = $_SESSION['user_id'];

        $MyBooks = $book->getBookByAuthor($author);
        if(empty($MyBooks)){
            header('Location: /Free-Write/public/Writer/DashboardNewView');
        exit;
        }else{
            header('Location: /Free-Write/public/Writer/Dashboard');
        exit;
        }
    }

    public function DashboardNewView()
{
    $author = $_SESSION['user_id'];
    $userDetailsTable = new UserDetails();
    $userDetails = $userDetailsTable->first(['user' => $author]);

    $this->view('writer/writerDashboardNew', ['userDetails' => $userDetails]);
}


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
        $competition = new Competition();
        $competitions = $competition->getCompetitionByWriterID($author);

        $Followers = new Follow();
        $followers = $Followers->getFollowCount($author);

        $view = new Book();
        $totViewsArray = $view->getAuthorViews($author);
        $views = $totViewsArray[0]['totalViews'] ?? 0;

        $this->view('writer/competitions',['userDetails' => $userDetails, 'followers' => $followers, 'views' => $views, 'competitions' => $competitions]);
    }

    public function NewCompetition()
    {
        $genre = new Genre();
        $genres = $genre->getGenres();
        $this->view('writer/createCompetition' , ['genres' => $genres]);
    }

    public function createCompetition()
    {
        $competition = new Competition();

        $title = $_POST['title'] ?? '';
        $synopsis = $_POST['Synopsis'] ?? '';
        $author = $_SESSION['user_id'];
        $price = $_POST['price'] ?? null;
        $startDate = date('Y-m-d');
        $endDate = date('Y-m-d', strtotime('+2 months'));
        $genre = $_POST['genre'];

        if ($competition->insert(['title' => $title, 'description' => $synopsis, 'first_prize' => $price, 'publisherID' => $author, 'start_date' => $startDate, 'end_date' => $endDate, 'category' => $genre])) {
            header('location: /Free-Write/public/Writer/Competitions');
            exit;
        } else {
            echo "Failed to create the competition.";
        }
    }
    public function ViewCompetition($competitionID = 0)
    {
        $URL = splitURL();
        if ($URL[2] < 1)
            $this->view('error');

        if ($competitionID < 1 || !is_numeric($competitionID))
            $competitionID = $URL[2]; 

        $competition = new Competition();
        $competitionDetails = $competition->first(['competitionID' => $competitionID]);
        $this->view('writer/viewCompetition', ['competition' => $competitionDetails]);
    }
    
    
    public function editCompetition($competitionID = 0)
    {
        $URL = splitURL();
        if ($URL[2] < 1)
            $this->view('error');

        if ($competitionID < 1 || !is_numeric($competitionID))
            $competitionID = $URL[2]; //get the competition id from the url

        $competition = new Competition();
        $competitionDetails = $competition->first(['competitionID' => $competitionID]);
        $this->view('writer/editCompetition', ['competition' => $competitionDetails]);
    }
    public function UpdateCompetition()
    {
        $competitionID = $_POST['cID'];
        $title = $_POST['title'] ?? '';
        $Synopsis = $_POST['description'] ?? '';
        $price = $_POST['price'] ?? null;

        $data = [
            'title' => $title,
            'description' => $Synopsis,
            'first_prize' => $price
        ];

        $competition = new Competition();

        if ($competition->update($competitionID, $data, 'competitionID')) {
            header('location: /Free-Write/public/Writer/Competitions');
            exit;
        } else {
            echo "Failed to update the competition.";
        }
    }
    public function DeleteCompetition($cID = 0)
    {
        $URL = splitURL();
        if ($URL[2] < 1)
            $this->view('error');
        if ($cID < 1 || !is_numeric($cID))
            $cID = $URL[2]; //get the competition id from the url

        $competition = new Competition(); 

        // Attempt to delete the competition
        if ($competition->delete($cID, 'competitionID')) {
            header('location: /Free-Write/public/Writer/Competitions'); // Redirect to the writer dashboard
            exit;
        } else {
            die('Failed to delete the competition.'); // Handle failure case
        }
    }

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
        $status = $_POST['status'] ?? '0';
        $author = $_SESSION['user_id'];
        $price = $_POST['price'] ?? null;

        $data = [
            'title' => $title,
            'Synopsis' => $Synopsis,
            'accessType' => $accessType,
            'publishType' => $publishType,
            'price' => $price,
            'author' => $author,
            'isCompleted' => $status
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

        $book = new Book(); 


        // Attempt to delete the book
        if ($book->update($bookID, ['accessType' => 'deleted'], 'bookID'))  {
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
        $spinoff = new Spinoff();
        $spinoffs = $spinoff->where(['fromBook' => $bookID]);

        $rating = new Rating();
        $bookChapter_table = new BookChapter();
        $bookFound = $book->getBookByID($bookID);
        $bookRating = $rating->getBookRating($bookID);
        $bookChapters = $bookChapter_table->getBookChapters($bookID); //list of chapters related to the specific book


        $this->view('writer/bookDetail', ['book' => $bookFound, 'chapters' => $bookChapters, 'rating' => $bookRating, 'spinoffs' => $spinoffs]);
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


    public function editChapter($chapterID = 0)
    {
        $URL = splitURL();
        if ($URL[2] < 1)
            $this->view('error');

        if ($chapterID < 1 || !is_numeric($chapterID))
            $chapterID = $URL[2]; 

        $chapters = new Chapter();
        $chapterDetails = $chapters->getChapterByID($chapterID);
        
        $chapter = $chapterDetails['title_author'][0];

        $this->view('writer/editStory', ['chapter' => $chapter]);
    }

    public function UpdateChapter()
    {
        $Chapter = new Chapter();
        $chapterID = $_POST['chapterID'];

        $bookID = $_POST['BookID'];
        $chapterTitle = $_POST['story-editor-chapter'] ?? '';
        $chapterContent = $_POST['story-editor'] ?? '';
        $datetime = date('Y-m-d H:i:s');

        $Chapter->update(
            $chapterID,
            ['title' => $chapterTitle, 'content' => $chapterContent, 'lastUpdated' => $datetime],
            'chapterID'
        );
        header('Location: /Free-Write/public/Writer/Overview/' . $bookID);
        exit;
    }


    public function writeChapter($bookID = 0)
    {
        $URL = splitURL();
        if ($URL[2] < 1)
            $this->view('error');

        if ($bookID < 1 || !is_numeric($bookID))
            $bookID = $URL[2]; 

        $book = new Book();
        $bookChapter = new BookChapter();

        $bookDetails = $book->first(['bookID' => $bookID]);
        $chapters = $bookChapter->where(['book' => $bookID]);
        $chapterCount = count($chapters)+1;

        $this->view('writer/writeStory', ['book' => $bookDetails, 'chapterCount' => $chapterCount]);

    }

    public function saveChapter()
    {
        $Chapter = new Chapter();
        $bookChapter = new BookChapter();

        $bookID = $_POST['bookID'];
        $title = $_POST['story-editor-chapter'] ?? '';
        $content = $_POST['story-editor'] ?? '';
        $datetime = date('Y-m-d H:i:s');

        

        $Chapter->insert(['title' => $title, 'content' => $content, 'lastUpdated' => $datetime]);

        $chapterID = $Chapter->first(['title' => $title, 'content' => $content, 'lastUpdated' => $datetime])['chapterID'];

        $bookChapter->insert(['book' => $bookID, 'chapter' => $chapterID]);

        header('Location: /Free-Write/public/Writer/Overview/' . $bookID);
        exit;
}

public function deleteChapter()
{
    if (!isset($_POST['chapterID']) || !isset($_POST['BookID'])) {
        die('Invalid request');
    }

    $chapterID = $_POST['chapterID'];
    $bookID = $_POST['BookID'];

    $chapter = new Chapter();
    $bookChapter = new BookChapter();
    $comment = new Comment();

    $bookChapter->delete($chapterID, 'chapter');
    $comment->delete($chapterID, 'chapter');

    // Now delete the chapter
    if ($chapter->delete($chapterID, 'chapterID')) {
        header('Location: /Free-Write/public/Writer/Overview/' . $bookID);
        exit;
    } else {
        die('Failed to delete the chapter.');
    }
}


public function Quotations() {
        $author = $_SESSION['user_id'];
        $userDetailsTable = new UserDetails(); $userDetails = $userDetailsTable->first(['user' => $author]);

        $Followers = new Follow();
        $followers = $Followers->getFollowCount($author);

        $view = new Book();
        $totViewsArray = $view->getAuthorViews($author);
        $views = $totViewsArray[0]['totalViews'] ?? 0;

        $quotation = new Quotation();
        $quotations = $quotation->getQuotaByAuthor($author);

        $this->view('writer/quotations',['userDetails' => $userDetails, 'followers' => $followers, 'views' => $views, 'quotas' => $quotations]);
}

public function ViewQuota(){
    $URL = splitURL();
    if ($URL[2] < 1)
        $this->view('error');

    $qID = $URL[2]; 

    $quotation = new Quotation();
    $quotationDetails = $quotation->getQuotaByID($qID);
    $this->view('writer/viewQuota', ['quota' => $quotationDetails]);
}

public function RequestPublisher(){
    $this->view('writer/publishers');

}

public function ViewWriter(){
    $author = $_SESSION['user_id'];

    $userDetailsTable = new UserDetails();
    $userDetails = $userDetailsTable->first(['user' => $author]);
   
    $mostViewed = new Book();
    $latest = new Book();

    $quoteModel = new Quote();
    $quotes = $quoteModel->getQuoteByAuthor($author);

    $MostViewed = $mostViewed->getMostViewedBooks($author);
    $Latest = $latest->getLatestBooks($author);

    $this->view('writer/viewWriter', ['userDetails' => $userDetails, 'quotes' => $quotes, 'MostViewed' => $MostViewed, 'Latest' => $Latest]);
}

}
