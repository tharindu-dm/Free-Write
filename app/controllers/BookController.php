<?php

class BookController extends Controller
{
    public function index()
    {
        $URL = splitURL();
        
        // Check the URL structure to determine if a specific book or overview is requested
        if (count($URL) == 2) {
            switch ($URL[1]) {
                case 'view':
                    $this->viewBook();
                    break;
                default:
                    $this->view('book/bookOverview');
                    break;
            }

        } else {
            $this->view('book/bookOverview');
        }
    }

    // Private function to handle specific book view
    private function viewBook()
    {
        $URL = splitURL();
        
        // Assuming that the book ID might be the third URL parameter (e.g., /book/view/123)
        $bookId = isset($URL[2]) ? $URL[2] : null;
        
        if ($bookId) {
            // Fetch book data based on ID
            $bookModel = $this->model('BookModel');
            $book = $bookModel->getBookById($bookId);

            // If book found, display it; otherwise, show an error view or redirect
            if ($book) {
                $this->view('book/bookDetail', ['book' => $book]);
            } else {
                $this->view('errors/notFound');
            }
        } else {
            // Redirect to overview if no valid book ID is provided
            $this->view('book/bookOverview');
        }
    }
}
