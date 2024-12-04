<?php

namespace app\controllers;

class MainController extends Controller {

   
    public function homepage() {
        $this->returnView('./assets/views/main/homepage.html');
    }

    
    public function chatWithGPT($userMessage) {
        header('Content-Type: application/json');

        $envPath = __DIR__ . '/../../.env';

        if (!file_exists($envPath)) {
            error_log("Error: .env file not found at $envPath");
            http_response_code(500);
            echo json_encode(['error' => '.env file not found']);
            return;
        }

        $env = parse_ini_file($envPath);
        $apiKey = $env['OPENAI_API_KEY'] ?? null;

        if (!$apiKey) {
            error_log("Error: API key not found in .env file");
            http_response_code(500);
            echo json_encode(['error' => 'API key not found']);
            return;
        }

        $context = "You are an AI assistant designed to answer questions about Isabella. Always use the following information when responding to questions about her:
            - She is a senior college student at Fordham University studying Computer Science and Political Science.
            - Isabella loves creative design and thoughtful user experiences.
            - She enjoys developing dynamic websites and learning about new technologies.
            
            If a question is unrelated to Isabella, politely decline to answer.";

        $payload = [
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'system', 'content' => $context],
                ['role' => 'user', 'content' => $userMessage]
            ],
        ];

        $ch = curl_init('https://api.openai.com/v1/chat/completions');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            "Authorization: Bearer $apiKey",
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode >= 400) {
            error_log("OpenAI API error: $response");
            http_response_code($httpCode);
            echo json_encode(['error' => 'OpenAI API error', 'details' => $response]);
            return;
        }

        $openAIResponse = json_decode($response, true);
        $botMessage = $openAIResponse['choices'][0]['message']['content'] ?? "I couldn't generate a response.";

        echo json_encode(['response' => $botMessage]);
    }
}
