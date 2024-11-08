<?php

class WriterDashboardController extends Controller
{
    public function index()
    {
        $URL = splitURL();

        if (count($URL) == 2) {
            switch ($URL[1]) {
                case 'writerDashboard':
                    $this->viewDashboard();
                    break;
                default:
                    $this->view('writerDashboard/writerOverview');
                    break;
            }
        } else {
            $this->view('writerDashboard/writerOverview');
        }
    }

    private function viewDashboard() // Set as private
    {
        // Fetch writer profile and books data for the dashboard view
        $writer = $this->getWriterProfile();
        $books = $this->getWriterBooks();

        // Render the view, passing data to the view
        $this->view('writerDashboard/writerDashboard', [
            'writer' => $writer,
            'books' => $books,
        ]);
    }

    private function getWriterProfile()
    {
        // Replace with database fetch if needed
        return [
            'name' => 'Michael Thompson',
            'followers' => 250
        ];
    }

    private function getWriterBooks()
    {
        // Replace with actual data fetch from database
        return [
            [
                'title' => 'The Enchanted Forest',
                'published_date' => 'January 15, 2024'
            ],
            [
                'title' => 'Adventures of the Seas',
                'published_date' => 'March 10, 2024'
            ],
            [
                'title' => 'Beyond the Horizon',
                'published_date' => 'April 22, 2024'
            ]
        ];
    }
}
