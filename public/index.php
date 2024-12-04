<?php
require '../app/core/setup.php';
use app\core\Router;
use app\controllers\ProjectsController;
use app\controllers\MainController;

$requestUri = $_SERVER['REQUEST_URI'];


switch ($requestUri) {
    case '':
    case '/':
    case '/home':
        include __DIR__ . '/assets/views/main/homepage.html';
        break;
    case '/about': 
        include __DIR__ . '/assets/views/main/about.html'; 
        break; 
    case '/projects': 
        $controller = new ProjectsController(); 
        $controller->index(); 
        break; 
    case '/contact': 
        include __DIR__ . '/assets/views/main/contact.html'; 
        break; 
    case '/users/profile':
        include __DIR__ . '/../public/assets/views/users/usersView.html';
        break;
        case '/submit-contact':
            header("Access-Control-Allow-Origin: *");
            header("Access-Control-Allow-Methods: POST");
            header("Access-Control-Allow-Headers: Content-Type");
            header('Content-Type: application/json');
        
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $rawInput = file_get_contents('php://input');
                error_log("Raw input received: $rawInput");
        
                $input = json_decode($rawInput, true);
        
                error_log("Parsed input data: " . print_r($input, true));
        
                $name = trim(htmlspecialchars($input['name'] ?? ''));
                $email = trim(htmlspecialchars($input['email'] ?? ''));
                $message = trim(htmlspecialchars($input['message'] ?? ''));
        
                error_log("Sanitized Data: Name=$name, Email=$email, Message=$message");
        
                if ($name === '' || $email === '' || $message === '') {
                    http_response_code(400);
                    echo json_encode(['success' => false, 'message' => 'All fields are required.']);
                    exit();
                }
        
                error_log("Form submission successful: Name=$name, Email=$email, Message=$message");
        
                echo json_encode(['success' => true, 'message' => 'Thank you for contacting me!']);
            } else {
                http_response_code(405); 
                echo json_encode(['success' => false, 'message' => 'Method not allowed.']);
            }
            break;
        
        
        

    case '/chat':
        error_log("Chat route accessed");
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405); 
            echo json_encode(['error' => 'Only POST requests are allowed']);
            break;
        }

        $controller = new MainController();

        try {
            $postData = file_get_contents('php://input');
            $decodedData = json_decode($postData, true);

            if (!isset($decodedData['message']) || empty(trim($decodedData['message']))) {
                http_response_code(400); 
                echo json_encode(['error' => 'Message field is required']);
                break;
            }

            $controller->chatWithGPT($decodedData['message']);
        } catch (Exception $e) {
            http_response_code(500); 
            echo json_encode(['error' => 'An error occurred while processing your request', 'details' => $e->getMessage()]);
        }
        break;

    case '/api/projects':
        $controller = new ProjectsController();
        $controller->index();
        break;
    case '/api/projects/create':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller = new ProjectsController();
            $controller->store(); 
        } else {
            http_response_code(405);
            echo json_encode(['error' => 'Only POST requests are allowed for project creation.']);
        }
        break;

    default:
        http_response_code(404);
        echo "Page not found!";
        break;
}
