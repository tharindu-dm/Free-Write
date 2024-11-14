<?php

class WriterController extends Controller
{
    public function index()
    {

    }

    public function Dashboard()
    {
        $this->view('writer/writerDashboard');
    }

    public function Quotes()
    {
        $this->view('writer/quotes');
    }

    public function Spinoffs()
    {
        $this->view('writer/spin-offs');
    }

    public function Competitions()
    {
        $this->view('writer/competitions');
    }

    public function New()
    {
        $this->view('writer/createBook');
    }

    public function BookDetails()
    {
        // Get the book ID from the URL
        $this->view('writer/bookDetail');
    }

}