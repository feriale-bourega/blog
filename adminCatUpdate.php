<?php
$title = 'Administrateur';
include 'assets/include/header.php';

if(!empty($userinfos) && $userinfos["id_droits"] == 1 || $userinfos["id_droits"] == 42){
    header("Location: index.php");
}

$id_url = explode("?id=",$_GET['id']);
$id_url = end($id_url);
$categID = $articles->getCatId($id_url);

  if(isset($_POST['update']))
  {
      $login = htmlspecialchars($_POST['categorie']);
      $id_url = intval($id_url);
      // var_dump($id_url);

      if(!empty($login))
      {
          $updt = $articles->updateCat($login, $id_url);
          // var_dump($updt);
          header("Location: admin.php");
      }
  }
?>
<main class="main-first">
    <h1 class="title-main">ADMINISTRATION</h1>
    <section>
        <h2 class="main-first">Modification du nom de la Categorie</h2>
            <form class="form" action="" method="post"> 
                <label for="categorie">Categorie : <?php ?></label>
                    <input type="text" id="categorie" name="categorie" value="<?= htmlspecialchars($categID['nom'])?>">
                    <input type="submit" id="button" name="update" value="modifier">
            </form>
    </section>
</main>
<?php 
include 'assets/include/footer.php'; 
?>