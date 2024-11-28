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


    public function bookProfile()
    {
        $this->view('publisher/bookDesign4Users');
    }

    public function Profile()
    {
        $this->view('publisher/publisherProfile4User');
    }
    
    public function bookList()
    {
        $this->view('publisher/allPublicationList');
    }

    public function regPage(){
        $this->view('publisher/publisherRegistrationPage');
    }
     
    public function orderDetail(){
        $this->view('publisher/orderDetailPage');
    }

    public function newOrder(){
        $this->view('publisher/newOrder');
    }
    
}