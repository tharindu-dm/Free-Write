<?php

class SpinOffsController extends Controller
{
    // Display all spin-off requests
    public function index()
    {
        // Retrieve all spin-off requests from the model (assuming model interaction here)
        $spinoffRequests = $this->model('SpinOff')->getAllRequests();

        // Render the spinoffs view with the requests data
        $this->view('writer/spinoffs', ['spinoffRequests' => $spinoffRequests]);
    }

    // Show the create spin-off request form
    public function create()
    {
        $this->view('writer/createSpinOff');
    }

    // Handle the submission of a new spin-off request
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Collect input data
            $title = $_POST['title'];
            $requestedBy = $_POST['requestedBy'];

            // Call the model method to save a new spin-off request
            $this->model('SpinOff')->createRequest($title, $requestedBy);

            // Redirect to the spin-offs page
            header("Location: /Free-Write/public/writer/spinoffs");
            exit();
        }
    }

    // Accept a spin-off request by ID
    public function accept($id)
    {
        // Update the request to accepted in the database via the model
        $this->model('SpinOff')->acceptRequest($id);

        // Redirect to the spin-offs page
        header("Location: /Free-Write/public/writer/spinoffs");
        exit();
    }
}
