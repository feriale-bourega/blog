<?php 

ob_start();

?>
<form action="" method="post">
	<input type="text" name="connect" placeholder="username" required><br><br>
	<input type="password" name="password_conn" placeholder="password" required><br><br>
		<input type="submit" name="send" placeholder="send_conn" value="send" required><br><br>	
</form>
<?php 

$loginform=ob_get_clean(); 