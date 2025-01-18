<?php

class PublisherBooksController extends Controller
{
    public function index()
    {

        $this->view('publisher/PublisherPage4UsersO');
    }

    public function BookDesign()
    {
        $this->view('publisher/bookDesign4Publishers');
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
        $author_link = $_POST['author_link'];
        $publisherBooks_table = new publisherBooks();
        $publisherBooks_table->insert(['title' => $title, 'isbnID' => $isbnID, 'author_name' => $author_name, 'contributor_name' => $contributor_name, 'genre' => $genre, 'publication_year' => $publication_year, 'author_link' => $author_link, 'publisherID' => $_SESSION['user_id']]);
        header('Location: /Free-Write/public/User/Profile');
        
    }


    public function bookProfile()
    {
        $this->view('publisher/bookDesign4Users');
    }

    public function Profile()
    {
        $this->view('publisher/publisherProfile4User');
    }
    
    public function bookList()
    {
        $this->view('publisher/allPublicationList');
    }

    public function regPage(){
        $this->view('publisher/publisherRegistrationPage');
    }
     
    public function orderDetail(){
        $this->view('publisher/orderDetailPage');
    }

    public function newOrder(){
        $this->view('publisher/newOrder');
    }
    
}