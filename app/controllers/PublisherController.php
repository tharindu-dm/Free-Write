<?php

class PublisherController extends Controller
{
    public function index()
    {
        // Fetch all books associated with publishers (sample data for now)
        $books = [
            ["title" => "Swallow", "genre" => "voodoo", "image" => "https://via.placeholder.com/150x200"],
            ["title" => "3,003", "genre" => "fiction", "image" => "https://via.placeholder.com/150x200"],
            ["title" => "The 239", "genre" => "comedy", "image" => "https://via.placeholder.com/150x200"],
            ["title" => "The Last She", "genre" => "dystopia", "image" => "https://via.placeholder.com/150x200"],
            ["title" => "Day After", "genre" => "mythology", "image" => "https://via.placeholder.com/150x200"]
        ];

        $this->view('publishers/index', ['books' => $books]);
    }

    public function show($id)
    {
        // Fetch a single book by ID (sample data for demonstration)
        $book = [
            "title" => "The Enchanted Forest",
            "genre" => "fantasy",
            "image" => "https://via.placeholder.com/150x200",
            "description" => "A magical journey through an enchanted forest."
        ];

        $this->view('publishers/show', ['book' => $book]);
    }

    public function create()
    {
        // Render the form view to create a new book for publishers
        $this->view('publishers/create');
    }

    public function store()
    {
        // Logic to save a new book for publishers would go here
        // Example: Save the posted data into the database

        // Redirect to the publishers' book listing after saving
        header('Location: /publishers');
    }

    public function edit($id)
    {
        // Fetch the book details by ID to edit
        $book = [
            "title" => "The Enchanted Forest",
            "genre" => "fantasy",
            "image" => "https://via.placeholder.com/150x200",
            "description" => "A magical journey through an enchanted forest."
        ];

        $this->view('publishers/edit', ['book' => $book]);
    }

    public function update($id)
    {
        // Logic to update the existing book details by ID
        // Example: Update the book details in the database

        // Redirect back to the book details page
        header("Location: /publishers/show/$id");
    }

    public function delete($id)
    {
        // Logic to delete the book by ID
        // Example: Remove the book from the database

        // Redirect to the publishers' book listing after deletion
        header('Location: /publishers');
    }
}
