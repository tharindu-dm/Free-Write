<?php

class DesignerCompetitionController extends Controller
{
    public function index()
    {
        $competitionModel = new Competition();

        // Optional: update statuses
        $competitionModel->updateCompetitionStatus();

        $allCompetitions = $competitionModel->findAll();
        $now = date('Y-m-d');

        $active = [];
        $upcoming = [];
        $previous = [];

        foreach ($allCompetitions as $comp) {
            if ($comp->status === 'active' && $comp->start_date <= $now && $comp->end_date >= $now) {
                $active[] = $comp;
            } elseif ($comp->start_date > $now) {
                $upcoming[] = $comp;
            } elseif ($comp->end_date < $now) {
                $previous[] = $comp;
            }
        }

        $this->view('designer/competition', [
            'activeCompetitions' => $active,
            'upcomingCompetitions' => $upcoming,
            'previousCompetitions' => $previous
        ]);
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
