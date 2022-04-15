<?php
// Création d'une session une fois les données récupérées//
// $select = mysqli_query($conn, "SELECT * FROM utilisateurs WHERE Login = '$login'");
// $resultat = mysqli_fetch_all($select, MYSQLI_ASSOC);


class User {
    private $id;
    public $login;
    public $password;
    public $email;
    public $id_droits;
    public $conn;
    public $prenom;
    public $nom;
    public $password2;
    public $password3;

    public function  __construct(){
        try{
        $conn = new PDO('mysql:host=localhost;dbname=blog', 'root', '');
        $this->conn = $conn;
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception) {
           echo 'ERREUR :'.$exception->getMessage();
        }
    }


    public function register($login, $password,  $password2, $email, $id_droits = 1){
        $this->login = $login;
        $this->password = $password;
        $this->password = $password2;
        $this->email = $email;
        $this->id_droits = (int)$id_droits;

        if(!empty($_POST['login']) && !empty($_POST['password']) && !empty($_POST['password2']) && !empty($_POST['email'])){
            $login = $_POST['login'];
            $password=password_hash($_POST['password'],PASSWORD_DEFAULT);
            $password2= $_POST['password2'];
            $email = $_POST['email'];


          var_dump($email);
          var_dump($password);

       $requete = $this->conn->prepare("INSERT INTO `utilisateurs` (`login`,`email`, `id_droits`, `password`) VALUES (:login,:email, :id_droits, :password);");
	   $requete->bindvalue(':login', $login);
       $requete->bindvalue(':email', $email);
       $requete->bindvalue(':id_droits', $id_droits);
       $requete->bindvalue(':password', $password);

    //    $requete->execute();
	   $test = $requete->execute(
           array(
               ":login" => $login,
               ":email" => $email,
               ":id_droits" => $id_droits,
               ":password" => $password,
           )
       );
       
    }
    }
  //$valid = true;
    // }

    public function connect($login, $password){
        $this->login = $login;
        $this->password = $password;
        if(!empty($_POST['login']) && !empty($_POST['password'])){
            $login = $_POST['login'];
            $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
            var_dump($login);
            var_dump($password);
            $requete = $this->conn->prepare("SELECT login, password FROM utilisateurs WHERE login = :login AND password = :password;");
            $requete->bindvalue(':login', $login);
            $requete->bindvalue(':password' , $password);
           // $requete->execute();
            $test = $requete->execute(
                array(
                    ":login" => $login,
                    ":password" => $password,
                   )
            );
        } 
    }    
    
    public function disconnect(){

    }

    public function delete() {

    }

    public function update($login, $prenom, $nom, $password, $password3){
        $this->login = $login;
        $this->prenom = $prenom;
        $this->nom = $nom;
        $this->password = $password;
        $this->password3 = $password3;
        
        if(!empty($login) && !empty($prenom) && !empty($nom) && !empty($password) && !empty($password3)){
            
            $login = $_POST['login'];
            $prenom = $_POST['prenom'];
            $nom = $_POST['nom'];
            $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
            $password3 = $_POST['password3'];
            
            $requete = $this->conn->prepare("UPDATE `utilisateurs` SET login =:login, password=:password WHERE login = '$login' AND password = '$password';");
            $requete->bindvalue(':login', $login);
           // $requete->bindvalue(':prenom', $prenom);
           // $requete->bindvalue(':nom', $nom);
            $requete->bindvalue(':password', $password);
           // $requete->bindvalue(':password3', $password3);
            
            
         //    $requete->execute();
            $requete->execute(
                array(
                    ":login" => $login,
                    ":password" => $password,
                   // ":password3" => $password3,
                    
                    
                )
            );
           // $fetch= $requete->fetchAll(PDO::FETCH_ASSOC);
            //var_dump($fetch);
         
    }
        }    
   // public function isConnected(){

   // }

    public function getAllInfos($login, $prenom, $nom, $password, $password3){
       $this->login = $login;
       $this->prenom = $prenom;
       $this->nom = $nom;
       $this->password = $password;
       $this->password3 = $password3;
       if( isset($_POST['login']) && !empty($_POST['login']) && isset($_POST['prenom']) && !empty($_POST['prenom'])  
        && isset($_POST['nom']) && !empty($_POST['nom']) && isset($_POST['password']) && !empty($_POST['password']) && isset($_POST['password3']) && !empty($_POST['password3'])){
            $login = $_POST['login'];
            $prenom = $_POST['prenom'];
            $nom = $_POST['nom'];
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT, array('cost' =>10 ));
            $password3 = $_POST['password3'];
            var_dump($login);
            var_dump($password);
            $requete = $this->conn->prepare("SELECT * FROM `utilisateurs` WHERE login=:login AND password=:password ;");
            $requete->bindparam(':login', $_POST['login']);
           // $requete->bindparam(':prenom' , $_POST['prenom']);
            //$requete->bindparam(':nom' , $_POST['nom']);
            $requete-> bindparam(':password' , $_POST['password']);
           // $requete->bindparam(':password3' , $_POST['password3']);
         //    $requete->execute();
            $requete->execute(
                array(
                    ":login" => $_POST['login'],
                   // ":prenom" => $_POST['prenom'],
                   // ":nom" => $_POST['nom'],
                    ":password" => $_POST['password'],
                   // ":password3" => $_POST['password3'],
                    )
            );
        
          }
        }   
            /* Retourne le nombre de lignes affectés */
//print("Retourne le nombre de lignes affectés :\n");
//$count = $requete->rowCount();
//print("Affectation de $count lignes.\n");
            //$fetch= $requete->fetchAll(PDO::FETCH_ASSOC);
            //var_dump($fetch);
            //if ($fetch){
              //  $passwordHash = $fetch['password'];
                //if(password_verify($password,$passwordHash)){
                  //  echo "Connexion réussie!";
                //}
                //else {
                  //  echo "Echec connexion";
                //}  }
                  // else {
                    //echo "Echec connexion";
                
        

        


    
    public function getLogin(){

    }

    public function getEmail(){

    }

    public function getPassword(){

    }

    public function getId_droits(){

    }

}
?>
