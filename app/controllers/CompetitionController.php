<?php

class CompetitionController extends Controller
{
    public function index()
    {
        $this->view('publisher/competitionDetails4Publisher');

    }

    public function ProfilePub()
    {
        $this->view('publisher/aCompetitionProfile4Publisher');
    }

    public function ProfileUser()
    {
        $this->view('publisher/aCompetitionProfile4users');
    }

    public function Completed()
    {
        $this->view('publisher/completedCompetition');
    }

    public function New()
    {
        $this->view('publisher/creatingnewcompetition');
    }

    public function Manage()
    {
        $this->view('publisher/editingcompetitiondetails');
    }

    public function Active()
    {
        $this->view('publisher/activeCompetition');
    }

    public function ViewStats()
    {
        $this->view('publisher/viewStats');
    }

    public function Test()
    {
        $this->view('publisher/bookUploadForm4Publishers');
    }
}