<?php 

session_start();

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>administrateur</title>
	<link rel="stylesheet" type="text/css" href="public/css/blog.css">
</head>
<header>
<?php 


require_once 'function.php';
require_once 'model.php';
require_once 'config/config.php';
$mydb=new myDb($server,$username,$password,$database);
$pdo=$mydb->getConn();

//menu______________________________________

$categories=new categories($pdo);
$cats=$categories;
$cats=$cats->getAllCategories();
require_once 'menu.php';
$forms=menuSubNav($cats);
$menu=str_replace( "<span>categories</span>", $forms, $menu);
echo $menu;	// print my menu
$user= new user($pdo);

//header____________________________________
if(!isset($_COOKIE['user'])){
	$sess=null;
	echo rightHeader($sess);
	if($row['nom']!=='administrateur'){
		header('location:index.php');
	}
} else {
	$id=$_COOKIE['connected'];
	$row=$user->getRights($id);
	echo rightHeader($row['nom']);
	if($row['nom']!=='administrateur'){
		header('location:index.php');
	}

}


// post router___________________________________
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
		case(isset($_POST['edit_user'])):
				$form=1;
				echo '<div class="fakemodal">';
				if($form==1){
					$user= new user($pdo);
					$user=$user->getAllInfo($_POST['edit_user']);
					echo '<small>modify user informations here</small><br><br>';
					$form=showUserForm();
					$form=str_replace('replaceme', 'administrateur.php', $form);
					$form=str_replace('placeholder="username"','placeholder="'.$user['login'].'"', $form);
					$form=str_replace('<input type="password" name="password" placeholder="password" required><br><br>',' ', $form);
					$form=str_replace('<input type="password" name="passwordconf" placeholder="confirm_password" required><br><br>','<input type="text" name="droits" placeholder="'.$user['id_droits'].'" required><br><br>',$form);
					$form=str_replace('placeholder="username"','placeholder="'.$user['login'].'"', $form);
					$form=str_replace('<input type="submit" name="send" placeholder="send" value="send" required><br><br>', '<button type="submit" name="sendx" value="'.$user['id'].'" required>edit user</button><br><br>', $form);
					echo $form;
					echo '</div>';
				}
				if(isset($_POST['close'])){
					$form=0;
					header('location:administrateur.php');
				}
				exit();
				break;
		case isset($_POST['sendx']):
				if( testPost(isset($_POST['username']))&&
					isset($_POST['email'])&&
					filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)&&
					testPost(isset($_POST['droits'])) ){
							$login=htmlspecialchars($_POST['username'], ENT_NOQUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8', /*double_encode*/false );
							$droits=htmlspecialchars($_POST['droits'], ENT_NOQUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8', /*double_encode*/false );
							$email=htmlspecialchars($_POST['email'], ENT_NOQUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8', /*double_encode*/false );
							$id=$_POST['sendx'];
							$userpw=$user->getAllInfo($id);
							$password=$userpw['password'];
							$current=$id;
							$user=$user->updateAdmin($login,$password,$email,$droits,$id,$current);
						if($user===false){
							echo '<span class="fakemodal">This user already exists.<br>Please, choose another username</span>';
							header('location:administrateur.php');
						} else {
							echo '<span class="fakemodal">you\'ve succesfully updated this user informations</span>';
							header('location:administrateur.php');
						}
				}
				exit();
				break;
		case isset($_POST['delete_user']):
				echo '<span class="fakemodaltext2">are you sure you want to delete this user?<br><form method="post"><button type="submit" name="yes" id="modifybtn" value="'.$_POST['delete_user'].'">yes, delete</button><button type="submit" name="close" value="close" id="modifybtn">no, go back</button></form>';
				exit();
				break;
		case isset($_POST['yes']):
				$id=$_POST['yes'];
				$user=new user($pdo);
				$user->deleteUser($id);
				header('location:administrateur.php');
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
						$list=catList($cats,$create);
						echo $list;
					}
					if(isset($_POST['close'])){
						$form=0;
						header("Refresh:0");
					}
				}
			}
			break;
		//delete __________________
		case isset($_POST['delete_cat']):
			$categories=new categories($pdo);
			$categories->deleteCat($_POST['delete_cat']);
			header('location:administrateur.php');
			break;
			exit();
		case isset($_POST['add_cat_btn']):
				if(isset($_POST['addcategoriesname'])){
					if(testPost($_POST['addcategoriesname'])===true){
						//$categories=new categories($pdo);
						$post=htmlspecialchars($_POST['addcategoriesname'], ENT_NOQUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8', /*double_encode*/false );
						$catadd=$categories;
						$catadd=$catadd->getCatByName($post);
						if($catadd!=0){
							echo '<span class="fakemodaltext2">this category already exists,please chose another name <br><form action="administrateur.php" method="post"><button type="submit" name="close" value="close" id="modifybtn">close</button></form>';
								exit();
								break;
						} else {
							$categories->addCatName($post);
							header( "location:administrateur.php" );
						}
					}
				}
			exit();
			break;
		case isset($_POST['edit_cat_choice']):
				if(isset($_POST['categoriesname'])){
					if(testPost($_POST['categoriesname'])===true){

						$nom_edit=htmlspecialchars($_POST['categoriesname'], ENT_NOQUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8', /*double_encode*/false );
						$id_cat=$_POST['edit_cat_choice'];
						$cattmp=$categories;
						$cattmpname=$cattmp;
						$cattmp=$cattmp->getAllCategories();
						$namecat=$cattmpname->getCatById($id_cat);
						if($namecat['nom']===$nom_edit){
							echo '<span class="fakemodaltext2">this category already exists,chose another name please<br><form action="administrateur.php" method="post"><button type="submit" name="close" value="close" id="modifybtn">close</button></form>';
								exit();
								break;
						} else {
							$categories->editCatById($id_cat,$nom_edit);
							header('location:administrateur.php');
							exit();
							break;
						}
					}
				}
			exit();
			break;
	endswitch;
}

if( isset($_POST['articletext'])&&
	testPost($_POST['articletext'])===true&&
	isset($_POST['categorieslist'])&&
	isset($_POST['sendarticle'])	){
		//$categories=new categories($pdo);
		$articletext=htmlspecialchars($_POST['articletext'], ENT_NOQUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8', /*double_encode*/false );
		$id_utilisateur=$_COOKIE['connected'];
		$id_categories=$_POST['categorieslist'];
		$idcat=$categories->nomToNum($id_categories);
		$user=$user->addArticle($id_utilisateur,$idcat,$articletext);
}


?> 
    <!--#Nous allons reproduire le même système, vérifier si on reçois les variables post de titre et de contenu. 
    #Si c’est le cas, nous allons lancer les fonctions qui ajoutent l’article à la base de donnée et 
    #afficher un message comme quoi l’article as bien été enregistré
    #Ici onécrit le code que l'administrateur verras
 {  # Dans cette partie, on écrit le code que l'utilisateur administrateur verras !-->

</header>
<body>
	<main>
    <p>Bienvenue, vous êtes connecté</p><br>
    <p>Vous pouvez modifier les information utilisateurs ici:</p><br>
 
<?php


//AFFICHAGE DES MEMBRES, SUPPRESION DES MEMBRES_______________

$conn=$mydb->getConn();
$recupUsers = $conn -> query('SELECT * FROM utilisateurs') ;
$userbasediv='<div id="useradmin">';
echo $userbasediv;
while ($user = $recupUsers -> fetch()){
	   // var_dump($user);
	$tmp = '<div class="useradminbelow">';
    $tmp .='<span><h3> username: '.$user['login'].'</h3>&#160;</span>';
    $tmp .= '<span> id: '.$user['id'].'&#160;</span>';
    $tmp .= '<span> droits: '.$user['id_droits'].'&#160;</span>';
    $tmp .= '<span> email: '.$user['email'].'&#160;</span>';	
    $tmp .= '<form method="post" action=""><button type="submit" name="edit_user" id="modifybtn" value="'.$user['id'].'">edit</button><button type="submit" name="delete_user" id="modifybtn" value="'.$user['id'].'">delete</button></form>';
    $tmp .= '</div>';
    echo $tmp;
}
$userbasediv='<br></div>';
echo $userbasediv;



// add , delete , erase categories______________________________________
$add= '';
$add .= '<div>';
$add .= '<h2>edit categories here:</h2>';
$add .= '<form method="post" action="administrateur.php"><button type="submit" name="edit_categories" id="modifybtn" value="editcateg">edit</button></form><br>';

echo $add;

//$categories=new categories($pdo);		//get my cat

if(isset($_POST['edit_categories'])){
	$cat=''; //temp to echo just variables and not raw html, should be kind of more safe ...
	$cat2=$categories->getAllCategories();
	for($i=0;$i<=isset($cat2[$i]);$i++){
		$cat.= '<br><span><b>'.$cat2[$i]['nom'].'</b></span> <i>'.$cat2[$i]['id'].'</i><br>';
		$cat.= '<form method="post" action=""><button type="submit" name="edit_cat" id="modifybtn" value="'.$cat2[$i]['id'].'">edit</button><button type="submit" name="delete_cat" id="modifybtn" value="'.$cat2[$i]['id'].'">delete</button></form><br>';
	}
	$cat .= '<form method="post" action=""><button type="submit" name="close" value="close" id="modifybtn">close edit categories</button></form><br>';
	$cat .= '<form method="post" action=""><button type="submit" name="add_cat" value="add" id="modifybtn">ADD NEW CATEGORY</button></form>';
	echo $cat;
}
if(isset($_POST['edit_cat'])){
	$edcat= '<div class="fakemodal"><form method="post" action="">';
	$edcat.= '<input type="text" name="categoriesname" placeholder="category"/><br><br>';
	$edcat.='<button type="submit" name="edit_cat_choice" id="modifybtn" value="'.$_POST['edit_cat'].'">edit</button><br>';
	$edcat.='<input type="submit" name="close" value="close" id="modifybtn"></input></form>';
	echo $edcat;

}



//add____________________
if(isset($_POST['add_cat'])){
	$addcat= '<div class="fakemodal"><form method="post" action="">';
	$addcat.= '<input type="text" name="addcategoriesname" placeholder="new_category"/><br><br>';
	$addcat.='<button type="submit" name="add_cat_btn" id="modifybtn" value="addme">add</button>';
	$addcat.= '<button type="submit" name="close" value="close" id="modifybtn">no, go back</button></form>';
	echo $addcat;	
}

if(isset($added)){
	echo '<span class="fakemodal">category added succesfully!<br><form action="administrateur.php" method="post"><button type="submit" name="close" value="close" id="modifybtn">close</button></form>';
}

echo '</div>'; //catdiv
echo '<br><br>';




// articles_______________

echo '<div id="adminarticles">';
echo '<table>';
$article=new article($pdo);
$count=$article->totalNum($cat=null);
$articles=$article->getAllArticles();
//var_dump($articles);
$articles=viewTotalArticles($articles);
$newarticle=articleLayout($articles);
echo $newarticle;
echo '</table><br><br>';
echo '</div>';
echo '<div id="subpagearticles">';
echo '<small><i>total num of articles on this site: '.$count.'</i></small>';
echo articlesPages($count,$cat=null,$start=null);	
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