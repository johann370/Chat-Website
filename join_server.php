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
include_once "footer.php";
?>