<?php

class CompetitionsController {
    
    // Constructor
    public function __construct() {
        // Check if user is logged in; if not, redirect to login page
        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
            exit();
        }

        // Load models for User and Competitions
        $this->userModel = $this->loadModel('UserModel');
        $this->competitionModel = $this->loadModel('CompetitionModel');
    }

    // Main function to display the competitions page
    public function index() {
        // Retrieve current user info
        $userId = $_SESSION['user_id'];
        $user = $this->userModel->getUserById($userId);

        // Retrieve pending competitions for this user
        $competitions = $this->competitionModel->getPendingCompetitionsByUser($userId);

        // Load the view with user and competitions data
        $this->loadView('competitions', [
            'user' => $user,
            'competitions' => $competitions
        ]);
    }

    // Function to handle new competition creation
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $_POST['title'];
            $genre = $_POST['genre'];

            // Save new competition
            $this->competitionModel->createCompetition($_SESSION['user_id'], $title, $genre);

            // Redirect to competitions page
            header("Location: /competitions");
            exit();
        } else {
            // Load view for creating a new competition
            $this->loadView('createCompetition');
        }
    }

    // Function to delete a competition
    public function delete($competitionId) {
        // Check if the user owns this competition
        if ($this->competitionModel->checkOwnership($_SESSION['user_id'], $competitionId)) {
            // Delete the competition
            $this->competitionModel->deleteCompetition($competitionId);
        }

        // Redirect back to competitions page
        header("Location: /competitions");
        exit();
    }

    // Function to view a competition (for details page)
    public function view($competitionId) {
        // Get competition details
        $competition = $this->competitionModel->getCompetitionById($competitionId);

        // Check if the competition exists and the user has permission to view it
        if ($competition && $competition['user_id'] == $_SESSION['user_id']) {
            // Load the competition view
            $this->loadView('competitionDetail', ['competition' => $competition]);
        } else {
            // Redirect to competitions page if not authorized
            header("Location: /competitions");
            exit();
        }
    }

    // Helper function to load models
    private function loadModel($modelName) {
        require_once "../app/models/" . $modelName . ".php";
        return new $modelName();
    }

    // Helper function to load views
    private function loadView($viewName, $data = []) {
        extract($data);  // Extract data array to variables
        require_once "../app/views/" . $viewName . ".php";
    }
}
