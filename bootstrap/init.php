<?php
include "constants.php";
include "config.php";
include "vendor/autoload.php";
include "libs/helpers.php";


$dsn = "mysql:dbname=$database_config->db;host=$database_config->host";
try {
    $pdo = new PDO($dsn, $database_config->user, $database_config->pass);
} catch (PDOException $e) {
    diePage('Connection faild: ' . $e->getMessage());
}



include "libs/lib-auth.php";
include "libs/lib-tasks.php";
