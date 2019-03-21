<?php
session_start();
require_once("DAOuser.php");
$_SESSION['Error_Message']= NULL; //initialisation du message d'erreur comme vide pour ne pas qu'il s'affiche en permanence

$daoUser=new DAOuser();
$daoUser->connexion();

  // receive all input values from the form
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password1 = $_POST['password1'];
  $password2 = $_POST['password2'];
  
 
  $newUser=$daoUser->getUsers($username); // Va chercher une potentielle correspondance du login dans la database
  $newEmail=$daoUser->getEmails($email); //Idem pour le mail
  
if (!preg_match("#^[a-zA-Z0-9_-]{2,30}$#",$_POST['username'])) { // Expression régulière qui vérifie que le login créé correspond aux normes demandées 
    $_SESSION['Error_Message'] = "Please use letters, numbers, dash or underscore"; // Si ce n'est pas le cas, affiche un message d'erreur
    header('location:newuser.php'); // renvoi au formulaire de création de compte
    exit();
  }



if(!preg_match("#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@_$%\^&\*])(?=.{8,})#",$_POST['password1'])) { //Expression régulière qui vérifie que le mot de passe créé correspond aux normes demandées 
  $_SESSION['Error_Message'] =  "You need to have at least 1 uppercase, 1 lowercase, 1 special character !@_$%\^&\*, one number and be at least 8 characters"; // Sinon erreur
  header('location:newuser.php'); //retour au formulaire
  exit();
  }



if(!preg_match("#^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-zA-Z]{2,4}$#",$_POST['email'])){ //Expression régulière qui vérifie que le mail créé correspond aux normes demandées
  $_SESSION['Error_Message'] = "You need a valid email address";
  header('location:newuser.php');
  exit();
  }


if($_POST['password1']!=$_POST['password2']) { //Vérifie que les 2 mots de passe saisis sont similaires
  $_SESSION['Error_Message'] = "Your passwords don't match.";
  header('location:newuser.php');
  exit();
}

if ($newUser[0]['username'] && $newEmail[0]['email'] ) { //Si on trouve une concordance dans la database au niveau du login, du mail, ou des deux
if ($username == $newUser[0]['username']) //Si doublon du login
{
  $_SESSION['Error_Message'] = "Username already exists"; //message d'erreur
  header('location:newuser.php');
  exit();
}

if ($email == $newEmail[0]['email']) { //Si doublon du mail
  $_SESSION['Error_Message'] = "email already exists"; // message d'erreur
  header('location:newuser.php');
  exit();
}
}

$daoUser->newUser($username, $password1, $email); //Si tout va bien, on rentre le nouvel utilisateur dans la database
header("index.php"); // Redirection vers la page de connexion


?>