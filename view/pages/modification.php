<?php

// ------------------------------------------
// TRAITEMENT DE LA CONNEXION <<<<<<<<<<<<<<<
// ------------------------------------------

// Démarrage de la session

session_start();

// Connexion à la base de donnée

require '../common/config.php'; 

// Checker si l'utilisateur est déjà connecté ou pas

if (isset($_SESSION['id'])) {

    // On redirige vers l'accueil

    header('Location:accueil.php');

}

?>

<!--Création du formulaire de connexion-->

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.9.0/css/all.css" integrity="sha384-i1LQnF23gykqWXg6jxC2ZbCbUMxyw5gLZY6UiUS98LYV5unm8GWmfkIS6jqJfb4E" crossorigin="anonymous">
    <title>Innovatech - Modification réussie</title>
    <link rel="stylesheet" href="../../public/css/styles.css">
</head>
<body>
    
    <!-- HEADER -->

    <header class="header">
 
    <?php include ('../common/header.php'); ?>

    </header>

    <!-- MAIN -->

    <main class="main">

        <div class="text">

        <h2 class="title">Modification réussie !</h2>
        <h3>Vos données ont bien été modifiées.</h3>
        <p>Vous souhaitez faire d'autres modifications ?</p>
        <a href="profil.php">Retour au profil</a>

        </div>

    </main>

</body>
</html>
    