<?php
session_start();
// DETERMINE SUR QUELLE PAGE ON SE TROUVE
if(isset($_GET['page']) && !empty($_GET['page'])){
    $currentPage = (int) strip_tags($_GET['page']);
}else{
    $currentPage = 1;
}

// CONNEXION BDD
$db = new PDO('mysql:host=localhost;dbname=blog','root', '');

// COMPTE LE NOMBRE ARTICLE TOTAL EN BDD
//$req = $db->prepare("SELECT * FROM `articles`");
//$req->execute();
//$nbArticle = $req->rowCount();

$req = $db->prepare("SELECT COUNT(*) AS compteur FROM articles");
$req->execute();
$nbArticles = $req->fetch(PDO::FETCH_ASSOC);

var_dump($nbArticles);

// ON DETERMINE LE NOMBRE TOTAL ARTICLE PAR PAGE
$articlesParPage = 5;
$nbPages = ceil($nbArticles['compteur']/$articlesParPage);

//
@$page=$_GET["page"];

// SPECIFIER LA VALEUR DE DEPART
$debut = ($page-1 * $articlesParPage);

echo $nbPages;

// CALCUL LE NOMBRE DE PAGE TOTAL
// ceil => arrondi au nombre superieur
//$pages = ceil($nbArticles / $articleParPage);

//var_dump($pages);

// REQUETE RECUPERATION ARTICLES PAR ORDRE DU PLUS RECENTS AU PLUS ANCIENS (DESC)
$req = $db->prepare("SELECT * FROM articles ORDER BY date DESC LIMIT 0, 5;");
$req->execute();
$articles = $req->fetchAll(PDO::FETCH_ASSOC);

//var_dump($articles);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../public/css/style.css" />
    <title>Document</title>
</head>
<body>

<header>
    <?php require '../common/header.php'; ?>
</header>

<main>

    <?php foreach($articles as $article => $value) { ?>

    <div class="articles">
        <p>Posté le : <?= date("d-m-Y", strtotime($value['date'])) ?></p>
        <br/>
        <p><?= $value['article'] ?>
    </div>

    <?php } ?>

    <div id="pagination">
    <?php
        for($i=1;$i<=$nbPages;$i++) {
            echo "<a href='?page=$i'>$i</a>&nbsp";
        }
    ?>
    </div>

</main>

<footer>
    <?php require '../common/footer.php'; ?>
</footer>

</body>
</html>