<?php
$title = 'Créer un article';
// $title = 'Création d\'Article';
include 'assets/include/header.php'; 

if(!empty($userinfos) && $userinfos["id_droits"] == 1){
    header("Location: index.php");
}

if (isset($userinfos['id_utilisateurs']) && $_SESSION['user']['id_droits'] == 42 || isset($userinfos['id_utilisateurs']) && $_SESSION['user']['id_droits'] == 1337) 
{
    if(isset($_POST['enregistrer']))
    {
        // Avant d'upload l'image on initialise une taille max à 5mo et les formats autorisés
        $maxSize = 50000; 
        $validExt = array('.jpg', '.jpeg', '.png');

        if($_FILES['image']['error']> 0)
        {
            // throw new Exception('Une erreur est survenue lors du transfert.');
            $_SESSION['msg'] = "Une erreur est survenue lors du transfert.";
        }

        $fileSize = $_FILES['image']['size'];

        if($fileSize > $maxSize)
        {
            // throw new Exception('Le fichier ne doit pas dépassé 5 Mo.');
            $_SESSION['msg'] = "<p>Le fichier ne doit pas dépassé 5 Mo.</p>";
        }

        $fileName = $_FILES['image']['name'];
        $fileExt = '.'. strtolower(substr(strrchr($fileName, '.'), 1));

        if(!in_array($fileExt, $validExt))
        {
            // throw new Exception('Le format du fichier n\'est pas accépté.');
            $_SESSION['msg'] = "<p>Le format du fichier n\'est pas accépté.</p>";
        }

        $tmpName = $_FILES['image']['tmp_name']; 
        $uniqueName = md5(uniqid(rand(), true)); // Générer des noms d'images aleatoires

        $fileName = 'assets/images/articles/'.$uniqueName.$fileExt; 
        $result = move_uploaded_file($tmpName, $fileName);

        if($result)
        {
            // On met ds une var le nom et l'extention à enregistrer en bdd
            $image = $uniqueName.$fileExt;

                                    
            if(!empty($_POST['nameProduct']) && !empty($_FILES['image'])  && !empty($_POST['id_categorie'])) 
            {
                $list = $articles->display_List_Categ_Article($_POST['id_categorie']);
                foreach($list as $value => $key){
                    $key;
                }
                
                $_POST['id_categorie'] = $key['id'];

                // Enregistrement de l'article
                $testArt = $articles->insert_article($_POST['nameProduct'], $image, $_SESSION['user']['id_utilisateurs'], $_POST['id_categorie']);   

                $_SESSION['msg'] = "<p>Produits enregistrés.</p>";
                    header("Location: articles.php");
            }
        }
    }
}
// var_dump($_POST['enregistrer']);
// var_dump($image);
// var_dump($_SESSION['user']['id_utilisateurs']);
// var_dump( $_POST['id_categorie']);
// var_dump($testArt);

?>
<main class="main-first">
    <h1  class="title-main">Créer un artice</h1>
    <section class="form-product"> 
    <h3>Ajouter une nouvel article</h3>

    <form method="post" enctype="multipart/form-data" action="creer-article.php">
        <fieldset>
            <label for="nameProduct">Nom de l'article</label>
            <input type="text" id="nameProduct" name="nameProduct" placeholder="Nom de produit">

            <label for="image">Photo</label>
            <input type="file" id="image" name="image">
        </fieldset>

        <fieldset>
            <label for="idCategory">Categorie</label>
            <select name="id_categorie">
                <?php foreach ($list as $value => $key) { ?>
                        <option>
                            <?= htmlspecialchars($key['nom'])?>
                        </option>
                <?php } ?>
            </select><br>

        </fieldset>
        <button class="btn-submit" type="submit" name="enregistrer">Envoyer l'article</button>
        <p><strong>Note:</strong> Seuls les formats .jpg, .jpeg, .png sont autorisés jusqu'à une taille maximale de 5 Mo.</p>
    </form>
</section>

</main>

<?php 
include 'assets/include/footer.php'; 
?>