<?php

class BrowseController extends Controller
{
    public function index()
    {
        $this->loadBrowsePage();
    }

    public function loadBrowsePage()
    {
        $book = new Book();
        $FWObooks = $book->getFWOBooks();
        $paidBooks = $book->getPaidBooks();
        $likeBooks = [];

        if (isset($_SESSION['user_id'])) {
            $genre = new BookGenre();
            $likeGenres = $genre->getGenreFrequency($_SESSION['user_id']);
            //likeGenres[0]['genreID'] = genre ID

            foreach ($likeGenres as $genre) {
                $genreID = $genre['genreID'];
                $genreName = $genre['genre_name'];
                
                $likeBooks[$genreName] = $book->getTop5BooksByGenre($genreID);
            }

        }

        $this->view('OpenUser/browse', ['FWObooks' => $FWObooks, 'paidBooks' => $paidBooks, 'likeBooks' => $likeBooks]);
    }
    public function search()
    {
        $search = $_GET['bookName'];
        $book = new Book();
        $searchResult = $book->searchBook($search);

        $this->view('OpenUser/bookSearch', ['searchResult' => $searchResult]);
    }

}