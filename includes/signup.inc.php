<?php
if (isset($_POST['submit'])) {
    include_once 'dbh.inc.php';
    
    $first = htmlspecialchars($_POST['first']);
    $last = htmlspecialchars($_POST['last']);
    $email = htmlspecialchars($_POST['email']);
    $uid = htmlspecialchars($_POST['uid']);
    $pwd = htmlspecialchars($_POST['pwd']);
    $role = htmlspecialchars($_POST['role']);
    $created = htmlspecialchars($_POST['date-created']);

    //Hashing the password
    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
    //Insert the user into the database
    $sql = "INSERT INTO users (user_first, user_last,
        user_email, user_uid, user_pwd, user_role, user_created, user_last_login) VALUES ('$first',
        '$last', '$email', '$uid', '$hashedPwd', '$role', '$created', '$created');";

    $statement = $pdo->query($sql);
    $member = $statement->fetch();

    if (!$member) {
        header("Location: ../php/signup.php?signup=error");
        exit();
    } else {
        header("Location: ../php/signup.php?signup=success");
        exit();
    }
}