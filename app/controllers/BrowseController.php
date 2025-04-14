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
        $freeBooks = $book->getFreeBooks();
        $this->view('OpenUser/browse', ['freewriteOriginals' => $FWObooks, 'paidBooks' => $paidBooks, 'freeBooks'=> $freeBooks]);
    }
    public function search()
    {
        $search = $_GET['bookName'];
        $book = new Book();
        $searchResult = $book->searchBook($search);

        $this->view('OpenUser/bookSearch', ['searchResult' => $searchResult]);
    }

}