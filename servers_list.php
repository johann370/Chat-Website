<?php
session_start();
require_once "./includes/dbh.inc.php";
require_once "./includes/functions.inc.php";

$servers = explode(', ', getServersList($conn, $_SESSION["user_id"]));

foreach($servers as $server){
    if($server != ""){
        echo '<option value="' . $server . '">' . $server . '</option>';
    }
}