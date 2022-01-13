<?php
session_start();
// DETERMINE SUR QUELLE PAGE ON SE TROUVE
if(isset($_GET['page']) && !empty($_GET['page'])){
    $pageCourante = (int) strip_tags($_GET['page']);
}else{
    $pageCourante = 1;
}

// CONNEXION BDD
$db = new PDO('mysql:host=localhost;dbname=blog','root', '');

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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../public/css/style.css" />
    <title>Les articles</title>
</head>
<body>

<header>
    <?php require '../common/header.php'; ?>
</header>

<main>
    <h1>Articles</h1>
    <?php foreach($articles as $article) { ?>
        <div class="articles">
            <p><?= $article['article'] ?></p>
        </div>
    <?php } ?>

    <div class="pagination">
        <?php for($page = 1; $page <= $nombreDePages; $page++) : ?>
            <li>
                <a href="articles.php?page=<?= $page ?>"><?= $page ?></a>
            </li>
        <?php endfor ?>
    </div>
</main>
    
</body>
</html>