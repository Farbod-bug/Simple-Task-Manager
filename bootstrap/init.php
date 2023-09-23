<?php
session_start();
include "constants.php";
include BASE_PATH . "bootstrap/config.php";
include BASE_PATH . "vendor/autoload.php";
include BASE_PATH . "libs/helpers.php";


$dsn = "mysql:dbname=$database_config->db;host=$database_config->host";
try {
    $pdo = new PDO($dsn, $database_config->user, $database_config->pass);
} catch (PDOException $e) {
    diePage('Connection faild: ' . $e->getMessage());
}



include BASE_PATH . "libs/lib-auth.php";
include BASE_PATH . "libs/lib-tasks.php";
