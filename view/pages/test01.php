<?php

// ------------------------------------------
// TRAITEMENT AFFICHAGES DES ARTICLES <<<<<<<<<<<<<<<
// ------------------------------------------

session_start();

require '../common/config.php';

$requete = $db->prepare("SELECT * FROM categories");
$requete->execute();
$categories = $requete->fetchAll(PDO::FETCH_ASSOC);

?>

<!doctype html>
<html lang="fr">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Les articles</title>
<link rel="stylesheet" href="../../public/css/style.css">
<link rel="icon" href="favicon.ico" />
</head>
<body>

    <!--Import du header -->

    <header>

    <?php include ('../common/header.php'); ?>
 
    </header>

    <main>
        <form action="" method="GET">

            <select name="categories">

                <?php foreach($categories as $cat): ?>

                <option value="<?= $cat['id'] ?>"><?= $cat['nom'] ?></option>

                <?php endforeach; ?>

                <input type="submit" class="btn" name="formsend" id="formsend" value="OK">

            </select>
        </form>
    </main>

    <footer>
        <?php require '../common/footer.php'; ?>
    </footer>
    
</body>
</html>