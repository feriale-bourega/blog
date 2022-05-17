<?php 

session_start();

require_once 'config/config.php';
require_once 'function.php';
require_once 'model.php';

$mydb=new myDb($server,$username,$password,$database);
$pdo=$mydb->getConn();

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>bloX</title>
	<link rel="stylesheet" type="text/css" href="public/css/blog.css">
</head>
<header>
<?php 


//menu___

$categories=new categories($pdo);
$categories=$categories->getAllCategories();	//
require_once 'menu.php';
$forms=menuSubNav($categories);//
$menu=str_replace( "<span>categories</span>", $forms, $menu);
echo $menu;	// print my menu

if(!isset($_COOKIE['user'])){
	$sess=null;
	echo rightHeader($sess);
} else {
	$user=new user($pdo);		// get my user
	$id=$_COOKIE['connected'];
	$row=$user->getRights($id);
	echo rightHeader($row['nom']);
}


if($_POST){
	switch($_POST):
		case isset($_POST['subscribe']):
				setcookie('form','subscribe', time() +36000);
				header('location: inscription.php');
				exit();
				break;
		case isset($_POST['login']):
				setcookie('form','login', time() +36000);
				header('location: inscription.php');
				exit();
				break;
		case isset($_POST['disconnect']):
				setcookie('connected',0, -1);	
				setcookie('user', null, -1);	
				setcookie('form', null, -1);
				session_destroy();
				session_write_close();
				header('location: index.php');
				exit();
				break;
		case isset($_POST['create']):
			$form=1;
			$user=new user($pdo);
			if(isset($_COOKIE['connected'])){
				$id=$_COOKIE['connected'];
				$row=$user->getRights($id);
				if($row['nom']==='administrateur'||$row['nom']==='moderateur'){ 
					echo '<div class="fakemodaltext2">';
					if($form==1){
						require_once 'creer-article.php';
						$list=catList($categories,$create);
						echo $list;
					}
					if(isset($_POST['close'])){
						$form=0;
						header("Refresh:0");
					}
				}
			}
			break;

		case isset($_POST['articletext'])&&
			 testPost($_POST['articletext'])===true&&
			 isset($_POST['categorieslist'])&&
			 isset($_POST['sendarticle']):
				$categories=new categories($pdo);
				$user=new user($pdo);
				$articletext=htmlspecialchars($_POST['articletext'], ENT_NOQUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8', /*double_encode*/false );
				$id_utilisateur=$_COOKIE['connected'];
				$id_categories=$_POST['categorieslist'];
				$idcat=$categories->nomToNum($id_categories);
				$user=$user->addArticle($id_utilisateur,$idcat,$articletext);
			break;

	endswitch;
}

?>
</header><br><br><br>
<body>
	<main id="indexmain">
		<form action="articles.php" method="get">
				<button type="submit" name="articles" value="articles"><b>ALL ARTICLES</b></button> 
		</form><br>
<?php

$article=new article($pdo);
$articles=$article->getAllArticles();
echo '<table id="indexarttable">';
$table=viewArticles($articles,3);
echo $table;
echo '</table>';
$count=$article->totalNum($cat=null);
echo '<br><br><small><i>total num of articles on this site: '.$count.'</i></small>';
echo articlesPages($count,$cat=null,$start=null);
$categories=new categories($pdo); 
$categories=$categories->getAllCategories();
showCatNav($categories);
echo '<br><span><br></span><br>';

?>
	</main>
</body>
	<footer>
		<div id="ourfooter">
			<div>
				<div id="logogit">
					<img src="gitlogo.png" alt="gitlogoomar" width="40px" height="40px" >
					<div id="subfoot">
						<a href="https://github.com/Omar-Diane">Omar</a>
						<a href="https://github.com/Giacomo-DeGrandi">Giak</a>
					</div>
				</div>
			</div>
			<div id="linksfoot">
				<div id="btnfooters">
<?php

if(!isset($_COOKIE['user'])){
	$sess=null;
	echo rightFooter($sess);
} else {
	$user=new user($pdo);		// get my user
	$id=$_COOKIE['connected'];
	$row=$user->getRights($id);
	echo rightFooter($row['nom']);
}

?>
				</div>
			</div>
		</div>
	</footer>
</html>