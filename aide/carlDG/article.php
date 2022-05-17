<?php

session_start();

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>articles</title>
	<link rel="stylesheet" type="text/css" href="./public/css/blog.css">
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
$catalias=$categories;
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
				setcookie('user', $row['nom'], time() +3600);
				session_destroy();
				header('location: index.php');
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
		case isset($_POST['subscribe']):
				setcookie('form','subscribe', time() +3600);
				header('location: inscription.php');
				exit();
				break;
		case isset($_POST['login']):
				setcookie('form','login', time() +3600);
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
		case isset($_POST['editarticle']):
			echo '<style> #createbtn{pointer-events:none;} </style>';
			$form=1;
			$user=new user($pdo);
			if(isset($_COOKIE['connected'])){
				$id=$_COOKIE['connected'];
				$row=$user->getRights($id);
				$catx=new categories($pdo);
				$catx=$catx->getAllCategories();
				if($row['nom']==='administrateur'||$row['nom']==='moderateur'){ 
					echo '<div class="fakemodaltext">';
					if($form==1){
						require_once 'creer-article.php';
						$editart=$create;
						$catlist=catListEdit($catx);
						$editart=str_replace('<span>insert data list here</span>',$catlist,$editart);
						$editart=str_replace('<h2>write here your article:</h2>','<h2>edit article </h2>',$editart);
						$editart=str_replace('articletext','articleedit',$editart);
						$editart=str_replace('sendarticle','sendeditart',$editart);
						$editart=str_replace('write','edit',$editart);
						$id_article=$_GET['id'];
						$article= new article($pdo);
						$article=$article->getOneArticle($id_article);
						$editart=str_replace('<textarea name="articleedit" rows="15" cols="60" >','<textarea name="articleedit" rows="15" cols="60" placeholder="'.$article[0]['article'].'">'.$article[0]['article'].'</textarea><br>',$editart);
						echo $editart.'<form method="post"><input type="submit" name="close" value="close" id="modifybtn"></input></form>';
					}
					if(isset($_POST['close'])){
						$form=0;
						header("Refresh:0");
					}
				}
			}
			exit();
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
		case isset($_POST['submitcomment']):
				if(testPost($_POST['comment'])===true){
					$commentaire=new comments($pdo);
					$id_article=$_GET['id'];
					$id_user=$_COOKIE['connected'];
					$comment=htmlspecialchars($_POST['comment'], ENT_NOQUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8', /*double_encode*/false );
					$date = date("Y-m-d H:i:s");
					$commentaire->addCommentsFromArt($comment,$id_user,$id_article,$date);
				}
			break;
		case isset($_POST['sendeditart']):
			if(testPost(isset($_POST['articleedit']))===true&&
				 isset($_POST['categorieslist'])){
				$article=new article($pdo);
				$id_article=$_GET['id'];
				$catname=$_POST['categorieslist'];
				$catsend=new categories($pdo);
				$id_cat=$catsend->getCatByName($catname);
				$id_cat=$id_cat['id'];
				$edit=htmlspecialchars($_POST['articleedit'], ENT_NOQUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8', /*double_encode*/false );
				$article=$article->updateArticle($id_article,$edit,$id_cat);
			}
			break;
		case isset($_POST['deletearticle']):
				echo '<span class="fakemodaltext2">are you sure you want to delete this Article?<br><form action="" method="post"><button type="submit" name="yes" id="modifybtn" value="'.$_POST['deletearticle'].'">yes, delete</button><button type="submit" name="close" value="close" id="modifybtn">no, go back</button></form>';
				exit();
				break;
		case isset($_POST['yes']):
				$id=$_POST['yes'];
				$articlenow=new article($pdo);
				$articlenow->deleteArticle($_POST['yes']);
				setcookie('connected',$row['id'], -1);	
				setcookie('user', $row['nom'], time() +36000);
				session_destroy();
				header('location: index.php');
				exit();
				break;

	endswitch;
}



?>
</header><br><br><br>
<body>
	<main id="onearticmain">
<?php


echo '<div id="articlemain">';
$article=new article($pdo);
$id_article=$_GET['id'];
$article=$article->getOneArticle($id_article);
echo viewOneArticle($article);
if(isset($_COOKIE['connected'])){
	$id_user=$_COOKIE['connected'];
	$user=new user($pdo);
	$user=$user->getRights($_COOKIE['connected']);
}
if(!empty($id_user)){
	if($article[0]['id']===$id_user||$user['nom']==='administrateur'){
		echo '<form action="" method="post"><button type="submit" name="editarticle" value="'.$id_article.'">edit</button></form>';
		echo '<form action="" method="post"><button type="submit" name="deletearticle" value="'.$id_article.'">delete</button></form>';
	}
}
$comments=new comments($pdo); 
$comments=$comments->getCommentsByArticle($id_article);
echo '<span><br><br><br></span>'; // some space
echo '<div class="commentswrapper">';
if(isset($_COOKIE['connected'])){
	$cookie=$_COOKIE['connected'];
} else { $cookie=null;}
if(isset($_COOKIE['connected']) and $_COOKIE['connected']!==0){
echo commentsForm($cookie);
} else { echo '<br><span><small>log in to leave a comment</small></span>'; }
if(!empty($comments)){
echo showCommentsOnArticles($comments);
echo '</div><br><br>';
}
echo '</div><br><br>';
$categories=new categories($pdo);
$categories=$categories->getAllCategories();
showCatNav($categories);
echo '<br><br></div>';
echo '<br><span><br></span><br>';



?>
	</main>
</body><br><br>
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