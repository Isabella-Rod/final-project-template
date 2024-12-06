<?php 

namespace app\controllers;

use app\models\Project;

class ProjectsController {

    public function index() {
        $projectModel = new Project();
        $projects = $projectModel->getAll(); 
    
        error_log("Fetched Projects: " . json_encode($projects));
    
        header('Content-Type: application/json');
    
        echo json_encode($projects);
    
        exit;
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = htmlspecialchars($_POST['title']);
            $description = htmlspecialchars($_POST['description']);
            $technologies = htmlspecialchars($_POST['technologies']);
            $link = htmlspecialchars($_POST['link']);
            $image = $_FILES['image'];

            $error = '';

            if ($this->validateImage($image)) {
                $uploadPath = 'uploads/' . $image['name'];
                if (move_uploaded_file($image['tmp_name'], $uploadPath)) {
                    $projectModel = new Project();
                    $projectModel->create($title, $description, $technologies, $link, $image['name']);
                    
                    header("Location: /projects");
                    exit;
                } else {
                    $error = "Failed to upload image.";
                }
            } else {
                $error = "Invalid image file.";
            }

            if ($error) {
                error_log("Error creating project: $error");
            }
        }

        require 'views/projects/create.php';
    }

    private function validateImage($file) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $maxSize = 2 * 1024 * 1024; 

        if (!in_array($file['type'], $allowedTypes)) {
            return false;
        }

        if ($file['size'] > $maxSize) {
            return false;
        }
        return true;
    }

    public function renderProjectsPage() {
        $filePath = __DIR__ . '/../../public/assets/views/main/projects.php';
        if (!file_exists($filePath)) {
            die("The file $filePath does not exist.");
        }
    
        include $filePath;
    }

    public function renderExclusiveProjects() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit;
        }

        $projectModel = new Project();
        $projects = $projectModel->getExclusive();

        include __DIR__ . '/../../public/assets/views/main/exclusiveprojects.php';
    }

    public function testDatabase() {
        $projectModel = new \app\models\Project();
        $projectModel->testConnection();
    }
    
    
}
