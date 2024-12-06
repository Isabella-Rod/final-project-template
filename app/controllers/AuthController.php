<?php

namespace app\controllers;

use app\models\Auth;

class AuthController {
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = htmlspecialchars($_POST['username']);
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    
            $authModel = new Auth();
            $result = $authModel->register($username, $password);
    
            header('Content-Type: application/json');
    
            if ($result === true) {
                session_start();
                $_SESSION['user'] = $username;
                echo json_encode(['success' => true, 'redirect' => '/exclusive-projects']);
            } else {
                echo json_encode(['success' => false, 'message' => $result]);
            }
            exit;
        }
    }
    
    public function login() {
        session_start();
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = htmlspecialchars($_POST['username']);
            $password = $_POST['password'];
    
            $authModel = new Auth();
    
            try {
                $user = $authModel->login($username, $password);
    
                if ($user) {
                    $_SESSION['user'] = $user;
                    header('Location: /exclusive-projects');
                    exit;
                } else {
                    header('Location: /login?error=Invalid%20credentials&tab=login');
                    exit;
                }
            } catch (\Exception $e) {
                error_log("Login Error: " . $e->getMessage());
                header('Location: /login?error=' . urlencode($e->getMessage()) . '&tab=login');
                exit;
            }
        }
    
        $error = isset($_GET['error']) ? htmlspecialchars($_GET['error']) : null;
        $tab = isset($_GET['tab']) ? htmlspecialchars($_GET['tab']) : 'login';
    
        $filePath = __DIR__ . '/../../public/assets/views/main/login.html';
        if (file_exists($filePath)) {
            include $filePath;
        } else {
            error_log("The login.html file was not found at: $filePath");
            die("The login page could not be loaded.");
        }
    }
    
    

    public function logout() {
        session_start();
        session_destroy();
        header('Location: /');
        exit;
    }
}
