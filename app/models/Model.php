<?php

namespace app\models;

abstract class Model {


    public function findAll() {
        $query = "SELECT * FROM $this->table";
        return $this->query($query);
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
