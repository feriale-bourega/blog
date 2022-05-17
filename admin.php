<?php
$title = 'Administrateur';
include 'assets/include/header.php';

if(!empty($userinfos) && $userinfos["id_droits"] == 1 || $userinfos["id_droits"] == 42){
    header("Location: index.php");
}

$art = $articles->infArt();
// var_dump($art);

?>
<main class="main-first">
    <h1 class="title-main">ADMINISTRATION</h1>
        <section>
            <h2 class="main-first">Liste des clients</h2>
                <table id="customers">
                    <thead> <!-- En-tête du tableau -->
                        <tr>
                            <th>N°</th>
                            <th>Login</th>
                            <th>Mail</th>
                            <th>Droit</th>
                            <th>Fiche</th>
                            <th>Modifier</th>
                            <th>Supprimer</th>
                        </tr>
                    </thead>
                    <tbody> <!-- Corps du tableau -->
                        <?php 
                        foreach ($res as $key => $value) {
                            // var_dump($value);
                            ?>
                        <tr>
                            <td> <?= htmlspecialchars($key+1)?> </td>
                            <td> <?= htmlspecialchars($value['login'])?> </td>
                            <td> <?= htmlspecialchars($value['email'])?> </td>
                            <td> <?= htmlspecialchars($value['nom'])?> </td>
                                <?php $idClient = $value['id_utilisateurs']?>  
                            <td><a href="adminUserRead.php?id=<?= $idClient ?>"><img class="icones" src="assets/images/crud/read.svg" alt="Fiche"><a></td>

                            <td><a href="adminUserUpdate.php?id=<?= $idClient ?>"><img class="icones"src="assets/images/crud/update.svg" alt="Modifier"><a></td>
                            
                            <td><a href="adminUserDelete.php?id=<?= $idClient ?>"><img  class="icones" src="assets/images/crud/delete.svg" alt="Supprimer"><a></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
        </section>

        <section>
            <h2>Liste des catégories</h2>
                <h3><a href="creer-categorie.php"><img  class="icones" src="assets/images/crud/add.svg" alt="Ajouter une nouvelle catégorie">Ajouter une nouvelle catégorie<a></h3>

                <table id="customers">
                    <thead> <!-- En-tête du tableau -->
                        <tr>
                            <th>N°</th>
                            <th>Nom</th>
                            <th>Modifier</th>
                            <th>Supprimer</th>
                        </tr>
                    </thead>
                    <tbody> <!-- Corps du tableau -->
                        <?php 
                        foreach ($list as $key => $value) {
                            // var_dump($list);
                            // var_dump($key);
                            // var_dump($value);
                            ?>
                        <tr>
                            <td> <?= htmlspecialchars($key+1)?> </td>
                            <td> <?= htmlspecialchars($value['nom'])?> </td>
                                <?php $idCat = $value['id'];
                                    // var_dump($idCat);
                                ?>  
                            <td><a href="adminCatUpdate.php?id=<?= $idCat ?>"><img class="icones" src="assets/images/crud/update.svg" alt="Modifier"><a></td>
                            
                            <td><a href="adminCatDelete.php?id=<?= $idCat ?>"><img  class="icones" src="assets/images/crud/delete.svg" alt="Supprimer"><a></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
        </section>

        <section>
            <h2>Liste des articles</h2>
                <h3><a href="creer-article.php"><img  class="icones"  class="icones" src="assets/images/crud/add.svg" alt="Ajouter une nouvelle catégorie">Ajouter un nouveau article<a></h3>

                <table id="customers">
                    <thead> <!-- En-tête du tableau -->
                        <tr>
                            <th>N°</th>
                            <th>Nom</th>
                            <th>Image</th>
                            <!-- <th>Catégorie</th> -->
                            <th>Date</th>
                            <th>Modifier</th>
                            <th>Supprimer</th>
                        </tr>
                    </thead>
                    <tbody> <!-- Corps du tableau -->
                        <?php 
                        foreach ($art as $key => $value) {
                            // var_dump($list);
                            // var_dump($key);
                            // var_dump($value);
                            ?>
                        <tr>
                            <!-- <td> <?= htmlspecialchars($key+1)?> </td> -->
                            <td> <?= htmlspecialchars($value['id'])?> </td>
                            <td> <?= htmlspecialchars($value['article'])?> </td>
                            <td> <a href="article.php?id=<?= $value['id'] ?>"><img class="icones" src="assets/images/articles/<?php echo $value['images'] ?>" alt="article"> </td>
                            <!-- <td> <?= htmlspecialchars($value['nom'])?> </td> -->
                            <td> <?= date_format(date_create($value['date']), 'd/m/Y') ?> </td>
                                <?php $idArt = $value['id'];
                                    // var_dump($idCat);
                                ?>  
                            <td><a href="adminArtUpdate.php?id=<?= $idArt ?>"><img class="icones" src="assets/images/crud/update.svg" alt="Modifier"><a></td>
                            
                            <td><a href="adminArtDelete.php?id=<?= $idArt ?>"><img src="assets/images/crud/delete.svg" alt="Supprimer"><a></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
        </section>
</main>
<?php 
include 'assets/include/footer.php'; 
?>