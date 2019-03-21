<?php 

if (!isset($_SESSION["connected_user"])) header("location:index.php");?>

<h1>Menu</h1>
<a href="">Articles</a>
<a href="emplPHP.php">Gestion des utilisateurs</a>

<a href="index.php">Deconnexion</a>