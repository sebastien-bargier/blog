<?php

// ------------------------------------------
// TRAITEMENT AFFICHAGES DES ARTICLES <<<<<<<<<<<<<<<
// ------------------------------------------

session_start();

require '../common/config.php';

// On détermine sur quelle page on se trouve
if(isset($_GET['start']) && !empty($_GET['start'])) {

    $currentPage = (int) strip_tags($_GET['start']);

}else{

    $currentPage = 1;
}
// On détermine dans quelle catégorie on se trouve
if (isset($_GET['categorie']) && !empty($_GET['categorie'])) {

    $categorie_chiffre = 'WHERE id_categorie = '.strip_tags($_GET['categorie']);
}
else {
    $categorie_chiffre = '';
}


// On détermine le nombre total d'articles
$requete = $db->prepare('SELECT  COUNT(*) AS nb_articles FROM `articles` '.$categorie_chiffre.'');

// On exécute
$requete->execute();

// On récupère le nombre d'articles
$result = $requete->fetch();

$nbArticles = (int) $result['nb_articles'];

// On détermine le nombre d'articles par page
$parPage = 5;

// On calcule le nombre de pages total
$pages = ceil($nbArticles / $parPage);

// Calcul du 1er article de la page
$premier = ($currentPage * $parPage) - $parPage;

$requete = $db->prepare('SELECT * FROM `articles` '.$categorie_chiffre.' ORDER BY `id` DESC LIMIT '.$premier.', '.$parPage.'');
$requete->execute();
$articles = $requete->fetchAll();

// REQUETE CHOIX CATEGORIE 
$filtreCat = $db->prepare("SELECT * FROM categories");
$filtreCat->execute(array());

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/style.css">
    <title>Document</title>
</head>
<body>

<header>

<?php include ('../common/header.php'); ?>

</header>

    <main>

        <section>

            <!-- Continents -->
            <section class="categories">

            <form class="categorie_form" action="" method="GET">

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

            </section>

            <!-- Articles -->
            <section class="les_articles">
    
            <?php foreach($articles as $article) : ?>

                <article>

                    <a href="../pages/article.php?id=<?= $article['id'] ?>">

                        <h3><?= $article['titre'] ?></h3>

                        <img src="../../public/images/<?=$article['image'] ?>" alt="<?= $article['nom_image'] ?>">

                        <p><?= $article['article'] ?></p>

                        <p>Date de publication : <?= date("d-m-Y à H:i", strtotime($article['date'])) ?></p>

                    </a>
                </article>
            <?php endforeach; ?>

            </section>

            <!-- Pagination -->
            <section class="pagination">

                <?php

                if ($currentPage != 1) {

                    echo '<a href="articles.php?';
                    
                    if (isset($_GET['categorie'])) {
                        echo 'categorie='.$_GET['categorie'].'&';
                    } 

                    echo 'start='.($currentPage-1).'">Précédant</a>'; 
                } 
                
                for($page = 1; $page <= $pages; $page++) {
                    
                    
                    if($page == $currentPage) {

                        echo $page.' ';
                    } else {

                        echo '<a href="articles.php?';
                        
                        if (isset($_GET['categorie'])) {
                            echo 'categorie='.$_GET['categorie'].'&';
                        }  

                        echo 'start='.$page.'">'.$page.'</a> ';
                    }
                }

                if ($currentPage < $pages) {

                    echo '<a href="articles.php?';
                    
                    if (isset($_GET['categorie'])) {

                        echo 'categorie='.$_GET['categorie'].'&';
                    }   
                    
                    echo 'start='.($currentPage+1).'">Suivant</a>';
                }

                ?>
            </section>
        </section>
    </main>

</body>
</html>