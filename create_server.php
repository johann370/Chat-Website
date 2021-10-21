<?php
include_once "header.php";
?>

    <h2>Create Server</h2>
    <form action="./includes/create_server.inc.php" method="POST">
        <input type="text" name="servername" placeholder="Server Name"> <br>
        <input type="password" name="serverpassword" placeholder="Server Password"> <br>
        <input type="password" name="serverpasswordrepeat" placeholder="Repeat Server Password"> <br>
        <button type="submit" name="submit">Create Server</button>
    </form>

    <?php
        if(isset($_GET["error"])){
            if($_GET["error"] == "emptyfields"){
                echo "<p>Please enter all the fields</p>";
            }else if($_GET["error"] == "serverexists"){
                echo "<p>That server already exists</p>";
            }else if($_GET["error"] == "passwordmismatch"){
                echo "<p>Passwords don't match</p>";
            }else if($_GET["error"] == "none"){
                echo "<p>Successfully created server</p>";
            }
        }
    ?>

<?php
include_once "footer.php";
?>