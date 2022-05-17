<?php 

ob_start();

?>
<form action="" method="post">
	<h2>write here your article:</h2>
	<span>insert data list here</span>
	<textarea name="articletext" rows="15" cols="60" ></textarea><br>
	<button type="submit" name="sendarticle" value="send">write</button><br> 
</form>
<?php 

$create=ob_get_clean();