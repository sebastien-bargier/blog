<?php

// ------------------------------------------
// TRAITEMENT AFFICHAGES DES ARTICLES <<<<<<<<<<<<<<<
// ------------------------------------------

session_start();

require '../common/config.php'; 

// DETERMINE SUR QUELLE PAGE ON SE TROUVE
if(isset($_GET['page']) && !empty($_GET['page'])){
    $pageCourante = (int) strip_tags($_GET['page']);
}else{
    $pageCourante = 1;
}


// COMPTE LE NOMBRE ARTICLE TOTAL EN BDD
$req = $db->prepare("SELECT COUNT(*) AS compteur FROM articles");
$req->execute();

// RECUPERE LE NOMBRE D'ARTICLE
$result = $req->fetch();
$nombreArticlesBDD = (int) $result['compteur'];

// NOMBRE TOTAL ARTICLES PAR PAGE
$articlesParPage = 5;

// CALCUL NOMBRE DE PAGE TOTAL
$nombreDePages = ceil($nombreArticlesBDD/$articlesParPage);

// SPECIFIER LA VALEUR DE DEPART
$premierArticle = ($pageCourante * $articlesParPage) - $articlesParPage;

// REQUETE RECUPERATION ARTICLES PAR ORDRE DU PLUS RECENTS AU PLUS ANCIENS (DESC)
$requete = $db->prepare("SELECT * FROM articles ORDER BY date DESC LIMIT $premierArticle, $articlesParPage;");
$requete ->execute();
$articles = $requete->fetchAll(PDO::FETCH_ASSOC);


// REQUETE FONCTIONNE A METTRE EN PRATIQUE
$requete = $db->prepare("SELECT * FROM `articles` INNER JOIN categories ON categories.id = articles.id_categorie WHERE articles.id_categorie = 1 ORDER BY date DESC;");
$requete ->execute();
$categoriesArticles = $requete->fetchAll(PDO::FETCH_ASSOC);

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

        <h1>Articles</h1>
        
        <section>

        <?php foreach($articles as $article) : ?>

            <article>

                <p><?= $article['article'] ?></p>

            </article>

        <?php endforeach; ?>

        </section>

        <div class="pagination">

        <?php for($page = 1; $page <= $nombreDePages; $page++) : ?>

            <li>
                <a href="articles.php?page=<?= $page ?>"><?= $page ?></a>
            </li>

        <?php endfor; ?>

        </div>

    </main>

    <footer>
        <?php require '../common/footer.php'; ?>
    </footer>
    
</body>
</html>