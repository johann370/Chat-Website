<?php

function emptyFieldsSignup($name, $username, $password, $passwordRepeat){
    $result = null;
    if(empty($name) || empty($username) || empty($password) || empty($passwordRepeat)){
        $result = true;
    }else{
        $result = false;
    }
    return $result;
}

function invalidUsername($username){
    $result = null;
    if(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
        $result = true;
    }else{
        $result = false;
    }
    return $result;
}

function usernameTaken($conn, $username){
    $sql = "SELECT * FROM users WHERE users_username = ?;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../signup_page.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if(!mysqli_fetch_assoc($resultData)){
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function passwordsMismatch($password, $passwordRepeat){
    $result = null;
    if($password !== $passwordRepeat){
        $result = true;
    }else{
        $result = false;
    }
    return $result;
}

function createUser($conn, $name, $username, $password){
    $sql = "INSERT INTO users(users_name, users_username, users_password) VALUES(?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../signup_page.php?error=stmtfailed");
        exit();
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sss", $name, $username, $hashedPassword);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../signup_page.php?error=none");
    exit();
}

function emptyFieldsLogin($username, $password){
    $result = null;
    if(empty($username) || empty($password)){
        $result = true;
    }else{
        $ressult = false;
    }
    return $result;
}

function userExists($conn, $username){
    $sql = "SELECT * FROM users WHERE users_username = ?;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../login_page.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }else{
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function loginUser($conn, $username, $password){
    $userExists = userExists($conn, $username);

    if($userExists === false){
        header("location: ../login_page.php?error=incorrectlogin");
        exit();
    }

    $passwordHashed = $userExists["users_password"];
    $checkPassword = password_verify($password, $passwordHashed);

    if($checkPassword === false){
        header("location: ../login_page.php?error=incorrectpassword");
        exit();
    }else if($checkPassword === true){
        session_start();
        $_SESSION["user_id"] = $userExists["users_id"];
        $_SESSION["user_username"] = $userExists["users_username"];
        header("location: ../index.php");
        exit();
    }
}