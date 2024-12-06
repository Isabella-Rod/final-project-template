<?php

namespace app\models;

use PDO; 
use PDOException;

abstract class Model {

    public function findAll() {
        $query = "SELECT * FROM $this->table";
        return $this->query($query);
    }

    protected function connect() {
        try {
            $dbUrl = getenv('JAWSDB_URL');
    
            if ($dbUrl) {
                $dbParts = parse_url($dbUrl);
    
                $host = $dbParts['host']; 
                $port = $dbParts['port'] ?? '3306'; 
                $user = $dbParts['user']; 
                $pass = $dbParts['pass']; 
                $db = ltrim($dbParts['path'], '/'); 
    
                error_log("Connecting to Heroku JAWSDB: Host=$host, Port=$port, DB=$db, User=$user");
            } else {
                $host = getenv('DBHOST') ?: '127.0.0.1';
                $port = getenv('DBPORT') ?: '3306';
                $user = getenv('DBUSER') ?: 'root';
                $pass = getenv('DBPASS') ?: '';
                $db = getenv('DBNAME') ?: 'portfolio';
    
                error_log("Connecting to local DB: Host=$host, Port=$port, DB=$db, User=$user");
            }
    
            $dsn = "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4";
    
            $pdo = new \PDO($dsn, $user, $pass);
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    
            return $pdo;
        } catch (\PDOException $e) {
            error_log("Database connection error: " . $e->getMessage());
            throw new \Exception("Unable to connect to the database.");
        }
    }
    
    public function query($query, $data = []) {
        try {
            $con = $this->connect();
            $stm = $con->prepare($query);
            $check = $stm->execute($data);

            if ($check) {
                $result = $stm->fetchAll(\PDO::FETCH_OBJ);
                return (!empty($result)) ? $result : false;
            }
        } catch (\PDOException $e) {
            error_log("Query error: " . $e->getMessage());
            return false;
        }
    }
}
