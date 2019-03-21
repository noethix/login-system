<?php
require_once("DAOuser.php");

$daoUser=new DAOuser();
$daoUser->connexion(); //connexion à la database
$users=$daoUser->getUsers($_POST["login"]); //Va récupérer dans la database les informations correspondant au login
if (count($users)) { //Si on trouve la correspondance dans la database
	if (md5($_POST["password"])==$users[0]["passwords"]) { //Si le mot de passe saisi correspond au mot de passe (crypté) dans la database
		
		$_SESSION["connected_user"]=$_POST["login"]; //On connecte la personne
		
		if ($_SESSION["connected_user"]=="admin") { //Si la personne se connecte en tant qu'administrateur
			require_once("menu_admin.php"); //On la dirige vers le compte administrateur
		} else {
			require_once("menu_user.php");//Sinon on la dirige vers le compte utilisateur classique
		}
	} else {
		$_SESSION['Error_Message'] =  "Something's wrong";//Si le mot de passe ne correspond pas, erreur.
        header('location:index.php'); //Redirection vers la page de connexion.
		exit(); //On sort du procédé de vérification
	}	
}
 else {
	$_SESSION['Error_Message'] = "cet identifiant n'existe pas"; //Si on ne trouve pas le login dans la database, erreur.
	header('location:index.php'); //Redirection vers la page de connexion.
	exit(); //On sort du procédé de vérification
}


?>




