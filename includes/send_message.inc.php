<?php
session_start();
include_once "dbh.inc.php";
include_once "functions.inc.php";

if(isset($_POST["submit"])){
    $username = $_SESSION["user_username"];
    $message = $_POST["message"];
    $userServerName = $_SESSION["server_picked"];
    send_message($conn, $username, $message, $userServerName);
}else{
    header("location: ../index.php");
    exit();
}