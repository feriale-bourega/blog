<?php
$title = 'Inscription';
include 'assets/include/header.php';
?>
<main class="main-first">
    <div class="login-form">
        <form method="post">
            <h2 class="text-center">Inscription</h2>
            <div class="form-group">
                <?php
                if (isset($_GET['reg_err'])) {
                    $err = htmlspecialchars($_GET['reg_err']);

                    if (isset($_POST['submit'])) {
                        $Datas = $user->register($_POST['login'], $_POST['password'], $_POST['passwordConfirm'], $_POST['email']);
                    }
                    switch ($err) {
                        case 'success':
                ?>
                            <div class="alert alert-success">
                                <strong>Succès</strong> inscription réussie !
                            </div>
                        <?php
                            break;

                        case 'password':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> mot de passe différent
                            </div>
                        <?php
                            break;

                        case 'already':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> compte deja existant
                            </div>
                <?php

                    }
                }
                ?>
                <div class="form-group">
                    <label for="InputLogin">Login</label>
                    <input type="text" class="form-control" name="login" placeholder="identifiant">
                </div>
                <div class="form-group">
                    <label for="InputLogin">Email</label>
                    <input type="text" class="form-control" name="email" placeholder="email">
                </div>
                <div class="form-group">
                    <label for="InputPassword1">Password</label>
                    <input type="password" class="form-control" name="password">
                </div>
                <div class="form-group">
                    <label for="InputPassword1">Password Confirm</label>

                    <input type="password" class="form-control" name="passwordConfirm">
                </div>
                <button type="submit" class="btn btn-primary" name="submit" value="s'inscrire">S'inscrire</button>
            </div>
        </form>
    </div>
</main>
<?php
if (isset($_POST['submit'])) {
    $user->register($_POST['login'], $_POST['password'], $_POST['passwordConfirm'], $_POST['email']);
}
?>
<?php
include 'assets/include/footer.php';
?>