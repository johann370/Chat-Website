<?php
session_start();
if(isset($_POST["submit"])){
    $userServerName = $_POST["servername"];
    $userServerPassword = $_POST["serverpassword"];
    $userId = $_SESSION["user_id"];

    require_once "dbh.inc.php";
    require_once "functions.inc.php";

    joinServer($conn, $userServerName, $userServerPassword, $userId);

}else{
    header("location: ../join_server.php");
    exit();
}