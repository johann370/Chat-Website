<?php
if(isset($_POST["submit"])){
    $name = $_POST["name"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $passwordRepeat = $_POST["passwordrepeat"];

    require_once "dbh.inc.php";
    require_once "functions.inc.php";

    if(emptyFieldsSignup($name, $username, $password, $passwordRepeat) !== false){
        header("location: ../signup_page.php?error=emptyfields");
        exit();
    }
    if(invalidUsername($username) !== false){
        header("location: ../signup_page.php?error=invalidusername");
        exit();
    }
    if(usernameTaken($conn, $username) !== false){
        header("location: ../signup_page.php?error=usernametaken");
        exit();
    }
    if(passwordsMismatch($password, $passwordRepeat) !== false){
        header("location: ../signup_page.php?error=passwordsmismatch");
        exit();
    }

    createUser($conn, $name, $username, $password);
}
else{
    header("location: ../signup_page.php");
    exit();
}