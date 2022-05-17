<?php
$title = 'Créer une catégorie';
// $title = 'Création d\'Article';
include 'assets/include/header.php'; 


if(!empty($userinfos) && $userinfos["id_droits"] == 1 || $userinfos["id_droits"] == 42){
    header("Location: index.php");
}

if (isset($_SESSION['user']['id_utilisateurs']) && $_SESSION['user']['id_droits'] == 42 || isset($_SESSION['user']['id_utilisateurs']) &&$_SESSION['user']['id_droits'] == 1337) 
{
    if(isset($_POST['enregistrer']))
    {
        if(!empty($_POST['nameCategorie'])) 
        {
            $articles->insert_categorie($_POST['nameCategorie']);   
            $_SESSION['msg'] = "<p>Catégorie enregistrés.</p>";
            header("Location: admin.php");
        }
    }
}

?>
<main class="main-first">
    <h1  class="title-main">Créer une catégorie</h1>
    <section class="form-product"> 
        <form method="post" action="creer-categorie.php">
            <fieldset>
                <label for="nameCategorie">Nom de la catégorie</label>
                <input type="text" id="nameCategorie" name="nameCategorie" placeholder="Nom de produit">
            </fieldset>
            <input type="submit" name="enregistrer" value="Enregistrer">
        </form>
    </section>
</main>

<?php 
include 'assets/include/footer.php'; 
?>