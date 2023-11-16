<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "car_shair";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "connection failed: " . $e->getMessage();
}

$sql = "SELECT user_first, user_last FROM users WHERE user_id = 3;";
$statement = $pdo->query($sql);
$member = $statement->fetch();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?= $member['user_first'] ?>
</body>
</html>