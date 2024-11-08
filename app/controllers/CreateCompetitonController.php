<?php

class CreateCompetitionController extends Controller
{
    public function index()
    {
        $this->view('competitions/createCompetition');
    }

    public function submit()
    {
        $errors = [];
        $description = trim($_POST['description'] ?? '');
        $bookTitle = trim($_POST['bookTitle'] ?? '');
        $price = trim($_POST['price'] ?? '');

        // Validate Description
        if (empty($description)) {
            $errors['description'] = 'Description is required.';
        } elseif (strlen($description) > 280) {
            $errors['description'] = 'Description must not exceed 280 characters.';
        }

        // Validate Book Title
        if (empty($bookTitle)) {
            $errors['bookTitle'] = 'Book title is required.';
        }

        // Validate Price
        if (empty($price)) {
            $errors['price'] = 'Price is required.';
        } elseif (!is_numeric($price)) {
            $errors['price'] = 'Please enter a valid number for the price.';
        }

        // If there are errors, reload the form with errors
        if (!empty($errors)) {
            $data = [
                'errors' => $errors,
                'description' => $description,
                'bookTitle' => $bookTitle,
                'price' => $price
            ];
            $this->view('competitions/createCompetition', $data);
        } else {
            // Save competition to database (or any other data storage logic)
            // Assume we have a Competition model to handle DB operations
            $competition = new Competition();
            $competition->create([
                'description' => $description,
                'bookTitle' => $bookTitle,
                'price' => $price
            ]);

            // Redirect to a success page or competition list
            header('Location: /competitions'); // Redirect to competitions list
            exit;
        }
    }
}
