<?php 

session_start();

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>subscribe</title>
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

if(!isset($_COOKIE['user'])){
	$sess=null;
	echo rightHeader($sess);
} else {
	echo rightHeader($_COOKIE['user']);
}


?>
</header><br><br><br>
<body>
	<main>
<?php 


if($_POST){
	switch($_POST):
		case isset($_POST['home']):
				setcookie('form', null, -1);
				session_destroy();
				header('location:index.php');
				exit();
				break;
		case isset($_POST['login']):
				setcookie('form','login', time() +36000);
				header('location: inscription.php');
				exit();
				break;
		case isset($_POST['subscribe']):
				setcookie('form','subscribe', time() +36000);
				header('location: inscription.php');
				exit();
				break;
		case isset($_POST['disconnect']):
				setcookie('user', 0, -1);
				setcookie('connected', 0, -1);
				session_destroy();
				session_write_close();
				header('location: index.php');
				exit();
				break;
	endswitch;
}

if(isset($_COOKIE['form'])){
	echo rightForm($_COOKIE['form']);
} 

$user=new user($pdo); 	// get my user class

if( isset($_POST['username'])&&isset($_POST['password'])&&isset($_POST['email'])&&filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)&&
	isset($_POST['passwordconf'])	){ 
		if( testPost($_POST['username'])&&
			testPost($_POST['password'])&&
			testPost($_POST['passwordconf'])&&
			testPost($_POST['password'])===testPost($_POST['passwordconf'])&&
			isset($_POST['send']) ){
					echo testPost($_POST['username']);
					$_POST['passwordconf']=htmlspecialchars($_POST['passwordconf']);
					$login=htmlspecialchars($_POST['username']);
					$password=htmlspecialchars($_POST['password']);
					$password_encrypted = password_hash($password, PASSWORD_BCRYPT);
					$email=htmlspecialchars($_POST['email']);
					$id_droits=1; //int cause in bd int id
					$user=$user->subscribeUser($login,$password_encrypted,$email,$id_droits);
				if($user===false){
					echo 'This user already exists.<br>Please, choose another username or log in <br> to get access to your account';
				} else {
					echo '<span class="fakemodaltext">Thanks! You\'re subscription is complete, you\'ll be redirected to the login page.</span>';
					setcookie('form','login', time() +36000);
					header( "refresh:2;url=inscription.php" );
				}
		} else {
			echo '<span>please insert a valid input</span>';
		}
} else {
	echo '<span>Please fill in all the fields</span>';
}
if(isset($_POST['connect'])||isset($_POST['password_conn'])){ 
	if( testPost(isset($_POST['connect']))&&
		testPost(isset($_POST['password_conn']))){
				$login=htmlspecialchars($_POST['connect']);
				$password=htmlspecialchars($_POST['password_conn']);
				$row=$user->connect($login,$password);
				if(!empty($row)){
					echo '<span class="fakemodal">succesfully connected.<br> Hi <b>'.$login.'<b></span>';
					setcookie('user','user', time() +36000);	
					setcookie('connected',$row['id'], time() +36000);				
					header( "refresh:1.5;url=profil.php" );
				} else {
					echo '<span>Incorrect username or password</span>';
				}
	}
}
if(isset($_COOKIE['form'])){		//layout
	if($_COOKIE['form']==='login'){
		echo '<br><br><br><br><br><br><br><br><br><br><br><br><br><br>';
	} else { echo '<br><br><br><br><br><br><br><br><br><br>';}
} 

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