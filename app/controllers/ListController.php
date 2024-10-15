<?php

class ListController extends Controller
{
    public function index()
    {
        //echo "this is the List Controller\n";
        $list = new BookList;

        $this->view("List"); //calling the view function in /includes/Controller.php to view the Listpage
    }

    
}