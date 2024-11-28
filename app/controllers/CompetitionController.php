<?php

class CompetitionController extends Controller
{

    public function index(){
        $this->view('OpenUser/competitions');
    }

    public function MyCompetitions()
    {

        $competition_table = new Competition();
        $competitionDetails = $competition_table->findAll();

        $this->view('publisher/competitionDetails4Publisher', ['competitionDetails' => $competitionDetails]);
    }

    public function New()
    {
        $this->view('publisher/creatingnewcompetition');
    }

    public function CreateCompetition()
    {
        $title = $_POST['title'];
        $desc = $_POST['description'];
        $rules = $_POST['rules'];
        $prizes = $_POST['prizes'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $category = $_POST['category'];
        $competitionID = $_POST['compID'];
        $competition_table = new Competition();
        $competition_table->insert(['title' => $title, 'description' => $desc, 'rules' => $rules, 'prizes' => $prizes, 'start_date' => $start_date, 'end_date' => $end_date, 'category' => $category]);
        header('Location: /Free-Write/public/Competition/MyCompetitions');
    }

    public function Manage()
    {
        $URL = splitURL();
        $competitionID = $URL[2];        //model-method-id
        $competition_table = new Competition();        //creating the model and assiging to a variable 
        $competitionDetails = $competition_table->first(['competitionID' => $competitionID]);   //orange one is table name and blue one is the variable we created 
        // above one should be returned so put it into the arguement 
        $this->view('publisher/editingcompetitiondetails', ['competitionDetails' => $competitionDetails]);
    }

    public function editCompetition()
    {
        $var = $_POST['title'];
        $desc = $_POST['description'];
        $rules = $_POST['rules'];
        $prize = $_POST['prizes'];
        $category = $_POST['category'];
        $date = $_POST['end_date'];
        $competitionID = $_POST['compID']; //compID from editingcompetitionDetails.php
        $competition_table = new Competition();
        $competition_table->update($competitionID, ['title' => $var, 'description' => $desc, 'rules' => $rules, 'prizes' => $prize, 'category' => $category, 'end_date' => $date], 'competitionID');
        //above one has no need to pass , it just need to updated 
        header('Location: /Free-Write/public/Competition/MyCompetitions');   //to navigate after updated 
    }

    public function deleteCompetition()
    {
        $URL = splitURL();
        $competitionID = $_POST['compID'];
        $competition_table = new competition();
        $competition_table->delete($competitionID, 'competitionID');  //ensure what are id and id column
        header('Location: /Free-Write/public/Competition/MyCompetitions');
    }

    public function Profile()//shows the publisher's POV for a competition
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