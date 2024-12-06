<?php

namespace app\models;

use PDO;

class Project extends Model {

    public function getAll() {
        try {
            $query = "SELECT * FROM projects"; 
            $pdo = $this->connect();
            $stmt = $pdo->query($query);
    
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            error_log("Query Result: " . json_encode($result)); 
    
            return $result;
        } catch (\PDOException $e) {
            error_log("Query error: " . $e->getMessage());
            return [];
        }
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

    public function getExclusive() {
        $query = "SELECT * FROM private_projects"; 
        $stmt = $this->connect()->query($query);
        return $stmt->fetchAll();
    }

    public function testConnection() {
        $pdo = $this->connect();
        $stmt = $pdo->query("SELECT DATABASE() AS db");
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        print_r($result); 
    }
}
