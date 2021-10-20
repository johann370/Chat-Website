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
include_once "footer.php";
?>