<?php
    include_once "header.php";
?>

    <h2>Log In</h2>
    <form action="includes/login_page.inc.php" method="POST"></form>
    <input type="text" name="username" placeholder="Username"> <br>
    <input type="text" name="password" placeholder="Password"> <br>
    <button type="submit" name="submit">Log In</button>

<?php
    include_once "footer.php";
?>