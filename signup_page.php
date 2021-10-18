<?php
    include_once "header.php";
?>

    <h2>Sign Up</h2>
    <form action="includes/signup_page.inc.php" method="POST"></form>
    <input type="text" name="Name" placeholder="Name"> <br>
    <input type="text" name="username" placeholder="Username"> <br>
    <input type="text" name="password" placeholder="Password"> <br>
    <input type="submit" name="submit">

<?php
    include_once "footer.php";
?>