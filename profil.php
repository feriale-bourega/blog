<?php
include 'assets/include/header.php';

if(!$_SESSION)
    {
        header("Location:index.php");
    }
 
if(isset($_POST['submit']))
{
    $user->updatelogin($_POST['login']);
}
// var_dump($_SESSION);
// var_dump($_POST['submit']);
?>
<main class="main-first">
    <h2 class="main-first">Bienvenue :  <?=   $_SESSION["user"]["login"] //$_SESSION["admin"][0]["login"]  ?></h2>
    <section class="Profil">
        <article>
            <div class="login-form">
                <form method="post">
                    <div class="form-group">
                        <input type="text" name="login" value="" placeholder="Identifiant">
                        </div>
                        <?php
                        if(isset($_SESSION['error']))
                        {
                            echo $_SESSION['error'];
                        }
                        ?>
                    <div class="form-group">
                        <input type="submit" name="submit" class="btn btn-info" value="mise à jour du login">
                    </div>
                </form>
            </div>
        </article>
        
        <?php
        $userEmail = new User();
        if (isset($_POST['submit-login'])) {
            $userEmail->updateEmail($_POST['email']);
        }
        ?>
        <article>
            <div class="email-form">
                <form method="post">
                    <div class="form-group">
                        <input type="text" name="email" value="" placeholder="email">
                        </div>
                        <?php
                        if(isset($_SESSION['error']))
                        {
                            echo $_SESSION['error'];
                        }
                        ?>
                    <div class="form-group">
                        <input type="submit" name="submit-login" class="btn btn-info" value="mise à jour de l'email">
                    </div>
                </form>
            </div>
        </article>

        <?php
        $userData = new User();
        if (isset($_POST['register'])) {
            $userData->updatepassword($_POST['password'], $_POST['passwordConfirm']);
        }
        ?>
        <article>
            <div class="login-form">
                <form method="post">
                    <div class="form-group">
                        <input type="password" name="password" value="" placeholder="password">
                    </div>
                    <div class="form-group">
                        <input type="password" name="passwordConfirm" value="" placeholder="passwordConfirm">
                    </div>
                    <?php
                        if(isset($_SESSION['error']))
                        {
                            echo $_SESSION['error'];
                        }
                        ?>

                    <button type="register" name="register" class="btn btn-info" value="mise à jour du password">Mise à jour du password</button>
                </form>
            </div>
        </article>

    </section>
<h2 class="main-first">Voici vos  informations. Votre identifiant est  <?= $_SESSION["user"]["login"] //$_SESSION["admin"][0]["login"] ?>
 et votre email est  "<?= $_SESSION["user"]["email"] //$_SESSION["admin"][0]["email"] ?>".</h2>

</main>
<?php 
include 'assets/include/footer.php';
unset($_SESSION['error']);
?>