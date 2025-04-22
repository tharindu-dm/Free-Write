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
        $this->view('OpenUser/browse', ['freewriteOriginals' => $FWObooks, 'paidBooks' => $paidBooks, 'freeBooks' => $freeBooks]);
    }
    public function search()
    {
        $searchType = $_GET['searchType'];
        $item = $_GET['itemName'];
        $searchResult = null;

        switch ($searchType) {
            case 'user':
                $users = new UserDetails();
                $searchResult = $users->getUserDetailsByName($item);
                break;
            case 'covdes':
            case 'writer':
                $users = new UserDetails();
                $searchResult = $users->getUserDetailsByName($item, $searchType);
                break;
            case 'spinoff':
                $spinoff = new Spinoff();
                $searchResult = $spinoff->getSpinoffByName($item);
                break;
            case 'book':
            default:
                $book = new Book();
                $searchResult = $book->searchBook($item);
                break;
        }


        $this->view('OpenUser/bookSearch', ['searchResult' => $searchResult]);
    }

}