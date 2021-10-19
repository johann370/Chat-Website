<?php 
    function updateText(){
        $myFile = fopen("log.txt", "r");
        $text = fread($myFile, filesize("log.txt"));
        echo $text;
    }
?>