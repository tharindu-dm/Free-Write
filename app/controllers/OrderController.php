<?php

class OrderController extends Controller
{
    public function index()
    {
        
        $this->view('publisher/order');

    }

    public function viewStats(){
        $this->view('publisher/viewStats4Orders');
    }

}