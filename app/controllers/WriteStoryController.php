<?php

class WriteStoryController extends Controller
{
    public function index()
    {
        $URL = splitURL();

        if (count($URL) == 2) {
            switch ($URL[1]) {
                case 'write':
                    $this->writeStory();
                    break;
                default:
                    $this->view('writer/writestory');
                    break;
            }
        } else {
            $this->view('writer/writestory');
        }
    }

    private function writeStory()
    {
        // Placeholder for loading existing story data
        // Example data for demonstration purposes
        $story = [
            'title' => 'Untitled Story',
            'chapter' => 1,
            'page' => 1,
            'content' => ''
        ];

        // Pass story data to the view
        $this->view('writer/writestory', ['story' => $story]);
    }

    public function save()
    {
        // Check for POST request and save story data
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $storyData = [
                'title' => $_POST['title'] ?? 'Untitled Story',
                'chapter' => $_POST['chapter'] ?? 1,
                'page' => $_POST['page'] ?? 1,
                'content' => $_POST['content'] ?? ''
            ];

            // Save logic here (e.g., database save operation)
            // Example: StoryModel::save($storyData);

            // Redirect to the story view or return success response
            header('Location: /Free-Write/public/writer/writestory');
            exit;
        }
    }

    public function publish()
    {
        // Check for POST request and publish story data
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $storyData = [
                'title' => $_POST['title'] ?? 'Untitled Story',
                'chapter' => $_POST['chapter'] ?? 1,
                'page' => $_POST['page'] ?? 1,
                'content' => $_POST['content'] ?? ''
            ];

            // Publish logic here (e.g., update story status in database)
            // Example: StoryModel::publish($storyData);

            // Redirect to a published page or return success response
            header('Location: /Free-Write/public/writer/publishedStories');
            exit;
        }
    }
}
