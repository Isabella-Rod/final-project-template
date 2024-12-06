<?php

namespace app\models;

class Auth extends Model {
    public function register($username, $password) {
        try {
            $query = "SELECT * FROM members WHERE username = ?";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute([$username]);
    
            if ($stmt->fetch()) {
                return "Username already exists.";
            }
    
            $query = "INSERT INTO members (username, password) VALUES (?, ?)";
            $stmt = $this->connect()->prepare($query);
            if ($stmt->execute([$username, $password])) {
                return true;
            } else {
                return "Failed to register. Please try again.";
            }
        } catch (\PDOException $e) {
            error_log("PDOException: " . $e->getMessage());
            return "An error occurred. Please try again.";
        }
    }
    
    

    public function login($username, $password) {
        try {
            error_log("Auth::login - Attempting login for username: $username");
    
            $query = "SELECT * FROM members WHERE username = :username";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute([':username' => $username]);
    
            $user = $stmt->fetch(\PDO::FETCH_ASSOC); 
            error_log("Auth::login - Fetched User: " . json_encode($user));
    
            if (!$user) {
                error_log("Auth::login - User not found: $username");
                throw new \Exception("Invalid username or password");
            }
    
            if (!password_verify($password, $user['password'])) {
                error_log("Auth::login - Password verification failed for $username");
                throw new \Exception("Invalid username or password");
            }
    
            error_log("Auth::login - Login successful for $username");
            return $user;
        } catch (\PDOException $e) {
            error_log("Auth::login - Database error: " . $e->getMessage());
            throw new \Exception("Login failed. Please try again.");
        }
    }
}
