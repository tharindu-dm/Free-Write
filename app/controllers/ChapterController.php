<?php

class ChapterController extends Controller
{
    public function index()
    {
        $URL = splitURL();
        
        if ($URL[2] >=1) {
            $this->viewChapter($URL[2]);
        } else {
            $this->view('book/Chapter');
        }
    }

    private function viewChapter($cID)//set as private
    {
       
    }

}