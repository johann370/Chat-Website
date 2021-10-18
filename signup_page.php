<?php
    include_once "header.php";
?>

    <h2>Sign Up</h2>
    <form action="./includes/signup_page.inc.php" method="POST">
        <input type="text" name="name" placeholder="Name"> <br>
        <input type="text" name="username" placeholder="Username"> <br>
        <input type="password" name="password" placeholder="Password"> <br>
        <input type="password" name="passwordrepeat" placeholder="Repeat Password"> <br>
        <button type="submit" name="submit">Sign Up</button>
    </form>

<?php
    include_once "footer.php";
?>