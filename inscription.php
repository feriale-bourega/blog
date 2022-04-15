<?php
require('header.php');
 require_once('utilisateurs.php');
$pierre = new User();
 if(isset($_POST['submit'])){
    $g = $pierre->register($_POST['login'], $_POST['password'], $_POST['password2'], $_POST['email']);
    var_dump($g);
     header('Location: connexion.php');
    }
    
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link  rel="stylesheet" type="text/css" href="user.css">
        <title>Inscription</title>
    </head>  

    <body class="bodyinscription">
        <header class="header_ins">
            <h1>Inscription</h1>
        </header>

        <main class="main_ins">
            <section class="boite_ins">
                <form class="form_ins" action="inscription.php" method="post">
                    <article class="pseudo_ins">
                        <label for="login">Votre pseudo :</label>
                        <input type="text" id="login" name="login" <?php //echo $erreur_login;?>>
                    </article>
                    <article class="email_ins">
                        <label for="enteremail">Email :</label>
                        <input type="text" id="enteremail" name="email" <?php //echo $erreur_prenom;?>>
                    </article>
                    
                    <article class="mp_ins">
                        <label for="enterMp">Mot de passe : </label>
                        <input type="password" id="enterMp" name="password" <?php //echo $erreur_mdp;?>>
                    </article>    
                    <article class="mp_ins">
                        <label for="confirmMp">Confirmez votre mot de passe :</label>
                        <input type="password" id="confirmMp" name="password2" <?php //echo $erreur_mdp2;?>>

                    </article>  
                    <article class="button_ins">
                        <button type="submit" value="Submit"  name="submit">Valider</button><br/>
                        <a style="color:white; text-decoration:none;" class="boutton_nav" href="index.php">Retour accueil</a>
                        
                    </article>
                    <?php
                    
            //echo $user->getLogin(). '<br>';
            //echo $user->getPassword().'<br>';
           
        ?>
                </form>
                
            </section>
        </main>
        <?php  //include('../pages/footer.php')  ?> 
        <footer class="footer_ins">
            
        </footer>
        
    
    </body>
    </html>