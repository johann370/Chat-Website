<div>
    <textarea name="textBox" cols="200" rows="50" readOnly="True">
<?php 
require_once "./includes/dbh.inc.php";
require_once "./includes/functions.inc.php";
updateText($conn);
?>
    </textarea>
</div>  
<form action="./includes/send_message.inc.php" method="POST">
     <label for="message">Message:</label>
     <input type="text" name="message" id="message">
     <button type="submit" name="submit">Send</button>
 </form>
