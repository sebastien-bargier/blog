<?php

// ------------------------------------------
// TRAITEMENT AFFICHAGES DES ARTICLES <<<<<<<<<<<<<<<
// ------------------------------------------

session_start();

require '../common/config.php';

// DETERMINE SUR QUELLE PAGE ON SE TROUVE
if(isset($_GET['page']) && !empty($_GET['page'])) {

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
$articlesParPage = 3;

// CALCUL NOMBRE DE PAGE TOTAL
$nombreDePages = ceil($nombreArticlesBDD/$articlesParPage);

// SPECIFIER LA VALEUR DE DEPART
$premierArticle = ($pageCourante * $articlesParPage) - $articlesParPage;

// REQUETE RECUPERATION ARTICLES PAR ORDRE DU PLUS RECENTS AU PLUS ANCIENS (DESC)
$requete = $db->prepare("SELECT * FROM categories INNER JOIN articles ON articles.id_categorie = categories.id ORDER BY date DESC LIMIT $premierArticle, $articlesParPage;");
$requete->execute();
$articles = $requete->fetchAll(PDO::FETCH_ASSOC);

// REQUETE CHOIX CATEGORIE 
$filtreCat = $db->prepare("SELECT * FROM categories");
$filtreCat->execute(array());

if(isset($_POST['formsend'])) {

    $_SESSION['formsend'] = $_POST['formsend'];
    $_SESSION['categorie'] = (int)$_POST['categorie'];
}

$requete = $db->prepare("SELECT * FROM categories INNER JOIN articles ON articles.id_categorie = categories.id WHERE articles.id_categorie = :selectCategorie ORDER BY date DESC LIMIT $premierArticle, $articlesParPage;");
$requete->execute(array('selectCategorie' => $_SESSION['categorie']));
$articles = $requete->fetchAll(PDO::FETCH_ASSOC);

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

        <form class="categorie_form" action="" method="POST">

            <select name="categorie">

                <option value="0">Toutes les catégories</option>

                <?php
                
                while($valCat = $filtreCat->fetch(PDO::FETCH_ASSOC)) {
                                                
                    echo "<option value=" . $valCat["id"] . ">" . $valCat["nom"] . "</option>";
                                                
                }

                ?>

                <input type="submit" class="categorie_btn" name="formsend" value="OK">

            </select>

        </form>

        <section>
 
            <?php foreach($articles as $article) : ?>

                <article>

                    <a href="../pages/article.php?id=<?= $article['id'] ?>">

                        <p>Categorie - <?= $article['nom'] ?></p>

                        <h3><?= $article['titre'] ?></h3>

                        <img src="../../public/images/<?=$article['image'] ?>" alt="<?= $article['nom_image'] ?>">

                        <p><?= $article['article'] ?></p>

                        <p>Date de publication : <?= date("d-m-Y à H:i", strtotime($article['date'])) ?></p>

                    </a>
                </article>
            <?php endforeach; ?>

        </section>

        <div class="pagination">

            <?php

            if($_SESSION['formsend']) {

                if($pageCourante != 1) {

                    $precedent = $pageCourante-1;
                    echo'<a href="articles.php?categorie='. $_SESSION['categorie'] .'&page='.$precedent.'">precedent</a>';   
                }

                for($page = 1; $page <= $nombreDePages; $page++) {

                    echo'<a href="articles.php?categorie='. $_SESSION['categorie'] .'&page='.$page.'">'.$page.'</a>';   
                }

                if($pageCourante<$nombreDePages) {

                    $suivant= $pageCourante+1;
                    echo'<a href="articles.php?categorie='. $_SESSION['categorie'] .'&page='.$suivant.'">suivant</a>';   
                }
            
            } else {
  
                if($pageCourante != 1) {

                    $precedent = $pageCourante-1;
                    echo'<a href="articles.php?page='.$precedent.'">precedent</a>'; 

                }

                for($page=1; $page <= $nombreDePages; $page++) {
            
                    echo'<a href="articles.php?page='.$page.'">'.$page.'</a>';       
                }

                if($pageCourante<$nombreDePages) {

                    $suivant= $pageCourante+1;
                    echo'<a href="articles.php?page='.$suivant.'">suivant</a>';   
                }
            }

            ?>
            
        </div>

    </main>
</body>
</html>