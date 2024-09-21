<?php

class ChapterController extends Controller
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
                    $this->view('book/bookOverview');
                    break;
            }

        } else {
            $this->view('book/bookChapter');
        }
    }

    private function viewBook()//set as private
    {
       //change URL to 
       
    }

}