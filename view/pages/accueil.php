<?php session_start(); ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../public/css/style.css" />
    <title>Accueil</title>
</head>
<body>
    <header>
        <?php require '../common/header.php'; ?>
    </header>

    <main>
        <h1>Page Accueil<h1>

        <?php
        require '../common/config.php';
        $req = $db->prepare("SELECT * FROM articles ORDER BY date DESC LIMIT 3;");
        $req->execute();
        $articles = $req->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <?php foreach($articles as $article) { ?>
            <div class="articles">
                <p><?= $article['article'] ?></p>
            </div>
        <?php } ?>

    </main>

    <footer>
        <?php require '../common/footer.php'; ?>
    </footer>
</body>
</html>