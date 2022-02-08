<?php

// ------------------------------------------
// ESPACE ADMINISTRATION <<<<<<<<<<<<<<<<<<<<
// ------------------------------------------

// Démarrage de la session

session_start();

// Connexion à la base de donnée

require 'config.php'; 

// Checker si l'utilisateur est déjà connecté ou pas

if (!isset($_SESSION['id'])) {

    // On redirige vers l'accueil

    header('Location:accueil.php');

}

$id = $_GET['id'];

var_dump($id);

$db ->prepare("DELETE FROM `utilisateurs` WHERE `id` = ?");
$db->execute(array($id));

// $req = $db->exec("DELETE FROM `utilisateurs` WHERE `id` = $id");
  


?>

