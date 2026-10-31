<?php

$host = "localhost";
$dbname = "business_application";
$user = "root";
$password = "";

$dsn = "mysql:host={$host};dbname={$dbname}";

$pdo = new PDO($dsn, $user, $password);
$pdo->exec("SET time_zone = '+8:00';");

?>