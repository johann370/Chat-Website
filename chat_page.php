<div>
    <textarea name="textBox" cols="200" rows="50" readOnly="True"><?php include "update_text.php"?></textarea>
</div>  
<form action="./send_message_to_file.php" method="POST">
     <label for="message">Message:</label>
     <input type="text" name="message" id="message">
     <input type="submit">
 </form>
