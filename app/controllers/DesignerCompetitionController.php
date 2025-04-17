<?php

class DesignerCompetitionController extends Controller
{
    public function index()
    {
        $competitionModel = new Competition();

        // Update competition statuses
        $competitionModel->updateCompetitionStatus();

        // Fetch all competitions
        $allCompetitions = $competitionModel->findAll();
        $now = date('Y-m-d');

        // Categorize competitions
        $activeCompetitions = [];
        $upcomingCompetitions = [];
        $previousCompetitions = [];

        foreach ($allCompetitions as $comp) {
            if ($comp->start_date <= $now && $comp->end_date >= $now) {
                $activeCompetitions[] = $comp; // Active competitions
            } elseif ($comp->start_date > $now) {
                $upcomingCompetitions[] = $comp; // Upcoming competitions
            } elseif ($comp->end_date < $now) {
                $previousCompetitions[] = $comp; // Previous competitions
            }
        }

        // Pass competitions to the view
        $this->view('CoverPageDesigner/Competition', [
            'activeCompetitions' => $activeCompetitions,
            'upcomingCompetitions' => $upcomingCompetitions,
            'previousCompetitions' => $previousCompetitions
        ]);
    }

    public function index()
    {
        $competitionModel = new Competition();
        $competitions = $competitionModel->getAllCompetitions();
        $this->view('Competitions/index', ['competitions' => $competitions]);
    }

    public function DisplayForDesigners()
    {
        $competition_table = new Competition();

        // Optional status updater
        echo "<pre>Updating competition status...\n</pre>";
        $competition_table->updateCompetitionStatus();

        echo "<pre>Fetching all competitions...\n</pre>";
        $allCompetitions = $competition_table->findAll();

        echo "<pre>Total Competitions Found: " . count($allCompetitions) . "\n</pre>";

        $now = date('Y-m-d');
        echo "<pre>Current Date: $now\n</pre>";

        $active = [];
        $upcoming = [];
        $previous = [];

        foreach ($allCompetitions as $comp) {
            echo "<pre>Checking competition: " . $comp->title . " (Start: $comp->start_date, End: $comp->end_date, Status: $comp->status)\n</pre>";
            if ($comp->status === 'active' && $comp->start_date <= $now && $comp->end_date >= $now) {
                $active[] = $comp;
                echo "<pre>-> Classified as ACTIVE\n</pre>";
            } elseif ($comp->start_date > $now) {
                $upcoming[] = $comp;
                echo "<pre>-> Classified as UPCOMING\n</pre>";
            } elseif ($comp->end_date < $now) {
                $previous[] = $comp;
                echo "<pre>-> Classified as PREVIOUS\n</pre>";
            }
        }

        echo "<pre>Active Competitions: " . count($active) . "\n</pre>";
        echo "<pre>Upcoming Competitions: " . count($upcoming) . "\n</pre>";
        echo "<pre>Previous Competitions: " . count($previous) . "\n</pre>";

        $this->view('designer/competition', [
            'activeCompetitions' => $active,
            'previousCompetitions' => $previous,
            'upcomingCompetitions' => $upcoming
        ]);
    }

}   
