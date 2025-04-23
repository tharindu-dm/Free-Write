<?php
class WriterController extends Controller
{
    public function index()
    {
        $this->DashboardNew();
    }
//dashboard---------------------------------------------------------------------------------
    public function DashboardNew()
    {
        $book = new Book();

        if (isset($_SESSION['user_id'])) {
            if (isset($_GET['writer']) && $_GET['writer'] == $_SESSION['user_id'])
                header('Location: /Free-Write/public/Writer/DashboardNew'); //to avoid user to see his own public view profile.
        } else {
            header('Location: /Free-Write/public/Login');
        }
        $author = isset($_GET['writer']) ? $_GET['writer'] : $_SESSION['user_id'];

        $MyBooks = $book->getBookByAuthor($author);
        if (empty($MyBooks)) {
            if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'writer') {
                $userDetails = new User();
                $userDetails->update($author, ['userType' => 'reader'], 'userID');//if wricov =>covdes

                $_SESSION['user_type'] = 'reader';
            } elseif (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'wricov') {
                $userDetails = new User();
                $userDetails->update($author, ['userType' => 'covdes'], 'userID');
                $_SESSION['user_type'] = 'covdes';
            }

            $this->DashboardNewView($author);
            exit;
        } else {
            if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'reader') {
                //wricov if cover
                $userDetails = new User();
                $userDetails->update($author, ['userType' => 'writer'], 'userID');
                $_SESSION['user_type'] = 'writer';
            } elseif (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'covdes') {
                $userDetails = new User();
                $userDetails->update($author, ['userType' => 'wricov'], 'userID');
                $_SESSION['user_type'] = 'wricov';
            }


            $this->Dashboard($author);
            exit;
        }
    }

    public function DashboardNewView($author)
    {
        //var_dump($_SESSION['user_type']);
        //$author = $_SESSION['user_id'];
        $userDetailsTable = new UserDetails();
        $userDetails = $userDetailsTable->first(['user' => $author]);

        $this->view('writer/writerDashboardNew', ['userDetails' => $userDetails]);
    }


    public function Dashboard($author)
    {
        // Fetch user details
        $userDetailsTable = new UserDetails();
        $userDetails = $userDetailsTable->first(['user' => $author]);

        // Fetch follower count
        $Followers = new Follow();
        $followers = $Followers->getFollowCount($author);

        // Fetch total views for the author
        $view = new Book();
        $totViewsArray = $view->getAuthorViews($author);
        $views = $totViewsArray[0]['totalViews'] ?? 0;

        // Fetch books by the author
        $book = new Book();
        $MyBooks = $book->getBookByAuthor($author);

        // Fetch genre for each book
        $bookGenre = new BookGenre();
        foreach ($MyBooks as $key => $bookItem) {
            $genreDetails = $bookGenre->getBookGenre($bookItem['bookID']);  // Get genre for each book
            $MyBooks[$key]['genre'] = $genreDetails;  // Add genre details to the book
        }

        // Pass the data to the view
        $this->view('writer/writerDashboard', [
            'MyBooks' => $MyBooks,
            'userDetails' => $userDetails,
            'followers' => $followers,
            'views' => $views
        ]);

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
        $genreDetails = new BookGenre();
        $genres = $genreDetails->getBookGenre($bookID);
        $bookFound = $book->getBookByID($bookID);
        $bookRating = $rating->getBookRating($bookID);
        $bookChapters = $bookChapter_table->getBookChapters($bookID); //list of chapters related to the specific book


        $this->view('writer/bookDetail', ['book' => $bookFound, 'chapters' => $bookChapters, 'rating' => $bookRating, 'spinoffs' => $spinoffs, 'genres' => $genres]);
    }

