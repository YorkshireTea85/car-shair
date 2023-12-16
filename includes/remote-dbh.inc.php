<?php

$dbType = "mysql";
$dbServername = "localhost";
$dbName = "unn_w23049878";
$dbCharSet = "utf8mb4";
$dsn = "$dbType:host=$dbServername;dbname=$dbName;";


$dbUsername = "unn_w23049878";
$dbPassword = "JamesNU1985";
$dboptions = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, $dbUsername, $dbPassword, $dboptions);
} catch (PDOException $e) {
    throw new PDOException($e->getMessage(), $e->getCode());
}