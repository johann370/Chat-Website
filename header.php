<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <ul>
        <li><a href="index.php">Home</a></li>
        
        <?php
            if(isset($_SESSION["user_username"])){
                echo '<li><a href="create_server.php">Create server</a></li>';
                echo '<li><a href="join_server.php">Join server</a></li>';
                echo "<li><a href=''>" . $_SESSION["user_username"] . "</a></li>";
                echo '<li><a href="logout_page.php">Log out</a></li>';
            }else{
                echo '<li><a href="signup_page.php">Sign up</a></li>';
                echo '<li><a href="login_page.php">Log in</a></li>';
            }
        ?>
    </ul>