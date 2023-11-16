<?php
if (isset($_POST['submit'])) {
    require 'dbh.inc.php';

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
        user_email, user_uid, user_pwd, user_role, user_created, user_last_login) VALUES (:user_first,
        :user_last, :user_email, :user_uid, :user_pwd, :user_role, :user_created, :user_last_login);";

    $user['user_first'] = $first;
    $user['user_last'] = $last;
    $user['user_email'] = $email;
    $user['user_uid'] = $uid;
    $user['user_pwd'] = $hashedPwd;
    $user['user_role'] = $role;
    $user['user_created'] = $created;
    $user['user_last_login'] = $created;

    $statement = $pdo->prepare($sql);
    $statement->execute($user);
    header("Location: ../php/signup.php?signup=success");
} else {
    header("Location: ../php/signup.php");
}