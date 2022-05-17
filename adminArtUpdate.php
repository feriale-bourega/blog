<?php
$title = 'Administrateur';
include 'assets/include/header.php';

if(!empty($userinfos) && $userinfos["id_droits"] == 1 || $userinfos["id_droits"] == 42){
    header("Location: index.php");
}


$id_url = explode("?id=",$_GET['id']);
$id_url = end($id_url);
// var_dump($id_url);
$resProduct = $articles->getArtByID($id_url);
// var_dump($resProduct);
$resCats = $articles->getArt();
// var_dump($resCats);

if(isset($_POST['register']))
    {
    
        $maxSize = 50000; 
        $validExt = array('.jpg', '.jpeg', '.png', '.svg');

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
        $result = move_uploaded_file( $tmpName, $fileName);

        if($result)
        {
            $nameArticle = htmlspecialchars($_POST['nameArticle']);
            $img = $_FILES['image'];
            $idCategory = htmlspecialchars($_POST['idCategory']);


            // On met ds une var le nom et l'extention à enregistrer en bdd
            $image = $uniqueName.$fileExt;

            $idCategory = $resProduct['id_categorie'];
            // var_dump($idCategory);
            $id_url = intval($id_url);


                // Modification du produit
                // $products->updateProduct($nameArticle, $image, $idCategory, $id_url);  
                $articles->updateArt($nameArticle, $image, $_SESSION['user']['id_utilisateurs'], $idCategory, $id_url);  
            
                // $url = '../../produit';
                // header("Refresh:0");
                header("Location: admin.php");


                $_SESSION['msg'] = "<p>Produit modifié.</p>"; 
            
        }
    }
?>
<main class="main-first">
    <h1 class="title-main">ADMINISTRATION</h1>
    <section>
        <h2>Modification Fiche Article</h2>
            <form method="post" enctype="multipart/form-data" action="">
            <fieldset>
                <label for="nameArticle">Nom de l'Article</label>
                <input type="text" id="product" name="nameArticle" placeholder="Nom de produit" value="<?= htmlspecialchars($resProduct['article'])?>">

                <label for="image">Photo</label>
                <img src="assets/images/articles/<?= htmlspecialchars($resProduct['images'])?>" alt="Nom du produit">
                <input type="file" id="image" name="image">
            </fieldset>

            <fieldset>
                <label for="idCategory">Categorie</label>
                <select name="idCategory">
                    <option value="<?= $resProduct['id'] ?>" hidden><?= htmlspecialchars($resProduct['nom']) ?></option>
                        <?php foreach ($resCats as $resCat) { ?>
                            <option value="<?= $resCat['id'] ?>"><?=  htmlspecialchars($resCat['nom']) ?></option>
                        <?php } ?>
                </select><br>
            </fieldset>

            <input type="submit" name="register" value="Enregistrer">
            <p><strong>Note:</strong> Seuls les formats .jpg, .jpeg, .png sont autorisés jusqu'à une taille maximale de 5 Mo.</p>
        </form>
    </section>
</main>
<?php 
include 'assets/include/footer.php'; 
?>