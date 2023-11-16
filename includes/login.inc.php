<?php

session_start();

if (isset($_POST['submit'])) {
    
    include 'dbh.inc.php';

    $uid = htmlspecialchars($_POST['uid']);
    $pwd = htmlspecialchars($_POST['pwd']);

    //Error handlers
    //Check if inputs are empty
    if (empty($uid) || empty($pwd)) {
        header("Location: ../index.php?login=empty");
        exit();
    } else {
        $sql = "SELECT COUNT(*) FROM users WHERE user_uid='$uid' OR user_email='$uid'";
        $statement = $pdo->query($sql);
        $userCount = $statement->fetch();
        if ($userCount < 1) {
            header("Location: ../index.php?login=errorUser");
            exit();
        } else {
            $sql = "SELECT * FROM users WHERE user_uid='$uid' OR user_email='$uid'";
            $statement = $pdo->query($sql);
            if ($row = $statement->fetch()) {
                //De-hashing the password
                $hashedPwdCheck = password_verify($pwd, $row['user_pwd']);
                if ($hashedPwdCheck == false) {
                    header("Location: ../index.php?login=errorPassword");
                    exit();
                } elseif ($hashedPwdCheck == true) {
                    //Log in the user here
                    $_SESSION['u_id'] = $row['user_id'];
                    $_SESSION['u_first'] = $row['user_first'];
                    $_SESSION['u_last'] = $row['user_last'];
                    $_SESSION['u_email'] = $row['user_email'];
                    $_SESSION['u_uid'] = $row['user_uid'];
                    header("Location: ../index.php?login=success");
                    exit();
                }
            }
        }
    }
} else {
    header("Location: ../index.php?login=error");
    exit();
}