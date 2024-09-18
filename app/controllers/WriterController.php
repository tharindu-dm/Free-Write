<?php
class WriterController
{
    public function dashboard()
    {
        // Assuming user session management is already set up
        $userId = $_SESSION['user_id'] ?? null; // Adjust based on your session handling

        // Check if user ID is available
        if (!$userId) {
            // Handle the case when the user is not logged in
            header('Location: /Free-Write/public/login'); // Redirect to login page
            exit();
        }

        // Instantiate the Book model
        $bookModel = $this->model('Book');

        // Fetch books published by the user
        $books = $bookModel->getPublishedBooksByUser($userId);

        // Check if there are published books
        $message = '';
        if (empty($books)) {
            $message = "You haven't written any stories yet.";
        }

        // Pass data to the view
        $this->view('user/writerDashboard', [
            'books' => $books,
            'message' => $message
        ]);
    }

    // Assuming there's a model loading function like this in your base controller
    private function model($model)
    {
        // Check if the model file exists
        require_once "../app/models/" . ucfirst($model) . ".php";
        return new $model();
    }

    // Assuming there's a view rendering function like this in your base controller
    private function view($view, $data = [])
    {
        extract($data);
        require_once "../app/views/" . $view . ".php";
    }
}