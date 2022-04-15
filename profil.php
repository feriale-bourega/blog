<?php 
session_start();
var_dump("test");
//La page ne s'affiche que si la SESSION 'connexion' est bien crée (en page connexion)
//if(!isset($_SESSION['connexion']))
//{
  //  Autrement on redirige vers connexion
    //header('location: connexion.php');
    //exit();
//}
//ici on stocke le contenu de la variable SESSION (le login entré precedemment) dans $loginverify
//pour pouvoir l'utiliser pour fixer la ligne lors de la requete UPDATE
//$loginverify = $_SESSION['connexion'];

require('utilisateurs.php');
 //$user = new User($_POST['login'], $_POST['password']);
 $paul = new User();
 if(isset($_POST['submit'])){
	//if($password==$password2)
	
		//hachage du password
		//$password3 = password_hash($password, PASSWORD_BCRYPT, array('cost' =>10 ));
        
         $paul->getAllinfos($_POST['login'], $_POST['prenom'], $_POST['nom'], $_POST['password'], $_POST['password3']);
		// if ($count == 0){
    $g = $paul->update($_POST['login'], $_POST['prenom'], $_POST['nom'], $_POST['password'], $_POST['password3']);
		 
		}   
		?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="user.css" >
        <title>Profil</title>
    </head>  

    <body class="bodyinscription">
        <header class="header_ins">
            <h1>Profil</h1>
        </header>

        <main class="main_ins">
            <section class="boite_ins">
                <form class="form_ins" action="profil.php" method="post">
                <h1 class="head_profile">Modifiez vos informations</h2>
                    <article class="pseudo_ins">
                        <label for="login">Votre pseudo :</label>
                        <input type="text" id="login" name="login" required>
                    </article>
                    <article class="firstName_ins">
                        <label for="prenom">Prénom :</label>
                        <input type="text" id="enterFirstName" name="prenom" required>
                    </article>
                    <article class="lastName_ins">
                        <label for="nom">Nom :</label>
                        <input type="text" id="enterLastName" name="nom" required>
                    </article>
                    <article class="mp_ins">
                        <label for="password">Votre mot de passe : </label>
                        <input type="password" id="password" name="password" required>
                    </article>
                    <article class="mp_ins">
                        <label for="password3">Confirmez votre mot de passe :</label>
                        <input type="password" id="password3" name="password3" >
                    </article>      
                    <article class="button_ins">
                        <button type="submit" name="submit">Valider</button>
                    </article>
                    <a style="color:white; text-decoration:none;" href="deconnexion.php">Deconnexion</a>
                </form>
            </section>
        </main>

        <footer class="footer_ins">
            
        </footer>
        
    
    </body>
</html>
