<?php

class DesignerController extends Controller
{
    public function index()
    {
        $this->view('CoverPageDesigner/Designers_and_Design');
    }

    public function Dashboard()
    {
        $this->view('CoverPageDesigner/Dashboard');
    }

    public function New()
    {
        $this->view('CoverPageDesigner/CreateDesign');
    }

    public function Competition(){
        $this->view('CoverPageDesigner/Competition');
    }

    public function index()
    {
        $cover = new CoverImage();
        $covers = $cover->getAllCovers();
        
        $this->view('cover/index', [
            'covers' => $covers
        ]);
    }

    /*public function upload()
    {
        if(!isset($_SESSION['user_id'])) {
            header('Location: /Free-Write/public/User/Login');
            exit;
        }

        // Validate and handle file upload
        if(isset($_FILES['coverImage']) && $_FILES['coverImage']['error'] == UPLOAD_ERR_OK) {
            $coverImage = $_FILES['coverImage'];
            
            // Validate file type
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if(!in_array($coverImage['type'], $allowedTypes)) {
                die('Invalid file type. Only JPG, PNG and GIF are allowed.');
            }

            // Get file extension
            $fileExtension = pathinfo($coverImage['name'], PATHINFO_EXTENSION);

            // Generate new filename
            $dateTime = date('Y-m-d_H-i-s');
            $newFileName = "COVER_{$_SESSION['user_id']}_{$dateTime}.{$fileExtension}";

            // Define target directory
            $targetDirectory = 'D:/XAMPP/htdocs/Free-Write/app/images/covers/';

            // Move uploaded file
            if(move_uploaded_file($coverImage['tmp_name'], $targetDirectory . $newFileName)) {
                // Create database entry
                $cover = new CoverImage();
                $data = [
                    'artist' => $_SESSION['user_id'],
                    'name' => $newFileName,
                    'uploadDate' => date('Y-m-d H:i:s'),
                    'license' => $_POST['license'] ?? null
                ];

                $cover->insert($data);
                header('Location: /Free-Write/public/CoverDesigner');
            } else {
                die('Failed to move uploaded file.');
            }
        }

        $this->view('cover/upload');
    }

    public function edit()
    {
        if(!isset($_SESSION['user_id'])) {
            header('Location: /Free-Write/public/User/Login');
            exit;
        }

        $coverId = $_GET['id'] ?? null;
        if(!$coverId) {
            header('Location: /Free-Write/public/CoverDesigner');
            exit;
        }

        $cover = new CoverImage();
        $coverData = $cover->first(['covID' => $coverId]);

        // Check if cover exists and belongs to user
        if(!$coverData || $coverData->artist != $_SESSION['user_id']) {
            header('Location: /Free-Write/public/CoverDesigner');
            exit;
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'license' => $_POST['license'] ?? null
            ];
            
            $cover->update($coverId, $data, 'covID');
            header('Location: /Free-Write/public/CoverDesigner');
            exit;
        }

        $this->view('cover/edit', [
            'cover' => $coverData
        ]);
    }

    public function delete()
    {
        if(!isset($_SESSION['user_id'])) {
            header('Location: /Free-Write/public/User/Login');
            exit;
        }

        $coverId = $_GET['id'] ?? null;
        if(!$coverId) {
            header('Location: /Free-Write/public/CoverDesigner');
            exit;
        }

        $cover = new CoverImage();
        $coverData = $cover->first(['covID' => $coverId]);

        // Check if cover exists and belongs to user
        if(!$coverData || $coverData->artist != $_SESSION['user_id']) {
            header('Location: /Free-Write/public/CoverDesigner');
            exit;
        }

        // Delete file
        $filePath = 'D:/XAMPP/htdocs/Free-Write/app/images/covers/' . $coverData->name;
        if(file_exists($filePath)) {
            unlink($filePath);
        }

        // Delete database entry
        $cover->delete($coverId, 'covID');
        header('Location: /Free-Write/public/CoverDesigner');
    }
*/
}?><?php