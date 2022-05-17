<?php
$title = 'Administrateur';
include 'assets/include/header.php';

if(!empty($userinfos) && $userinfos["id_droits"] == 1 || $userinfos["id_droits"] == 42){
    header("Location: index.php");
}

$id_url = explode("?id=",$_GET['id']);
$id_url = end($id_url);
$resClient = $user->getUserAdminByID($id_url);
// var_dump($resClient);

$comUseId = $articles->commentUserID($id_url);
// var_dump($comUseId);

?>
<main class="main-first">
    <h1 class="title-main">ADMINISTRATION</h1>
    <section>
        <h2 class="main-first">Fiche Utilisateur</h2>
            <table id="customers">
                <thead> <!-- En-tête du tableau -->
                <?php 
                        $id_url = explode("?id= ",$_GET['id']);
                        $id_url = end($id_url);
                        $resClient = $user->getUserAdminByID($id_url);
                        // var_dump($resClient);
                    ?>
                    <tr>
                        <th>Login</th>
                        <th>Mail</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody> <!-- Corps du tableau -->
                    <tr> 
                        <td> <?= htmlspecialchars($resClient['login'])?> </td>
                        <td> <?= htmlspecialchars($resClient['email'])?> </td>
                        <td> <?= htmlspecialchars($resClient['nom'])?> </td>
                    </tr>
                </tbody>
            </table>
        </section>

        <section>
        <h2>Les commentaires de l'utilisateur</h2>
            <table id="customers">
                <thead> <!-- En-tête du tableau -->
                    <tr>
                        <th>N°</th>
                        <th>Date</th>
                        <th>Commentaire</th>
                        <th>Articles</th>
                        <th>Image</th>
                    </tr>
                </thead>
                <tbody> <!-- Corps du tableau -->
                <?php 
                    foreach ($comUseId as $key => $value) 
                    {
                        // var_dump($key);
                ?>
                    <tr> 
                        <td> <?=htmlspecialchars($key+1)?> </td>
                        <td> <?= date_format(date_create($value['date']), 'd/m/Y')?> </td>
                        <td> <?= $value['commentaire']; ?> </td>
                        <td> <?= $value['article']; ?> </td>
                        <td> <a href="article.php?id=<?= $value['id_article'] ?>"><img src="assets/images/articles/<?php echo $value['images'] ?>" alt="article"> </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </section>
</main>
<?php 
include 'assets/include/footer.php'; 
?>
