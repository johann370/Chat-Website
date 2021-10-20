<?php
session_start();
if(isset($_POST["submit"])){
    require_once "dbh.inc.php";
    require_once "functions.inc.php";
    
    $userServerName = $_POST["servername"];
    $userServerPassword = $_POST["serverpassword"];
    $userServerPasswordRepeat = $_POST["serverpasswordrepeat"];

    if(passwordsMismatch($userServerPassword, $userServerPasswordRepeat) !== false){
        header("location: ../create_server.php?error=passwordmismatch");
        exit();
    }
    if(serverExists($conn, $userServerName) !== false){
        header("location: ../create_server.php?error=serverexists");
        exit();
    }
    if(emptyFieldsCreateServer($userServerName, $userServerPassword, $userServerPasswordRepeat) !== false){
        header("location: ../create_server.php?error=emptyfields");
        exit();
    }
    
    createServer($conn, $userServerName, $userServerPassword, $_SESSION["user_id"]);
}else{
    header("location: ../create_server.php");
    exit();
}
