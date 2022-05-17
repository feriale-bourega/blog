<?php
$title = 'Accueil';
include 'assets/include/header.php';
ob_start();


// $getIdLast = htmlspecialchars($_GET['id']);
// $getIdLast = (int)($_GET['id']);


$last = $articles->last_articles();
// var_dump($last);


?>
<main class="main-first">
    <section class="section-first">
        <h1 class="title-main">Liste des 3 derniers articles</h1>
        <div class="container-art">
            <div class="libelle">
                <?php foreach ($last as $article) { ?>
                    <a href="article.php?id=<?= $article['id'] ?>">
                    <?= date_format(date_create($article['date']), 'd/m/Y H:i:s') ?> <br>
                    <?= $article['article'] ?> <br>
                    <img class="responsive"  src="assets/images/articles/<?php echo $article['images'] ?>" alt="">
                <?php } ?>
                    </a>
            </div>
        </div>
        <p class="title-main">
            <a href="articles.php">Cliquez ici, pour découvrir les autres articles.</a>
        </p>
    </section>
</main>
<?php
include 'assets/include/footer.php';
?>