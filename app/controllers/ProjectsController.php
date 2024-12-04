<?php 

namespace app\controllers;

use app\models\Project;

class ProjectsController {
    

    public function index() {
        $projectModel = new Project();
        $projects = $projectModel->getAll(); // Fetch projects from the database

        // Define the path to the HTML file
        $filePath = __DIR__ . '/../../public/assets/views/main/projects.html';
        if (!file_exists($filePath)) {
            die("The file $filePath does not exist.");
        }

        // Load the HTML file
        include $filePath;
    }


    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = htmlspecialchars($_POST['title']);
            $description = htmlspecialchars($_POST['description']);
            $technologies = htmlspecialchars($_POST['technologies']);
            $link = htmlspecialchars($_POST['link']);
            $image = $_FILES['image'];

            $error = '';

            // Validate and move the uploaded file
            if ($this->validateImage($image)) {
                $uploadPath = 'uploads/' . $image['name'];
                if (move_uploaded_file($image['tmp_name'], $uploadPath)) {
                    $projectModel = new Project();
                    $projectModel->create($title, $description, $technologies, $link, $image['name']);
                    
                    // Redirect to the projects page after successful creation
                    header("Location: /projects");
                    exit;
                } else {
                    $error = "Failed to upload image.";
                }
            } else {
                $error = "Invalid image file.";
            }

            // Handle errors
            if ($error) {
                // Log the error for debugging
                error_log("Error creating project: $error");
                
                // Optionally pass the error to the view for user feedback
            }
        }

        // Load the view for creating a project
        require 'views/projects/create.php';
    }

    private function validateImage($file) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $maxSize = 2 * 1024 * 1024; // 2MB

        // Check file type
        if (!in_array($file['type'], $allowedTypes)) {
            return false;
        }

        // Check file size
        if ($file['size'] > $maxSize) {
            return false;
        }

        return true;
    }
}