// QUOTES---------------------------------------------------------------------------------
    public function Quotes()
    {
        if (isset($_SESSION['user_id'])) {
            if (isset($_GET['writer']) && $_GET['writer'] == $_SESSION['user_id'])
                header('Location: /Free-Write/public/Writer/Quotes'); //to avoid user to see his own public view profile.
        } else {
            header('Location: /Free-Write/public/Login');
        }
        $author = isset($_GET['writer']) ? $_GET['writer'] : $_SESSION['user_id'];
        $quoteModel = new Quote();
       // $author = $_SESSION['user_id'];

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

        $author = $quoteDetails['userID'];
        $userDetailsTable = new UserDetails();
        $userDetails = $userDetailsTable->first(['user' => $author]);

        $this->view('writer/viewQuote', ['quote' => $quoteDetails, 'userDetails' => $userDetails]);
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

            $chapters = $book_chapter->getBookChapters($bookID);

            // Return JSON response for AJAX
            header('Content-Type: application/json');
            echo json_encode($chapters);
            exit;
        }

        // Load the view with books, no chapters initially
        $this->view('writer/createQuote', ['books' => $MyBooks, 'chapters' => []]);
    }

    public function editQuote($qID = 0)
    {
        $URL = splitURL();
        if ($URL[2] < 1)
            $this->view('error');

        if ($qID < 1 || !is_numeric($qID))
            $qID = $URL[2];

        $quote = new Quote();
        $quoteDetails = $quote->getQuoteByID($qID);

        $author = $quoteDetails['userID'];
        $userDetailsTable = new UserDetails();
        $userDetails = $userDetailsTable->first(['user' => $author]);

        $book_chapter = new BookChapter();
        $chapters = $book_chapter->getBookChapters($quoteDetails['bookID']);


        $this->view('writer/editQuote', ['quote' => $quoteDetails, 'chapters' => $chapters, 'userDetails' => $userDetails]);
    }


    public function saveQuote()
    {
        $chapter = $_POST['chapter'] ?? '';
        $content = $_POST['quote'] ?? '';
        if (strlen($content) >= 255) {
            echo "Quote must be less than 255 characters.";
            exit;
        }


        $quote = new Quote();

        if ($quote->insert(['chapter' => $chapter, 'quote' => $content])) {

            header('Location: /Free-Write/public/Writer/quotes');
        }


    }
    public function updateQuote()
    {
        $quoteID = $_POST['quoteID'];
        $content = $_POST['quote'] ?? '';
        if (strlen($content) >= 255) {
            echo "Quote must be less than 255 characters.";
            exit;
        }

        $chapter = $_POST['chapter'] ?? '';

        $data = [
            'quote' => $content,
            'chapter' => $chapter
        ];
        $quote = new Quote();

        if ($quote->update($quoteID, $data, 'quoteID')) {
            header('location: /Free-Write/public/Writer/ViewQuote/' . $quoteID);
            exit;
        } else {
            echo "Failed to update the quote.";
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



// SPINOFFS---------------------------------------------------------------------------------
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

        $this->view('writer/spin-offs', ['userDetails' => $userDetails, 'followers' => $followers, 'pendingSpinoffs' => $pendingSpinoffDetails, 'acceptedSpinoffs' => $acceptedSpinoffDetails, 'rejectedSpinoffs' => $rejectedSpinoffDetails, 'views' => $views]);
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
        if ($spinoff->update($sID, $data, 'spinoffID')) {
            header('Location: /Free-Write/public/Writer/Spinoffs');
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
        if ($spinoff->update($sID, $data, 'spinoffID')) {
            header('Location: /Free-Write/public/Writer/Spinoffs');
            exit;
        } else {
            echo "Failed to reject the spinoff.";
        }

        $this->Spinoffs();
    }

// COMPETITIONS----------------------------------------------------------------------------------------------------
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

        $this->view('writer/competitions', ['userDetails' => $userDetails, 'followers' => $followers, 'views' => $views, 'competitions' => $competitions]);
    }

    public function NewCompetition()
    {
        $genre = new Genre();
        $genres = $genre->getGenres();
        $this->view('writer/createCompetition', ['genres' => $genres]);
    }

    public function createCompetition()
    {
        $competition = new Competition();

        $title = $_POST['title'] ?? '';
        if (strlen($title) >= 45) {
            echo "Title must be less than 45 characters.";
            exit;
        }

        $description = $_POST['Description'] ?? '';
        if (strlen($description) >= 255) {
            echo "Synopsis must be less than 255 characters.";
            exit;
        }

        $author = $_SESSION['user_id'];
        $price = $_POST['price'] ?? null;
        if ($price < 0 && !is_numeric($price)) {
            echo "Price must be a Positive number.";
            exit;
        }

        $startDate = date('Y-m-d');
        $endDate = date('Y-m-d', strtotime('+2 months'));
        $type = "covdes";

        if ($competition->insert(['title' => $title, 'description' => $description, 'first_prize' => $price, 'publisherID' => $author, 'start_date' => $startDate, 'end_date' => $endDate, 'type' => $type])) {
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
        if (strlen($title) >= 45) {
            echo "Title must be less than 45 characters.";
            exit;
        }

        $Description = $_POST['Description'] ?? '';
        if (strlen($Description) >= 255) {
            echo "Description must be less than 255 characters.";
            exit;
        }

        $price = $_POST['price'] ?? null;
        if ($price < 0 && !is_numeric($price)) {
            echo "Price must be a Positive number.";
            exit;
        }

        $data = [
            'title' => $title,
            'description' => $Description,
            'first_prize' => $price
        ];

        $competition = new Competition();

        if ($competition->update($competitionID, $data, 'competitionID')) {
            header('location: /Free-Write/public/Writer/ViewCompetition/' . $competitionID); // Redirect to the competition overview page
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

    public function Submissions($competitionID = 0)
    {
         $URL = splitURL();
         if ($URL[2] < 1)
             $this->view('error');

    if ($competitionID < 1 || !is_numeric($competitionID))
            $competitionID = $URL[2]; //get the competition id from the url

        $submission = new DesignSubmissions();
        $submissionDetails = $submission->getSubmissionByCompetitionID($competitionID);

        $this->view('writer/submissions', ['submissions' => $submissionDetails]);
    }

    public function viewSubmission($submissionID = 0)
    {
        $URL = splitURL();
        if ($URL[2] < 1)
            $this->view('error');
        if ($submissionID < 1 || !is_numeric($submissionID))
        $submissionID = $URL[2]; //get the competition id from the url

        $submission = new DesignSubmissions();
        $submissionDetails = $submission->getSubmissionDetails($submissionID);
        
        $this->view('writer/viewSubmission', ['submission' => $submissionDetails]);
    }

    public function win($covID = 0)
    {
        

        header('location: /Free-Write/public/Writer/');
    }



//book------------------------------------------------------------------------

    public function New()
    {
        $genre = new Genre();
        $genres = $genre->getGenres();
        $this->view('writer/createBook', ['genres' => $genres]);
    }

    public function createBook()
    {
        $book = new Book();
        $bookGenre = new BookGenre();

        $title = $_POST['title'] ?? '';
        if (strlen($title) >= 45) {
            echo "Title must be less than 45 characters.";
            exit;
        }

        $synopsis = $_POST['Synopsis'] ?? '';
        if (strlen($synopsis) >= 255) {
            echo "Synopsis must be less than 255 characters.";
            exit;
        }

        $privacy = $_POST['privacy'] ?? 'public';
        $type = $_POST['type'] ?? 'book';
        $datetime = date('Y-m-d H:i:s');
        $author = $_SESSION['user_id'];

        $price = $_POST['price'] ?? null;
        if ($price < 0 && !is_numeric($price)) {
            echo "Price must be a Positive number.";
            exit;
        }

        $book->insert(['title' => $title, 'Synopsis' => $synopsis, 'price' => $price, 'accessType' => $privacy, 'publishType' => $type, 'author' => $author, 'creationDate' => $datetime, 'lastUpdateDate' => $datetime, 'isCompleted' => 0]);

        $bookID = $book->first(['title' => $title, 'Synopsis' => $synopsis, 'price' => $price, 'accessType' => $privacy, 'publishType' => $type, 'author' => $author, 'creationDate' => $datetime, 'lastUpdateDate' => $datetime, 'isCompleted' => 0])['bookID'];

        if (isset($_POST['genre']) && is_array($_POST['genre'])) {
            foreach ($_POST['genre'] as $genreID) {
                $bookGenre->insert(['book' => $bookID, 'genre' => $genreID]);
            }
        }


        header('location: /Free-Write/public/Writer/');
        exit;

    }
 
    public function Edit($bookID = 0)
    {
        $URL = splitURL();
        if ($URL[2] < 1)
            $this->view('error');

        if ($bookID < 1 || !is_numeric($bookID))
            $bookID = $URL[2]; //get the book id from the url

        $genre = new Genre();
        $genres = $genre->getGenres();

        $book = new Book();
        $bookDetails = $book->first(['bookID' => $bookID]);

        $covID = $bookDetails['coverImage'];
        $coverImage = new CoverImage();
        $coverDetails = $coverImage->first(['covID' => $covID]);

        $bookGenre = new BookGenre();
        $genreDetails = $bookGenre->getBookGenre($bookID);

        $this->view('writer/editBook', ['book' => $bookDetails, 'genres' => $genres, 'genreDetails' => $genreDetails, 'coverDetails' => $coverDetails]);

    }

    public function Update()
    {
        $bookID = $_POST['bID'];
        $title = $_POST['title'] ?? '';
        if (strlen($title) >= 45) {
            echo "Title must be less than 45 characters.";
            exit;
        }

        $Synopsis = $_POST['Synopsis'] ?? '';
        if (strlen($Synopsis) >= 255) {
            echo "Synopsis must be less than 255 characters.";
            exit;
        }

        $accessType = $_POST['accessType'] ?? 'public';
        $publishType = $_POST['publishType'] ?? 'book';
        $status = $_POST['status'] ?? '0';
        $price = $_POST['price'] ?? null;
        if ($price < 0 && !is_numeric($price)) {
            echo "Price must be a Positive number.";
            exit;
        }

        $lastUpdated = date('Y-m-d H:i:s');

        if (isset($_FILES['cover_image'])) {
            $author = $_SESSION['user_id'];
            $file = $_FILES['cover_image'];
            $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
            $dateTime = date('Y-m-d H:i:s');
            $FileName = $author . '_' . $dateTime . $ext;

            $uploadDir = __DIR__ . '/../images/coverDesign/'; // Absolute path on disk
            $uploadPath = $uploadDir . $FileName;

            if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
                $cover = new CoverImage();
                $cover->insert([
                    'name' => $FileName,
                    'artist' => $author,
                    'uploadDate' => $dateTime
                ]);
            }
        }

        $coverImage = new CoverImage();
        $coverImageDetails = $coverImage->first(['uploadDate' => $dateTime]);

        $data = [
            'title' => $title,
            'Synopsis' => $Synopsis,
            'accessType' => $accessType,
            'publishType' => $publishType,
            'price' => $price,
            'isCompleted' => $status,
            'lastUpdateDate' => $lastUpdated,
            'coverImage' => $coverImageDetails['covID'] ?? null
        ];

        $book = new Book();
        $bookGenre = new BookGenre();

        $book->update($bookID, $data, 'bookID');
        $bookGenre->deleteby('book', $bookID);

        // Insert the newly selected genres
        if (isset($_POST['genre']) && is_array($_POST['genre'])) {
            foreach ($_POST['genre'] as $genreID) {
                $bookGenre->insert(['book' => $bookID, 'genre' => $genreID]);
            }
        }

        header('location: /Free-Write/public/Writer/Overview/' . $bookID);
        exit;

    }

    public function DeleteBook()
    {
        $bookID = $_POST['bID'];

        $book = new Book();


        // Attempt to delete the book
        if ($book->update($bookID, ['accessType' => 'deleted'], 'bookID')) {
            header('location: /Free-Write/public/Writer/'); // Redirect to the writer dashboard
            exit;
        } else {
            die('Failed to delete the book.'); // Handle failure case
        }
    }

//chapter---------------------------------------------------------------------------
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

        $bookID = $chapter['BookID'];
        $book = new Book();
        $bookDetails = $book->first(['bookID' => $bookID]);

        $this->view('writer/editStory', ['chapter' => $chapter, 'book' => $bookDetails]);
    }

    public function UpdateChapter()
    {
        $Chapter = new Chapter();
        $chapterID = $_POST['chapterID'];

        $bookID = $_POST['BookID'];
        $chapterTitle = $_POST['story-editor-chapter'] ?? '';
        if (strlen($chapterTitle) >= 45) {
            echo "Title must be less than 45 characters.";
            exit;
        }

        $chapterContent = $_POST['story-editor'] ?? '';
        $datetime = date('Y-m-d H:i:s');
        $price = isset($_POST['price']) && $_POST['price'] !== '' ? $_POST['price'] : null;
        if ($price < 0 && !is_numeric($price)) {
            echo "Price must be a Positive number.";
            exit;
        }

        $Chapter->update(
            $chapterID,
            ['title' => $chapterTitle, 'content' => $chapterContent, 'lastUpdated' => $datetime, 'price' => $price],
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
        $chapterCount = count($chapters) + 1;

        $this->view('writer/writeStory', ['book' => $bookDetails, 'chapterCount' => $chapterCount]);

    }

    public function saveChapter()
    {
        $Chapter = new Chapter();
        $bookChapter = new BookChapter();

        $bookID = $_POST['bookID'];
        $title = $_POST['story-editor-chapter'] ?? '';
        $title = $_POST['story-editor-chapter'] ?? '';

        if (strlen($title) >= 45) {
            echo "Title must be less than 45 characters.";
            exit;
        }

        $content = $_POST['story-editor'] ?? '';
        $datetime = date('Y-m-d H:i:s');
        $price = isset($_POST['price']) && $_POST['price'] !== '' ? $_POST['price'] : null;
        if ($price < 0 && !is_numeric($price)) {
            echo "Price must be a Positive number.";
            exit;
        }


        $Chapter->insert(['title' => $title, 'content' => $content, 'lastUpdated' => $datetime, 'price' => $price]);

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

//quotations---------------------------------------------------------------------------
    public function Quotations()
    {
        $author = $_SESSION['user_id'];
        $userDetailsTable = new UserDetails();
        $userDetails = $userDetailsTable->first(['user' => $author]);

        $Followers = new Follow();
        $followers = $Followers->getFollowCount($author);

        $view = new Book();
        $totViewsArray = $view->getAuthorViews($author);
        $views = $totViewsArray[0]['totalViews'] ?? 0;

        $quotation = new Quotation();
        $quotations = $quotation->getQuotaByAuthor($author);

        $this->view('writer/quotations', ['userDetails' => $userDetails, 'followers' => $followers, 'views' => $views, 'quotas' => $quotations]);
    }

    public function ViewQuota()
    {
        $URL = splitURL();
        if ($URL[2] < 1)
            $this->view('error');

        $qID = $URL[2];

        $quotation = new Quotation();
        $quotationDetails = $quotation->getQuotaByID($qID);
        $this->view('writer/viewQuota', ['quota' => $quotationDetails]);
    }

    public function RequestPublisher()
    {
        $this->view('writer/publishers');

    }


    public function Insights()
    {
        $author = $_SESSION['user_id'];

        $userDetailsTable = new UserDetails();
        $userDetails = $userDetailsTable->first(['user' => $author]);

        $Followers = new Follow();
        $followers = $Followers->getFollowCount($author);

        $mostViewed = new Book();
        $mostViewed = $mostViewed->getMostViewedBooks($author);

        $rating = new Book();
        $Rated = $rating->getRatedBooks($author);

        $view = new Book();
        $totViewsArray = $view->getAuthorViews($author);
        $views = $totViewsArray[0]['totalViews'] ?? 0;

        $this->view('writer/insights', ['userDetails' => $userDetails, 'followers' => $followers, 'views' => $views, 'MostViewed' => $mostViewed, 'Rated' => $Rated]);

    }

    public function Donate()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /Free-Write/public/Login');
            exit;
        }

        //need to implment validations for not be able to donate for deleted users
        $userDetail = new UserDetails();
        $userID = $_GET['user'] ?? null;
        $deet = null;
        $Writername = null;
        $donarName = null;

        if ($userID) {
            $deet = $userDetail->first(['user' => $userID]);
            $Writername = $deet['firstName'] . " " . $deet['lastName'];
        }

        $deet = $userDetail->first(['user' => $_SESSION['user_id']]);
        $donarName = $deet['firstName'] . " " . $deet['lastName'];

        $donation =
            [
                'writerName' => $Writername,
                'writerID' => $userID,
                'userName' => $donarName,
            ];

        $this->view('writerDonate', ['donationInfo' => $donation]);
    }

}
