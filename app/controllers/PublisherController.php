<?php

class PublisherController extends Controller
{
    public function index()
    {
        $this->view('publisher/PublisherPage4UsersO');
    }

    public function BookDesign()
    {
        $this->view('publisher/bookDesign4Publishers');
    }

    public function BookUpload()
    {
        $this->view('publisher/bookUploadForm4Publishers');
    }

    public function Profile()
    {
        $this->view('publisher/bookUploadForm4Publishers');
    }
}