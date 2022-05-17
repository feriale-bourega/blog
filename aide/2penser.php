class_droits.php => Table DROITS(!Id, login)
                        id   => nom
                        1    => utilisateur
                        42   => modérateur
                        1337 => administrateur
                         
                         
    PARAMETRES
        private $id;
        public $login;
    METHODE
        public function droits()
        {
            //Est-ce-un switch case ???
            Si user connecté et modérateur
                alors 
            si le user est un modérateur 
                alors accède à la page article (afficher page article :page creer-article)
                    et si (elseif) le user est un administrateur : 
                        accède à la page admin (admin.php)

            if($id_droits == 42){
                echo 'creer-article.php';

            }

    <?php 
            //Vérification de la connexion
            if(isset($_SESSION['user']['login'])){  ?>
                <!-- //si connecté  -->
                <li><a href="deconnexion.php">DÉCONNEXION</a></li>
                <li><a href="profil.php">PROFIL</a></li>
                <li><a href="commentaire.php">COMMENTAIRE</a></li>
        <?php }
                elseif($id_droits == 42){

                }
                else { ?>
                <!-- //Non connecté -->
                <li><a href="inscription.php">INSCRIPTION</a></li>
                <li><a href="connexion.php">CONNEXION</a></li>
        <?php } ?>
                
        }

class_user.php => 
Table UTLISATEURS
(!Id, login, password, email, #id_droits)
###class_commentaires.php => Table COMMENTAIRES(!Id, commentaire, #Id_utilisateur, #Id_article, date)
#class_articles.php => Table ARTICLES(!Id, articles, #Id_utilisateur, #Id_categorie, date)
    PARAMETRES
        private $id;
        public $articles;
        public $id_utilisateur; 
        public$id_categorie;
        public $date;
    METHODE
    OK MANQUE LA FORME =>afficher liste déroulante catégorie d'articles (INNER JOIN de id-categorie)
            dans le header.php
    OK MANQUE LA FORME =>afficher les 3 derniers articles 
            dans page index.php
        =>En bas de la page, il doit y avoir un lien vers la page articles.
        =>afficher tous les articles dans une page avec PAGINATION : AVEC GET
          du récent au plus ancien
          que les 5 premiers articles
          pagination pour les pages suivantes contenant toujours 5 pages : AVEC GET
            VOIR EX PAGE
            dans ???
        =>créer des articles (ue pour Mod et adm)
            dans creer-article.php
            un formulaire contenant
                texte de l'article
                liste déroulante contenant les catégories existantes en base de données 
                un bouton submit.
        =>afficher et ajouter UN article AVEC SES commentaires => Argument GET
            voir un article
            voir tous les commentaires de cet article en question
            pouvoir ajouter d'autres com ????
        
            DANS LA PAGE ADMINISTRATION
        =>modifier des articles par l'admin
        =>supprimer des articles par l'admin
        =>créer + modifier + supprimer des catégories
        =>créer + modifier + supprimer des utilisateurs
        =>créer + modifier + supprimer des droits

##class_categorie.php => Table CATEGORIE(!Id, Nom)


CE SERAIT TROP COOL :
    Faire direct sur sql les formats des dates

KESAKO
    Fonction systèmes