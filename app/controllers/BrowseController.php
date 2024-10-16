<?php

class BrowseController extends Controller
{
    public function index()
    {
        $URL = splitURL();
        
        if (count($URL) == 2) {
            switch ($URL[1]) {
                case 'book':
                    $this->viewBook();
                    break;
                default:
                    $this->loadBrowsePage();
                    break;
            }

        } else {
            $this->loadBrowsePage();
        }
    }

    public function loadBrowsePage(){
        $book = new Book();
        $FWObooks = $book->getFWOBooks();
        $paidBooks = $book->getPaidBooks();
        $this->view('browse', ['FWObooks' => $FWObooks, 'paidBooks' => $paidBooks]);
    }
    public function viewBook()//set as private
    {
       //change URL to 
       
    }

}