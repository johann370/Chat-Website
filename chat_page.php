<?php
session_start();
require_once "./includes/dbh.inc.php";
require_once "./includes/functions.inc.php";
?>
<form method="POST">
    <?php $defaultServer = $_SESSION["server_picked"];?>
    <select name="servers">
    <option value='<?php echo $defaultServer?>' selected='selected'><?php echo $defaultServer?></option>
        <?php
        include_once "servers_list.php";
        ?>
    </select>
    <button type="submit" name="submit">Change server</button>
</form>

<?php
    if(isset($_POST["submit"])){
        $_SESSION['server_picked'] = $_POST["servers"];
    }
    echo '<h2>Server: ' . $_SESSION["server_picked"] . '</h2>';
?>

<div>
    <textarea name="textBox" cols="200" rows="50" readOnly="True">
<?php 
updateText($conn, $_SESSION['server_picked']);
?>
    </textarea>
</div>  
<form action="./includes/send_message.inc.php" method="POST">
     <label for="message">Message:</label>
     <input type="text" name="message" id="message">
     <button type="submit" name="submit">Send</button>
 </form>
