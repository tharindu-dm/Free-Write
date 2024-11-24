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
        $this->view('OpenUser/browse', ['FWObooks' => $FWObooks, 'paidBooks' => $paidBooks]);
    }
    public function search()
    {
        $search = $_GET['bookName'];
        $book = new Book();
        $searchResult = $book->searchBook($search);

        $this->view('OpenUser/bookSearch', ['searchResult' => $searchResult]);
    }

}