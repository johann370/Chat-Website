<?php
    include_once "header.php";
?>

    <h2>Log In</h2>
    <form action="includes/login_page.inc.php" method="POST">
        <input type="text" name="username" placeholder="Username"> <br>
        <input type="password" name="password" placeholder="Password"> <br>
        <button type="submit" name="submit">Log In</button>
    </form>
<?php
    include_once "footer.php";
?>