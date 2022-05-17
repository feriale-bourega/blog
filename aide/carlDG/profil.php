<?php 

session_start();

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>profile</title>
	<link rel="stylesheet" type="text/css" href="public/css/blog.css">
</head>
<header>
<?php 
require_once 'menu.php';
require_once 'function.php';
require_once 'model.php';
require_once 'config/config.php';
$mydb=new myDb($server,$username,$password,$database);
$pdo=$mydb->getConn();

//menu___

$categories=new categories($pdo);
$categories=$categories->getAllCategories();
require_once 'menu.php';
$forms=menuSubNav($categories);
$menu=str_replace( "<span>categories</span>", $forms, $menu);
echo $menu;	// print my menu

$user=new user($pdo);		// get my user

if(!isset($_COOKIE['user'])){
	$sess=null;
	echo rightHeader($sess);
	header('location:index.php');
} else {
	$id=$_COOKIE['connected'];
	$row=$user->getRights($id);
	echo rightHeader($row['nom']);
}


// routing POSTS________________________________________

if($_POST){
	switch($_POST):
		case isset($_POST['home']):
				$row=$user->getRights($id);
				setcookie('connected',$row['id'], -1);	
				setcookie('user', $row['nom'], time() +36000);
				session_destroy();
				header('location:index.php');
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
		case(isset($_POST['modify'])):
				$form=1;
				echo '<div class="fakemodal">';
				if($form==1){
					echo '<small>update your personal <br>informations here</small>';
					$form=showUserForm();
					$form=str_replace('replaceme', 'profil.php', $form);
					echo $form;
					echo '</div>';
					echo '<style> #infoblock{ background-color:var(--black); } .fakemodal{ opacity:1;}</style>';
				}
				if(isset($_POST['close'])){
					$form=0;
					header('location:profil.php');
				}
				exit();
				break;
		case isset($_POST['editcomm']):
			$form=1;
			echo '<div class="fakemodalcomm">';
			if($form==1){
				echo '<small>edit your comment:</small>';
				require_once 'comment-form.php';
				$id_comment=$_POST['editcomm'];
				$comment=new comments($pdo);
				$comment=$comment->getCommentsByCommId($id_comment);
				//var_dump($comment);
				$commform=str_replace('DATEX',$comment[0]['date'],$commform);
				$commform=str_replace('pholder',$comment[0]['commentaire'],$commform);
				$commform=str_replace('mycommvalue',$comment[0]['id'],$commform);
				echo $commform;
				echo '<form action="" method="post"><input type="submit" name="close" value="close" id="modifybtn"></input></form>';
				echo '<style>  .fakemodalcomm{ opacity:1;}</style>';
			}
			if(isset($_POST['close'])){
				$form=0;
				header('location:profil.php');
			}
			exit();
			break;
		case isset($_POST['updatecomment']):
			if(isset($_POST['commenttext'])){
				if(testPost($_POST['commenttext'])===true){
					$comment=new comments($pdo);
					$id_comm=$_POST['updatecomment'];
					$commentaire=$_POST['commenttext'];
					$comment->editCommentFromProfile($id_comm,$commentaire);
				}
			}
			break;
		case isset($_POST['deletecomm']):
			$id_comm=$_POST['deletecomm'];
			$comment=new comments($pdo);
			$comment->deleteComment($id_comm);
			break;

			// update profile____________________
		case testPost(isset($_POST['username']))&&
				testPost(isset($_POST['password']))&&
				isset($_POST['email'])&&
				filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)&&
				testPost(isset($_POST['passwordconf']))&&
				testPost($_POST['password'])===testPost($_POST['passwordconf']):
						$_POST['passwordconf']=htmlspecialchars($_POST['passwordconf'], ENT_NOQUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8', /*double_encode*/false );
						$id=$_COOKIE['connected'];
						$login=htmlspecialchars($_POST['username'], ENT_NOQUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8', /*double_encode*/false );
						$password=htmlspecialchars($_POST['password'], ENT_NOQUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8', /*double_encode*/false );
						$email=htmlspecialchars($_POST['email'], ENT_NOQUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8', /*double_encode*/false );
						$row=$user->getRights($id);
						$id_droits=$row['id_droits']; //int cause in bd int id
						$userupdated=$user->updateUser($login,$password,$email,$id_droits,$id);
						if($userupdated!==false){
								echo '<span class="fakemodaltext">succesfully updated!<br><form action=""><button type="submit" name="close" class="miniclose">close</button></form></span>';
								header( "refresh:2;url=profil.php" );
						} else {
							echo '<span class="fakemodaltext2">This username or email already exists.<br>Please, choose another username<form action=""><button type="submit" name="close" class="miniclose">close</button></form></span>';
							header( "refresh:2;url=profil.php" );
						}
				exit();
				break;
	endswitch;
}


?>
</header><br><br><br>
<body>
	<main>
	<div class="profile">
<?php 

// show profile_______________________________

if(isset($_COOKIE['connected'])){
	$id=$_COOKIE['connected'];
	$row=$user->getRights($id);
	echo '<div id="infoblock">';
	if($row['nom']==='administrateur'){
		echo '<a href="administrateur.php"> page administrateur </a><br>';
	}
	showDetails($row);
	echo '</div>';
	$commentsrow=$user->getComments($id);
	//var_dump($commentsrow);
	if($commentsrow!=null){
	echo '<div id="mainprofile">';
	$comments=showComments($commentsrow);
	echo $comments;
	echo '<br><br></div>';
	} else {	
	echo '<div id="mainprofile">';
	echo '<h2> you haven\'t commented any article yet </h2>';
	echo '</div>';
	}
} // remember header location if !isset 


echo '</div><br>';

?>
	<div class="mod">
		<div class="blocksm">
			<h2>write a new article here:</h2>
			<form action="" method="post">
			<button type="submit" name="write_article" value="send" id="write">write</button>
			</form><br>
<?php

// create or write_____________________________

if(isset($_COOKIE['connected'])){
	$id= $_COOKIE['connected'];
	if(!empty($user)){
		$row=$user->getRights(intval($id));
		if($row['nom']==='administrateur'||$row['nom']==='moderateur'){ 
			if(isset($_POST['write_article'])||isset($_POST['create'])){
				$form=1;
				echo '<div class="fakemodaltext">';
				if($form==1){
					require_once 'creer-article.php';
					$list=catList($categories,$create);
					echo $list;
				}
			}
		} else {
			echo '<small>you need to be a moderator or administrator to write articles</small>';
			echo '<style> #write{ background-color:var(--black); opacity:0.3; .fakemodal{ opacity:1;}</style>';
		}
	} 
}
if( isset($_POST['articletext'])&&
	testPost($_POST['articletext'])===true&&
	isset($_POST['categorieslist'])&&
	isset($_POST['sendarticle'])	){
		$categories=new categories($pdo);
		$articletext=htmlspecialchars($_POST['articletext'], ENT_NOQUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8', /*double_encode*/false );
		$id_utilisateur=$_COOKIE['connected'];
		$id_categories=$_POST['categorieslist'];
		$idcat=$categories->nomToNum($id_categories);
		$user=$user->addArticle($id_utilisateur,$idcat,$articletext);
}


 
?>
		</div>
		<div class="blocksmart"> 
<?php 

//article views__________________________________

echo '<div id="articleid"><h2>your latest articles</h2>';
$article=new article($pdo);
if(isset($_COOKIE['connected'])){
	$id_user=$_COOKIE['connected'];
	$articles=$article->getUserArticles($id_user);
	if(!empty($articles)){
		$x=count($articles);
		echo $article=articleLayout(viewArticles($articles,$x));
		echo '<small><br><br><i>total num of articles written by you: '.$x.'</i><br><br></small>';
		echo articlesPages($x,$cat=null,$start=null);
		$categories=new categories($pdo);
		$categories=$categories->getAllCategories();
		echo '<br></div><span><br></span>';
		showCatNav($categories);
		echo '<br><span><br></span><br>';

	} else {
		echo '<h2> there are no articles yet</h2>';
		echo '</div>';
	}
}

?>
		</div>
	</div>
		<div class="admin">
		</div>
	</div>
	<br><br><br><br>
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