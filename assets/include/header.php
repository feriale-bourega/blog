<?php
session_start();
$title;
require 'class/User.php';   // $user = new User(); <== mis en instance en dehors de la classe User.php
require 'class/Article.php';  // $articles = new Article(); <== mis en instance en dehors de la classe Article.php
require 'class/Droits.php';  // $articles = new Article(); <== mis en instance en dehors de la classe Article.php


$list = $articles->display_List_Categ_Article(); 
// var_dump($list);

$res = $user->getUserAdmin();
// var_dump($res);

if (isset($_SESSION['user'])) {
    $userinfos = $user->getAllInfos($_SESSION['user']['id_utilisateurs']);
    // $_SESSION = $userinfos;
}

// $userinfos = $user->getAllInfos();
// var_dump($userinfos);

// var_dump($_SESSION['login']);
// var_dump($_SESSION);
// var_dump($_SESSION['user']);
// var_dump($_SESSION['user']['id_utilisateurs']);

?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <script src="assets/include/script.js"></script>
    <link rel="stylesheet" href="assets/styles/styles.css">

</head>

<body>
    <header>
        <a href="index.php" class="logo">
            <div class="logo-container">

            </div>
        </a>


        <?php
        if (empty($_SESSION)) {
        ?>
            <ul>
                <li><a href="articles.php">Articles</a></li>
                <li><a href="connexion.php">Connexion</a></li>
                <li><a href="inscription.php">Inscription</a></li>
                <li>
                    <select name="" id="list-deroulant">
                        <option value="" hidden>Catégories</option>
                        <?php foreach ($list as $key) {
                            // var_dump($list);
                            // echo $key;
                        ?>
                            <a href="categorie.php?categorie=">
                                <option value="<?php echo  $key['id']; ?>"><?php echo $key['nom']; ?></option>
                            </a>
                        <?php }
                        ?>
                    </select>
                </li>
            </ul>
        <?php }
        // accès admin
        elseif (!empty($userinfos) && $userinfos["id_droits"] == "1337") {
        ?>
            <ul>
                <li><a href="articles.php">Les articles</a></li>
                <li><a href="profil.php">Profil</a></li>
                <li><a href="creer-article.php">Création d'Article</a></li>
                <li><a href="admin.php">Administration</a></li>
                <li><a href="deconnexion.php">Déconnexion</a></li>
                <li>
                    <select name="" id="list-deroulant">
                        <option value="" hidden>Catégories</option>
                        <?php foreach ($list as $key) {
                            // var_dump($list);
                            //    echo $key;
                        ?>
                            <a href="categorie.php?categorie=">
                                <option value="<?php echo  $key['id']; ?>"><?php echo $key['nom']; ?></option>
                            </a>
                        <?php }
                        ?>
                    </select>
                </li>
            </ul>
        <?php }
        //accès modérateur
        elseif (!empty($userinfos) && $userinfos["id_droits"] == "42") {
        ?>
            <ul>
                <li><a href="articles.php">Les articles</a></li>
                <li><a href="profil.php">Profil</a></li>
                <li><a href="creer-article.php">Création d'Article</a></li>
                <li><a href="deconnexion.php">Déconnexion</a></li>
                <li>
                    <select name="" id="list-deroulant">
                        <option value="" hidden>Catégories</option>
                        <?php foreach ($list as $key) {
                            // var_dump($list);
                            //    echo $key;
                        ?>
                            <a href="categorie.php?categorie=">
                                <option value="<?php echo  $key['id']; ?>"><?php echo $key['nom']; ?></option>
                            </a>
                        <?php }
                        ?>
                    </select>
                </li>
            </ul>
        <?php }
        // accès utilisateur
        else {
        ?>
            <ul>
                <li><a href="articles.php">Les articles</a></li>
                <li><a href="profil.php">Profil</a></li>
                <li><a href="deconnexion.php">Déconnexion</a></li>
                <li>
                    <select name="" id="list-deroulant">
                        <option value="" hidden>Catégories</option>
                        <?php foreach ($list as $key) {   // var_dump($list);
                            //    echo $key;
                        ?>
                            <a href="categorie.php?categorie=">
                                <option value="<?php echo  $key['id']; ?>"><?php echo $key['nom']; ?></option>
                            </a>
                        <?php
                        }
                        ?>
                    </select>
                </li>
            </ul>
        <?php
        }
        ?>
    </header>