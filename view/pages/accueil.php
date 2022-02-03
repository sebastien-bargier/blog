<?php

// ----------------------------
// PAGE ACCUEIL <<<<<<<<<<<<<<<
// ----------------------------

session_start();

require '../common/config.php';

// Récupere les données de l'article dans la base de données

$req = $db->prepare("SELECT * FROM categories INNER JOIN articles ON articles.id_categorie = categories.id  ORDER BY date DESC LIMIT 3;");
$req->execute();
$articles = $req->fetchAll(PDO::FETCH_ASSOC);

?>

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

        <section class="les_articles">

            <?php foreach($articles as $article) : ?>

            <article>

                <a href="../pages/article.php?id=<?= $article['id'] ?>">

                <p>Categorie - <?= $article['nom'] ?></p>

                <h3><?= $article['titre'] ?></h3>

                <img src="../../public/images/<?=$article['image'] ?>" alt="<?= $article['nom_image'] ?>">

                <p><?= $article['article'] ?></p>

                </a>

            </article>

            <?php endforeach; ?>

        </section>

    </main>

    <footer>
        <?php require '../common/footer.php'; ?>
    </footer>
</body>
</html>