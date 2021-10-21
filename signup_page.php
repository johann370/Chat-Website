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
        if(isset($_GET["error"])){
            if($_GET["error"] == "emptyfields"){
                echo "<p>Please enter all the fields</p>";
            }else if($_GET["error"] == "invalidusername"){
                echo "<p>Please enter a valid username</p>";
            }else if($_GET["error"] == "usernametaken"){
                echo "<p>The username is already taken</p>";
            }else if($_GET["error"] == "passwordmismatch"){
                echo "<p>Passwords don't match</p>";
            }else if($_GET["error"] == "none"){
                echo "<p>You succesfully signed up!</p>";
            }
        }
    ?>

<?php
    include_once "footer.php";
?>