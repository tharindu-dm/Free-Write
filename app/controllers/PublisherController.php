<?php

class PublisherController extends Controller
{
    public function index()
    {
        // $book = new PublisherBooks();
        // $bookDetails = $book->getBookList();
        // $this->view('publisher/publisherPage4Users0',['bookDetails' => $bookDetails]);

        $book = new PublisherBooks();
        $bookDetails = $book->getBookList();

        // Group books by publisher
        $publisherBooks = [];
        foreach ($bookDetails as $book) {
            $publisherBooks[$book['author']][] = $book;
        }

        $this->view('publisher/PublisherPage4UsersO', ['publisherBooks' => $publisherBooks]);
    }

    public function BookDesign()
    {
        $publisherBook_table = new publisherBooks();
        $bookDetails = $publisherBook_table->where(['publisherID' => $_SESSION['user_id']]);
        print_r($bookDetails);
        //$this->view('Profile/publisherProfile', ['bookDetails' => $bookDetails]);
    }
    public function AddBook()
    {
        $this->view('publisher/bookUploadForm4Publishers');
    }

    public function BookUpload()
    {
        $title = $_POST['title'];
        $isbnID = $_POST['isbnID'];
        $author_name = $_POST['author_name'];
        $contributor_name = $_POST['contributor_name'];
        $genre = $_POST['genre'];
        $publication_year = $_POST['publication_year'];
        $synopsis = $_POST['synopsis'];
        $prize = $_POST['prize'];
        $created_at = date("Y-m-d H:i:s");
        // $author_link = $_POST['author_link'];
        $coverImage = $_FILES['bookCover'];
        $fileName = time() . '_' . $coverImage['name'];
        $targetPath = '../app/images/coverDesign/' . $fileName;

        if(move_uploaded_file($coverImage['tmp_name'], $targetPath)) {

        $publisherBooks_table = new publisherBooks();
        $publisherBooks_table->insert(['title' => $title, 'isbnID' => $isbnID, 'author_name' => $author_name, 'contributor_name' => $contributor_name, 'genre' => $genre, 'publication_year' => $publication_year, 'synopsis' => $synopsis, 'prize' => $prize, 'created_at' => $created_at, 'coverImage' => $fileName, 'publisherID' => $_SESSION['user_id']]);
        }
        header('Location: /Free-Write/public/User/Profile');
    }


    public function bookProfile4publishers()
    {
        $publisherBook_table = new publisherBooks();
        $URL = splitURL();
        $bookID = $URL[2];        //model-method-id
        $book_table = new publisherBooks();        //creating the model and assiging to a variable 
        $bookDetails = $book_table->first(['isbnID' => $bookID]);   //orange one is table name and blue one is the variable we created 
        // above one should be returned so put it into the arguement 

        $this->view('publisher/bookDesign4Publishers', ['bookDetails' => $bookDetails]);
        // $this->view('publisher/bookDesign4Users', ['bookDetails' => $bookDetails]);
    }
    public function bookProfile4Users()
    {
        $URL = splitURL();
        $bookID = $URL[2];        //model-method-id
        $book_table = new publisherBooks();        //creating the model and assiging to a variable 
        $bookDetails = $book_table->first(['isbnID' => $bookID]);   //orange one is table name and blue one is the variable we created 
        // above one should be returned so put it into the arguement 


        $this->view('publisher/bookDesign4Users', ['bookDetails' => $bookDetails]);
    }
    public function deletebookProfile()
    {
        if (!isset($_POST['isbnID'])) {
            header('Location: /Free-Write/public/User/Profile');
            exit();
        }

        $bookID = $_POST['isbnID'];
        $book_table = new publisherBooks();

        // Verify book belongs to current publisher
        $book = $book_table->first([
            'isbnID' => $bookID,
            'publisherID' => $_SESSION['user_id']
        ]);

        if ($book) {
            $book_table->delete($bookID, 'isbnID');
        }

        header('Location: /Free-Write/public/User/Profile');
        exit();
    }


    public function Profile()
    {
        $URL = splitURL();
        $userID = $URL[2];
        $publisher_table = new Publisher();
        $publisherDetails = $publisher_table->first(['pubID' => $userID]);
        $publisherBooks = new PublisherBooks();
        $recentBooks = $publisherBooks->getRecentBooks();

        $this->view('publisher/publisherProfile4User', ['publisherDetails' => $publisherDetails, 'recentBooks' => $recentBooks]);
    }

    public function bookList()
    {
        $allBookDetails_table = new publisherBooks();
        $allBookDetails = $allBookDetails_table->where(['publisherID' => $_SESSION['user_id']]);
        $pubDetails_table = new Publisher();
        $pubDetails = $pubDetails_table->first(['pubID' => $_SESSION['user_id']]);
        $this->view('publisher/allPublicationList', ['allBookDetails' => $allBookDetails, 'pubDetails' => $pubDetails]);
    }

    public function regPage()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user = new User();
            $userDetails = new UserDetails();
            $publisher = new Publisher();


            $user->updateToPub("pub", $_SESSION['user_id']);
            $publisher->insertPublisher($_POST['email'], $_POST['officeEmail'], $_POST['website'], $_POST['address'], $_POST['contactNumber'], $_POST['dob'], $_POST['description'], $_SESSION['user_id']);
            // Update user details
            $userDetails->updatePubDetail($_POST['description'], $_POST['dob'], $_POST['country'], $_SESSION['user_id']);

            // If logout was requested, redirect to logout
            if (isset($_POST['logout_after'])) {
                header('Location: /Free-Write/public/Login/logout');
                exit();
            }
        }
        $userDetails = new User();
        $userDetails = $userDetails->first(['userID' => $_SESSION['user_id']]);

        $this->view('publisher/publisherRegistrationPage', ['userDetails' => $userDetails]);
    }




    public function orderDetail()
    {
        $this->view('publisher/orderDetailPage');
    }

    public function newOrder()
    {
        $this->view('publisher/newOrder');
    }

    public function courier()
    {
        $this->view('publisher/courierLandingPage');
    }
    public function courierReview()
    {
        $this->view('publisher/courierReview');
    }
}
