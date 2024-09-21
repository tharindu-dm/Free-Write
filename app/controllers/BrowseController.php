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
        $books = $book->getBooks();
        
        $this->view('browse', ['books' => $books]);
    }
    public function viewBook()//set as private
    {
       //change URL to 
       
    }

}