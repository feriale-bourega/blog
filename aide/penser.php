/// Les champs des tables sont les propriétés de la class donc de la table ///
EXEMBLE AVEC LA CLASSE user-pdo.php
Table UTILISATEURS
    (id, login, password, email, firstname, lastname)

    Paramètres
        private $id;
        public $login;
        public $email;
        public $firstname;
        public $lastname;
        public $bdd;

? : comment choisir les propriétés ? leurs récurrences ?
? : comment mettre la clé étrangère dans la class ? sachant donc qu’elle
     appartient donc à une autre class ?
        
    Méthodes
        public function __construct(){} => obligatoire
        public function register(){} => => créer le user dans la bdd 
        public function connect(){} => => Connecter le user
        public function disconnect(){} => Déconnecter le user
        public function delete(){} => Supprimer 
        public function update(){} => Mise à jour bdd
        public function isConnected(){} => 
        public function getAllInfos(){} => Récupérer tous les infos
        public function getLogin(){} => Récupérer que login
        public function getEmail(){} => Récupérer que Email
        public function getFirstname(){} => Récupérer que getFirstname


class_articles.php
    Paramètres
    Méthodes



    untracked files meaning git
https://koukia.ca/how-to-remove-local-untracked-files-from-the-current-git-branch-571c6ce9b6b1
https://www.google.com/search?q=keep+untracked+files&client=firefox-b-d&sxsrf=AOaemvJaIGAy3t7UVDgbpSDFHwY5IIuXQA%3A1643219773283&ei=PYvxYafmEMCNjLsP-v6AgAM&ved=0ahUKEwjn-P7W_s_1AhXABmMBHXo_ADAQ4dUDCA0&uact=5&oq=keep+untracked+files&gs_lcp=Cgdnd3Mtd2l6EAMyBggAEAcQHjIGCAAQBxAeMgYIABAHEB4yBggAEAcQHjIGCAAQBxAeMgYIABAHEB4yBggAEAcQHjIGCAAQBxAeOgcIIxCwAxAnOgcIABBHELADSgQIQRgASgQIRhgAUIEXWJIbYLonaAFwAngAgAFHiAGGAZIBATKYAQCgAQHIAQnAAQE&sclient=gws-wiz
https://git-scm.com/docs/git-stash/fr
