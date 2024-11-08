<?php

class CreateQuoteController extends Controller
{
    public function index()
    {
        // Render the create quote view form
        $this->view('quote/createQuote');
    }

    public function store()
    {
        // Process form submission for creating a new quote

        // Example: Retrieve form data (sanitize inputs)
        $quoteText = htmlspecialchars($_POST['quote'] ?? '');
        $bookTitle = htmlspecialchars($_POST['book_title'] ?? '');

        // Basic validation example
        if (empty($quoteText) || empty($bookTitle)) {
            // If data is invalid, reload the form with an error message
            $data['error'] = "Both fields are required.";
            $this->view('quote/createQuote', $data);
            return;
        }

        // Assuming a Quote model exists for database interaction
        $quoteModel = new Quote();
        $quoteData = [
            'quote' => $quoteText,
            'book_title' => $bookTitle,
        ];

        // Save the quote (assuming save returns true on success)
        if ($quoteModel->save($quoteData)) {
            // Redirect to the quote overview page or success message
            header("Location: /quote");
            exit;
        } else {
            // Reload form with error message if save fails
            $data['error'] = "Failed to save the quote. Please try again.";
            $this->view('quote/createQuote', $data);
        }
    }
}
