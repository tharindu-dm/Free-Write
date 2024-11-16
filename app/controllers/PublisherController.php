<?php

class PublisherController extends Controller
{
    public function index()
    {

    }

    public function BookDesign()
    {
        $this->view('publisher/bookDesign4Publishers');
    }

    public function BookUpload()
    {
        $this->view('publisher/bookUploadForm4Publishers');
    }
}