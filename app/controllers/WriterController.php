<?php

class WriterController extends Controller
{
    public function index()
    {
        $this->view('writer/writerDashboard');
    }

    // DASHBOARD
    public function Dashboard()
    {
        $this->view('writer/writerDashboard');
    }


    // QUOTES
    public function Quotes()
    {
        $this->view('writer/quotes');
    }

    public function NewQuote()
    {
        $this->view('writer/createQuote');
    }

    // SPINOFFS
    public function Spinoffs()
    {
        $this->view('writer/spin-offs');
    }

    public function ViewSpinoff()
    {
        $this->view('writer/spinoffDetails');
    }

    // COMPETITIONS
    public function Competitions()
    {
        $this->view('writer/competitions');
    }

    public function ViewCompetitions()
    {
        $this->view('writer/viewCompetitions');
    }

    public function NewCompetition()
    {
        $this->view('writer/createCompetition');
    }

    public function DeleteCompetition()
    {
        //implement delete competition
    }

    public function viewCompetition()
    {
        //implement view competition
    }

    //new book
    public function New()
    {
        $this->view('writer/createBook');
    }

    public function BookDetails()
    {
        // Get the book ID from the URL
        $this->view('writer/bookDetail');
    }

    public function EditStory()
    {
        $this->view('writer/editStory');
    }

    public function WriteStory()
    {
        $this->view('writer/writeStory');
    }

}