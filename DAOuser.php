<?php
$_SESSION['success']= NULL;
class DAOuser {
	
	private $host="localhost";
	private $user="root";
	private $password="";
	private $database="login";
    private $charset="utf8";
  
    private $errors = array(); 
	
	private $bdd;
	
	//stockage de l'erreur éventuelle du serveur mysql
	private $error;
	
	public function __construct() {
	
	}
	
	public function setDatabase($database) {
		$this->database=$database;
	}
	
/* méthode de connexion à la base de donnée */
public function connexion() {
    try
    {
        // On se connecte à MySQL
        $this->bdd = new PDO('mysql:host='.$this->host.';dbname='.$this->database.';charset='.$this->charset, $this->user, $this->password);
    }
    catch(Exception $e)
    {
        // En cas d'erreur, on affiche un message et on arrête tout
            $this->error=$e->getMessage();
    }
}

public function getResults($bdd) {
    
    $reponse = $this->bdd->query($bdd);
    $donnees = $reponse->fetchAll(PDO::FETCH_ASSOC);
    $reponse->closeCursor();
    return $donnees;
}


public function getLastError() {
    return $this->error;
}

public function getUsers($userName="") {
    $sql="SELECT * FROM `users`";
    if ($userName) {
        $sql.=" WHERE username='".$userName."'";
    }
    
    return $this->getResults($sql);
}

public function getEmails($email="") {
    $sql="SELECT * FROM `users`";
    if ($email) {
        $sql.=" WHERE email='".$email."'";
    }
    return $this->getResults($sql);
}

//Récupère les informations de la création d'un nouveau compte et les rentre dans la database:
public function newUser($username, $password1, $email) {
    if (count($this->errors) == 0) {
        $password = md5($password1);//encrypt the password before saving in the database
  
        $sql= "INSERT INTO users (username, passwords, email ) 
                  VALUES('$username', '$password', '$email')";
        if ($this->bdd->query($sql) == TRUE) {
            $_SESSION['success'] = "You created an account, now, log in!";
            header('location: index.php');
            die();
        } else {
            echo "oh well";
        }
        
    }


}
}

?>