<?php
$title = 'Administrateur';
include 'assets/include/header.php';

if(!empty($userinfos) && $userinfos["id_droits"] == 1 || $userinfos["id_droits"] == 42){
    header("Location: index.php");
}


$id_url = explode("?id= ",$_GET['id']);
$id_url = end($id_url);

if(!empty($_POST['delete'])) {
       
    $user->deleteUser($id_url);
    header("Location: admin.php");
}
$_SESSION['msg'] = "<p>Client supprimé.</p>";

?>
<main class="main-first">
    <h1 class="title-main">ADMINISTRATION</h1>
    <section>
        <h2 class="main-first">Suppression Fiche Client</h2>
        <p>En cliquant sur le bouton supprimer, vous supprimer définitivement l'utilisateur de votre base de donnée. Cette action est irréversible.</p>
            <form method="post" action="">

                <input type="submit" name="delete" value="Supprimer">
            </form>
    </section>
</main>
<?php 
include 'assets/include/footer.php'; 
?>