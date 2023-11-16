<?php

$dbType = "mysql";
$dbServername = "localhost";
$dbName = "car_shair";
$dbCharSet = "utf8mb4";
$dsn = "$dbType:host=$dbServername;dbname=$dbName;";


$dbUsername = "root";
$dbPassword = "";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, $dbUsername, $dbPassword, $dboptions);
} catch (PDOException $e) {
    throw new PDOException($e->getMessage(), $e->getCode());
}