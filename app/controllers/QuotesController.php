<?php

class QuotesController extends Controller
{
    public function index()
    {
        $URL = splitURL();
        
        if (count($URL) == 2) {
            switch ($URL[1]) {
                case 'createQuote':
                    $this->createQuote();
                    break;
                default:
                    $this->viewQuotes();
                    break;
            }
        } else {
            $this->viewQuotes();
        }
    }

    private function viewQuotes()
    {
        // Sample user and quotes data (should be retrieved from a database in a real scenario)
        $user = [
            'name' => 'Michael Thompson',
            'followers' => 250
        ];
        
        $quotes = [
            ['title' => 'Writers on Writing', 'chapter' => 'Chapter 1'],
            ['title' => 'Writers on Writing', 'chapter' => 'Chapter 2'],
            ['title' => 'Writers on Writing', 'chapter' => 'Chapter 3']
        ];

        // Pass user and quotes data to the quotes view
        $this->view('quote/quote', ['user' => $user, 'quotes' => $quotes]);
    }

    private function createQuote()
    {
        // Render the create quote view
        $this->view('quote/createQuote');
    }
    
}
