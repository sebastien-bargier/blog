<?php

// ----------------------------
// ESPACE ADMIN <<<<<<<<<<<<<<<
// ----------------------------

// Démarrage de la session

session_start();

// Connexion à la base de donnée

require '../common/config.php'; 

if (!isset($_SESSION['id'])) {

    // On redirige vers l'accueil

    header('Location:accueil.php');

}

if ($_SESSION['id_droits'] == 1 OR $_SESSION['id_droits'] == 42) {

    // On redirige vers l'accueil

    header('Location:accueil.php');

}

?>

<?php

// Récupération des données de tous les utilisateurs

$req = $db->prepare('SELECT * FROM droits');
$req->execute(array());
$rights = $req->fetchAll(PDO::FETCH_ASSOC);

$usr = $db->prepare('SELECT * FROM utilisateurs');
$usr->execute(array());
$data = $usr->fetch(PDO::FETCH_ASSOC);
$row = $usr->rowCount();



?>

<!--Création du formulaire de connexion-->

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.9.0/css/all.css" integrity="sha384-i1LQnF23gykqWXg6jxC2ZbCbUMxyw5gLZY6UiUS98LYV5unm8GWmfkIS6jqJfb4E" crossorigin="anonymous">
    <title>Innovatech - Droits utilisateurs</title>
    <link rel="stylesheet" href="../../public/css/styles.css">
</head>
<body>
    
    <!-- HEADER -->

    <header class="header">
 
    <?php include ('../common/header.php'); ?>

    </header>

    <!-- MAIN -->

    <main class="main2">

    <div class="center">

    <form action="" method="POST" enctype="multipart/form-data">

      <h2 class="login_text">Modifier un droit d'accès</h2>
      <div class="">
        <input type="text" class="select" name="login" id="login" placeholder="Nom d'utilisateur" required="required" autocomplete="off">
      </div>

            <div class="select">

                <select name="droit_acces">
                    <?php foreach($rights as $droit) :?>
                    <option value="<?= $droit['id'] ?>"><?= $droit['nom']?></option>
                    <?php endforeach; ?>
                </select>
            </div>



            <div class="form_container">
                <input type="submit" class="btn" name="formsend" value="Valider">
            </div>

        </form>

        <?php

        if(isset($_POST['login'])) {

            $update = $db->prepare("UPDATE utilisateurs SET id_droits = :id_droits WHERE login = :login");
            $update->execute(array(':id_droits' => $_POST['droit_acces'], ':login' => $_POST['login']));

            echo "<p class=success_php>Droit d'accès modifié avec succès.<p><br><br>";

        }
        
        ?>

</div>

    </main>

    <footer>

<?php include ('../common/footer.php'); ?>

</footer>

</body>
</html>
    