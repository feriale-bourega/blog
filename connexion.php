<?php
                    session_start();
                    require_once('header.php');
                    require_once('utilisateurs.php');
                    $mathilde = new User();
                    if(isset($_POST['submit'])){
                        $p = $mathilde->connect($_POST['login'], $_POST['password']);
    
    //Decryptage du password 
   // $hash = password_hash($password, PASSWORD_DEFAULT);
   // $verify = password_verify($password, $hash);
   // }  
    
    //si verify existe
   // if($password==true)
    //{
      // $_SESSION['connexion'] =  $login ;
   //}
           header('Location: profil.php');}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="user.css" >
        <title>Connexion</title>
        <article class="linkcreate">
                        <a style="color:black; text-decoration:none;" class="boutton_nav" href="inscription.php">Créer un compte</a><br/>
                        <a style="color:black; text-decoration:none;" class="boutton_nav" href="profil.php">Profil</a>
                    </article>
    </head>

    <body class="bodyinscription">

        <header class="header_ins">
            <h1>Connexion</h1>
        </header>

        <main class="main_ins">
            <section class="boite_ins">
                <form class="form_ins" action="connexion.php" method="post">
                    <article class="pseudo_ins">
                        <label for="pseudo">Votre pseudo :</label>
                        <input type="text" id="pseudo" name="login" required>
                    </article>
                    <article class="mp_ins">
                        <label for="motdepasse">Votre mot de passe :</label>
                        <input type="password" id="motdepasse" name="password" required>
                    </article>
                    <article class="button_ins">
                        <button type="submit" name="submit" >Valider</button>
                    </article>
                </form>
                </section>
        </main>

    </body>
</html>

		
			 
