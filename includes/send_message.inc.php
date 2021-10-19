<?php
session_start();
include_once "dbh.inc.php";
include_once "functions.inc.php";

if(isset($_POST["submit"])){
    $username = $_SESSION["user_username"];
    $message = $_POST["message"];
    send_message($conn, $username, $message);
}else{
    header("location: ../index.php");
    exit();
}