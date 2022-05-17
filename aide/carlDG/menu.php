<?php

ob_start();

?>
	<br>
		<div id="menuwrapper">
			<div id="menu">
				<form action="" method="post">
				<input type="submit" name="home" value="home"/>
				</form>
				<div id="sub">
					<div class="menuwrapper">
						<span>categories</span>
					</div>
					<form action="articles.php" method="get">
						<button type="submit" name="articles" value="articles"><b>all articles</b></button> 
					</form>
				</div>
			</div>
		</div>
		<br>
<?php 

$menu=ob_get_clean();

