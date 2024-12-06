<?php

require '../app/core/Router.php';
require_once "../app/models/Model.php";
require_once "../app/models/User.php";
require_once "../app/models/Project.php";
require_once "../app/controllers/Controller.php";
require_once "../app/controllers/UserController.php";
require_once "../app/controllers/ProjectsController.php";
require_once "../app/controllers/MainController.php";
require_once "../app/controllers/AuthController.php";
require_once "../app/models/Auth.php";

if (file_exists('../.env')) {
    $env = parse_ini_file('../.env');
    $host = $env['DBHOST'] ?? '127.0.0.1';
    $db   = $env['DBNAME'] ?? 'portfolio';
    $user = $env['DBUSER'] ?? 'root';
    $pass = $env['DBPASS'] ?? '';
    $port = $env['DBPORT'] ?? '3306';
} else {
    $dbUrl = getenv('JAWSDB_URL');
    if ($dbUrl) {
        $dbParts = parse_url($dbUrl);
        $host = $dbParts['host'];
        $db   = ltrim($dbParts['path'], '/');
        $user = $dbParts['user'];
        $pass = $dbParts['pass'];
        $port = $dbParts['port'] ?? '3306';
    } else {
        $host = getenv('DBHOST') ?: '127.0.0.1';
        $db   = getenv('DBNAME') ?: 'portfolio';
        $user = getenv('DBUSER') ?: 'root';
        $pass = getenv('DBPASS') ?: '';
        $port = getenv('DBPORT') ?: '3306';
    }
}

define('DBHOST', $host);
define('DBPORT', $port);
define('DBNAME', $db);
define('DBUSER', $user);
define('DBPASS', $pass);

try {
    $dsn = "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4";
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    error_log("Database connection failed: " . $e->getMessage());
    die("Could not connect to the database.");
}

$GLOBALS['pdo'] = $pdo;


define('DEBUG', true);
