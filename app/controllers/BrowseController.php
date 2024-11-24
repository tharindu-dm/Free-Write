<?php

class BrowseController extends Controller
{
    public function index()
    {
        $URL = splitURL();
        $this->loadBrowsePage();

    }

    public function loadBrowsePage()
    {
        $book = new Book();
        $FWObooks = $book->getFWOBooks();
        $paidBooks = $book->getPaidBooks();
        $this->view('browse', ['FWObooks' => $FWObooks, 'paidBooks' => $paidBooks]);
    }
    public function book()//set as private
    {
        //change URL to 

    }

}