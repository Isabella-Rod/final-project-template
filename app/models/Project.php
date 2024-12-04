<?php

namespace app\models;

use PDO;

class Project {
    private $env;

    public function __construct($env) {
        $this->env = $env;
    }


    private function connect() {
        try {
            $dsn = "mysql:host=" . DBHOST . ";dbname=" . DBNAME . ";charset=utf8mb4";
            $pdo = new PDO($dsn, DBUSER, DBPASS);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (\PDOException $e) {
            if (defined('DEBUG') && DEBUG) {
                die("Database connection failed: " . $e->getMessage());
            } else {
                error_log("Database connection failed: " . $e->getMessage());
                die("Unable to connect to the database. Please contact support.");
            }
        }
    }



    public function getAll() {
        $query = "SELECT * FROM projects";
        return $this->query($query);
    }

    public function create($title, $description, $technologies, $link, $imageName) {
        $query = "INSERT INTO projects (title, description, technologies, link, image) 
                  VALUES (:title, :description, :technologies, :link, :image)";
        $this->query($query, [
            ':title' => $title,
            ':description' => $description,
            ':technologies' => $technologies,
            ':link' => $link,
            ':image' => $imageName,
        ]);
    }


    public function query($query, $data = []) {
        $con = $this->connect();
        $stmt = $con->prepare($query);
        $stmt->execute($data);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result ?: [];
    }
}
