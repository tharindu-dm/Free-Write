<?php

class EditStoryController extends Controller
{
    public function index()
    {
        // Retrieve story ID from the URL
        $URL = splitURL();
        $storyId = isset($URL[2]) ? $URL[2] : null;

        if ($storyId) {
            // Fetch story details from the database
            $story = $this->getStoryById($storyId);
            
            if ($story) {
                // Pass story data to the view
                $this->view('story/editStory', [
                    'storyId' => $story['id'],
                    'storyTitle' => $story['title'],
                    'chapterTitle' => $story['chapter'],
                    'pageNumber' => $story['page'],
                    'storyText' => $story['content']
                ]);
            } else {
                // Redirect to an error page or story list if story not found
                $this->view('error/notFound');
            }
        } else {
            $this->view('error/notFound');
        }
    }

    public function update()
    {
        // Check for POST request to handle update
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $storyId = $_POST['storyId'];
            $title = $_POST['title'];
            $chapter = $_POST['chapter'];
            $page = $_POST['page'];
            $content = $_POST['content'];

            // Update story in the database
            $this->updateStory($storyId, $title, $chapter, $page, $content);

            // Redirect to the story's page after saving changes
            header("Location: /editStory/index/$storyId");
            exit();
        } else {
            $this->view('error/badRequest');
        }
    }

    public function delete()
    {
        // Retrieve story ID from URL
        $URL = splitURL();
        $storyId = isset($URL[2]) ? $URL[2] : null;

        if ($storyId) {
            // Delete story from the database
            $this->deleteStoryById($storyId);

            // Redirect to the main page or story list after deletion
            header("Location: /storyList");
            exit();
        } else {
            $this->view('error/notFound');
        }
    }

    // Private method to fetch a story by ID from the database
    private function getStoryById($storyId)
    {
        // Database query to fetch story data
        // Example: $story = $this->database->find('stories', $storyId);
        return [
            'id' => $storyId,
            'title' => 'Sample Title',
            'chapter' => 'Chapter 1',
            'page' => 1,
            'content' => 'This is a sample story content.'
        ];
    }

    // Private method to update a story in the database
    private function updateStory($storyId, $title, $chapter, $page, $content)
    {
        // Perform database update query here
        // Example: $this->database->update('stories', $storyId, ['title' => $title, 'chapter' => $chapter, ...]);
    }

    // Private method to delete a story by ID from the database
    private function deleteStoryById($storyId)
    {
        // Perform delete query here
        // Example: $this->database->delete('stories', $storyId);
    }
}
