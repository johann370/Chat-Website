<?php
    $myFile = fopen("log.txt", "a");
    if(isset($_POST["message"])){
        fwrite($myFile, $_POST["message"] . "\n");
        fclose($myFile);
    }
    include "index.php";
?>
