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
                    $this->view('browse');
                    break;
            }

        } else {
            $this->view('browse');
        }
    }

    private function viewBook()//set as private
    {
       //change URL to 
       
    }

}