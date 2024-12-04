<?php

//require our files, remember should be relative to index.php
require '../app/core/Router.php';
require_once "../app/models/Model.php";
require_once "../app/models/User.php";
require_once "../app/models/Project.php"; 
require_once "../app/controllers/Controller.php";
require_once "../app/controllers/UserController.php";
require_once "../app/controllers/ProjectsController.php";
require_once "../app/controllers/MainController.php";


//set up env variables
$env = parse_ini_file('../.env');

define('DBNAME', $env['DBNAME']);
define('DBHOST', $env['DBHOST']);
define('DBUSER', $env['DBUSER']);
define('DBPASS', $env['DBPASS']);
define('DBDRIVER', '');

//set up other configs
define('DEBUG', true);

