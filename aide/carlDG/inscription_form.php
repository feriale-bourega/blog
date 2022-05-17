<?php 

ob_start();

?>
<form action="replaceme" method="post">
	<input type="text" name="username" placeholder="username" required><br><br>		<!--but select * from users where login='$login'-->
	<input type="email" name="email" placeholder="email" required><br><br>
	<input type="password" name="password" placeholder="password" required><br><br>
	<input type="password" name="passwordconf" placeholder="confirm_password" required><br><br>
	<input type="submit" name="send" placeholder="send" value="send" required><br><br>	
</form>
<?php  

$subscribeform=ob_get_clean();