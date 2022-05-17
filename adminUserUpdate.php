<?php
$title = 'Administrateur'; 
include 'assets/include/header.php';

if(!empty($userinfos) && $userinfos["id_droits"] == 1 || $userinfos["id_droits"] == 42){
    header("Location: index.php");
}

$id_url = explode("?id= ",$_GET['id']);
$id_url = end($id_url);
$resClients = $user->getUserAdminByID($id_url);
$listDroits = $droits->wrightList();
  // var_dump($resClients['id_droits']);
//   var_dump($resClients);
//   var_dump($listDroits);
  // var_dump($id_url);

  if(isset($_POST['update']))
  {
      $login = htmlspecialchars($_POST['login']);
      $droit = htmlspecialchars($_POST['droit']);
      $email = htmlspecialchars($_POST['email']);
      $id_url = intval($id_url);
      // var_dump($id_url);

      if(!empty($login) && !empty($droit) && !empty($email))
      {
          $updt = $user->updateUser($login, $email, $droit, $id_url);
          // var_dump($updt);
          header("Refresh:0");
      }
  }
?>
<main class="main-first">
    <h1 class="title-main">ADMINISTRATION</h1>
    <section>
        <h2 class="main-first">Modification Fiche Client</h2>
            <form class="form" action="" method="post"> 
                <label for="login">Prenom : <?php ?></label>
                    <input type="text" id="login" name="login" value="<?= htmlspecialchars($resClients['login'])?>">
            
                <label for="email">Mail</label>
                    <input type="email" id="email" name="email" value="<?= htmlspecialchars($resClients['email'])?>">

                <label for="droit">Statut</label>
                    <select name="droit" id="">
                        <option value="<?= $resClients['id_droits'] ?>" hidden><?= $resClients['nom'] ?></option>
                        <?php foreach ($listDroits as $listDroit) { ?>
                            <option value="<?= $listDroit['id'] ?>"><?= $listDroit['nom'] ?></option>
                        <?php } ?>
                    </select>
                    <input type="submit" id="button" name="update" value="modifier">
            </form>
    </section>
    </main>
<?php 
include 'assets/include/footer.php'; 
?>