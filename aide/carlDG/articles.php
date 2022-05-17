<?php

session_start();

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>articles</title>
<?php  

if(isset($_GET['categories']) and isset($_GET['start'])){
	echo '<link rel="stylesheet" type="text/css" href="./public/css/blog.css">';
} elseif(isset($_GET['categories']) and !isset($_GET['start'])) { 
	echo '<link rel="stylesheet" type="text/css" href="./public/css/blog.css">'; 
} else {
	echo '<link rel="stylesheet" type="text/css" href="./public/css/blog.css">'; 	
}

?>
</head>
<header>
<?php 
require_once 'menu.php';
require_once 'function.php';
require_once 'model.php';
require_once 'config/config.php';
$mydb=new myDb($server,$username,$password,$database);
$pdo=$mydb->getConn();

//__menu

$categories=new categories($pdo);
$categories=$categories->getAllCategories();
require_once 'menu.php';
$forms=menuSubNav($categories);
$menu=str_replace( "<span>categories</span>", $forms, $menu);
echo $menu;


$user=new user($pdo);		// get my user

if(!isset($_COOKIE['user'])){
	$sess=null;
	echo rightHeader($sess);
} else {
	$id=$_COOKIE['connected'];
	$row=$user->getRights($id);
	echo rightHeader($row['nom']);
}

if($_POST){
	switch($_POST):
		case isset($_POST['home']):
				$row=$user->getRights($id);
				setcookie('connected',$row['id'], -1);	
				setcookie('user', $row['nom'], time() +36000);
				session_destroy();
				header('location: ./index.php');
				exit();
				break;
		case isset($_POST['disconnect']):
				setcookie('connected',0, -1);	
				setcookie('user', null, -1);	
				setcookie('form', null, -1);
				session_destroy();
				session_write_close();
				header('location: ./index.php');
				exit();
				break;
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
		case isset($_POST['create']):
			$form=1;
			$user=new user($pdo);
			if(isset($_COOKIE['connected'])){
				$id=$_COOKIE['connected'];
				$row=$user->getRights($id);
				if($row['nom']==='administrateur'||$row['nom']==='moderateur'){ 
					echo '<div class="fakemodaltext">';
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
	<main id="articlesmainlayout">
		<form action="articles.php" method="get">
				<button type="submit" name="articles" value="articles"><b>ALL ARTICLES</b></button> 
		</form><br>
<?php



//echo '<div id="articleid">';
echo '<table>';
$article=new article($pdo);
if(isset($_GET['categories'])){
	$cat=$_GET['categories'];	
	$count=$article->totalNum($cat);
} else {
	$cat=null;
	$count=$article->totalNum($cat);
}
if($count>0){
	$articles=$article->getAllArticles();
	if($_GET){
		switch ($_GET):
			case !isset($_GET['start']) and !isset($_GET['categories']):
				$k=0;
				$articles=viewAllArticles($articles,$k);
				echo articlesPages($count,$cat,$k).'<br><span><br></span>';
				break;
			case !isset($_GET['categories']) and isset($_GET['start']) :
				$k=$_GET['start'];
				$articles=viewAllArticles($articles,$k);
				echo articlesPages($count,$cat,$k).'<br><span><br></span>';
				break;
			case isset($_GET['categories']) and isset($_GET['start']):
				$k=$_GET['start'];
				$cat=$_GET['categories'];	
				$articles=$article->getArticlesByCat($cat);
				$articles=viewAllArticles($articles,$k);
				echo articlesPages($count,$cat,$k).'<br><span><br></span>';
				break;
			case isset($_GET['categories']):
				if(isset($_GET['start'])){
					$k=$_GET['start'];;
				}
				$k=0;
				$cat=$_GET['categories'];	
				$articles=$article->getArticlesByCat($cat);
				$articles=viewAllArticles($articles,$k);
				echo articlesPages($count,$cat,$k).'<br><span><br></span>';
				break;
		endswitch;
	}
	$newarticle=articleLayout($articles); 
	echo $newarticle;
} else {
	 echo '<h2>there are no articles yet</h2>';
}
echo '</table><br><br>';
echo '<div id="subpagearticles">';
if(isset($_GET['categories'])){
	echo '<small><i>total num of articles in this category: '.$count.'</i></small>';
} else {
	echo '<small><i>total num of articles in this site: '.$count.'</i></small>';	
}

$categories=new categories($pdo);
$categories=$categories->getAllCategories();
showCatNav($categories);
echo '</div><br><br>';	//subpagearticle______
echo '<br><span><br></span><br>';


?>
	</main>
</body>
	<footer>
		<div id="ourfooter">
			<div>
				<div id="logogit">
					<img src="gitlogo.png" alt="gitlogoomar" width="40" height="40" >
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