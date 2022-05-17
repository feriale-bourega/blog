<?php 

ob_start();

?>
<form action="" method="post">
	<br> 
	<small>sent: DATEX</small><br>
	<textarea  name="commenttext" rows="4" cols="50" placeholder="pholder"></textarea><br>
	<button type="submit" name="updatecomment" value="mycommvalue">update comment</button></form><br>
</form>
<?php 

$commform=ob_get_clean();