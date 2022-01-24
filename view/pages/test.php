<?php

// ----------------------------
// ESPACE ADMIN <<<<<<<<<<<<<<<
// ----------------------------

// Démarrage de la session

session_start();

// Connexion à la base de donnée

require '../common/config.php'; 

?>

<?php

// Récupération des données de tous les utilisateurs

$req = $db->prepare('SELECT * FROM droits');
$req->execute(array());
$rights = $req->fetchAll(PDO::FETCH_ASSOC);

$usr = $db->prepare('SELECT * FROM utilisateurs');
$usr->execute(array());
$data = $usr->fetch(PDO::FETCH_ASSOC);

?>

<!doctype html>
<html lang="fr">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Droit d'accès</title>
<link rel="stylesheet" href="../../public/css/style.css">
<link rel="icon" href="favicon.ico" />
</head>
<body>

<header>

<?php include ('../common/header.php'); ?>

</header>

<form action="" method="POST" enctype="multipart/form-data">

      <h2 class="login_text">Modifier le droit d'accès</h2>
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

        }

        ?>

        <footer>

<?php include ('../common/footer.php'); ?>

</footer>

                    </body>
                    </html>
