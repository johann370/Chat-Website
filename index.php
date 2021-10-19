<?php
    include_once "header.php";
    if(isset($_SESSION["user_username"])){
        include_once "chat_page.php";
    }
?>

<?php
    include_once "footer.php";
?>