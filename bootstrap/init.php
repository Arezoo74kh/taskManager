<?php
include "constants.php";
include "config.php";
include "vendor/autoload.php";
include "libs/helpers.php";

try {
    $pdo = new PDO("mysql:dbname=$database_config->db;host={$database_config->host}",$database_config->user,$database_config->pass);
}catch (PDOException $e) {
    diePage('connection failed: ' . $e->getMessage());
}


// echo "Connection to database is OK!";
include "libs/lib-auth.php";
include "libs/lib-tasks.php";
