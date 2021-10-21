<?php
include_once "header.php";
?>

    <h2>Join Server</h2>
    <form action="./includes/join_server.inc.php" method="POST">
        <input type="text" name="servername" placeholder="Server Name"> <br>
        <input type="password" name="serverpassword" placeholder="Server Password"> <br>
        <button type="submit" name="submit">Join Server</button>
    </form>

    <?php
        if(isset($_GET["error"])){
            if($_GET["error"] == "emptyfields"){
                echo "<p>Please enter all the fields</p>";
            }else if($_GET["error"] == "alreadyjoined"){
                echo "<p>Already joined server</p>";
            }else if($_GET["error"] == "serverdoesntexist"){
                echo "<p>That server doesn't exist</p>";
            }else if($_GET["error"] == "incorrectpassword"){
                echo "<p>Inputted incorrect password</p>";
            }else if($_GET["error"] == "none"){
                echo "<p>Successfully joined server</p>";
            }
        }
    ?>

<?php
include_once "footer.php";
?>