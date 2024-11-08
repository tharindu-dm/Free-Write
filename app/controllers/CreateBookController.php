<?php

class CreateBookController extends Controller
{
    public function index()
    {
        $this->view('book/createBook');
    }

    public function create()
    {
        // Handle form submission
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Get form data
            $title = $_POST['title'] ?? '';
            $synopsis = $_POST['synopsis'] ?? '';
            $genre = $_POST['genre'] ?? '';
            $privacy = $_POST['privacy'] ?? '';
            $coverImage = $_FILES['cover'] ?? null;

            // Validate input
            $errors = $this->validate($title, $synopsis, $genre, $privacy, $coverImage);

            if (empty($errors)) {
                // Move the uploaded cover image to a designated folder
                $coverPath = $this->uploadCover($coverImage);

                // Save book data in the database
                $bookModel = $this->model('BookModel');
                $bookModel->createBook($title, $synopsis, $genre, $privacy, $coverPath);

                // Redirect to the book list or detail page
                header("Location: /book");
            } else {
                // Display form with errors
                $this->view('book/createBook', ['errors' => $errors]);
            }
        }
    }

    private function validate($title, $synopsis, $genre, $privacy, $coverImage)
    {
        $errors = [];

        if (empty($title)) {
            $errors['title'] = 'Title is required';
        }
        if (empty($synopsis)) {
            $errors['synopsis'] = 'Synopsis is required';
        }
        if (empty($genre)) {
            $errors['genre'] = 'Genre is required';
        }
        if (empty($privacy)) {
            $errors['privacy'] = 'Privacy setting is required';
        }
        if ($coverImage && $coverImage['error'] == UPLOAD_ERR_NO_FILE) {
            $errors['cover'] = 'Cover image is required';
        }

        return $errors;
    }

    private function uploadCover($coverImage)
    {
        $targetDir = "uploads/covers/";
        $targetFile = $targetDir . basename($coverImage['name']);
        
        if (move_uploaded_file($coverImage['tmp_name'], $targetFile)) {
            return $targetFile;
        } else {
            return null;
        }
    }
}
