<?php

// --------------------------------------------------
// TRAITEMENT AFFICHAGES DES ARTICLES <<<<<<<<<<<<<<<
// --------------------------------------------------

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

    $categorie = 'WHERE id_categorie = '.strip_tags($_GET['categorie']);
}
else {

    $categorie = '';
}

$check = $db->prepare('SELECT * FROM articles a INNER JOIN utilisateurs u ON a.id_utilisateur = u.id');
$check->execute(array());
$data = $check->fetch();

// On détermine le nombre total d'articles
$requete = $db->prepare('SELECT  COUNT(*) AS nb_articles FROM `articles` '.$categorie.'');

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

// On récupère les données de tous les articles
$requete = $db->prepare('SELECT * FROM utilisateurs INNER JOIN articles ON articles.id_utilisateur = utilisateurs.id INNER JOIN categories ON articles.id_categorie = categories.id '.$categorie.' ORDER BY date DESC LIMIT '.$premier.', '.$parPage.'');
$requete->execute();
$articles = $requete->fetchAll();

// REQUETE CHOIX CATEGORIE 
$filtreCategorie2 = $db->prepare("SELECT * FROM categories");
$filtreCategorie2->execute(array());

?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.9.0/css/all.css" integrity="sha384-i1LQnF23gykqWXg6jxC2ZbCbUMxyw5gLZY6UiUS98LYV5unm8GWmfkIS6jqJfb4E" crossorigin="anonymous">
    <title>Innovatech - Articles</title>
    <link rel="stylesheet" href="../../public/css/styles.css">
</head>
<body>
    
    <!-- IMPORT DU HEADER -->

    <header class="header">
    
    <?php include ('../common/header.php'); ?>

    </header>

    <!-- MAIN -->

    <main class="main">
    
        <div class="marge"></div>

        <section id="categories">

            <!-- PARTIE CATEGORIES -->

            <a href="../pages/articles.php"><p>Toutes les catégories</p></a>

            <?php

            while($categorie = $filtreCategorie2->fetch(PDO::FETCH_ASSOC)) : ?>

            <a href="../pages/articles.php?categorie=<?= $categorie['id'] ?>"><p><?= $categorie['nom'] ?></p></a>
                                        
            <?php endwhile; ?>

        </section>
        
        <!-- PARTIE ARTICLES -->

            <!-- ARTICLES -->

            <div class="wrapper_article">

            <?php foreach($articles as $article) : ?>

                <div class="card">

                    <div class="card-header">
                    
                        <img src="../../public/images/<?=$article['image'] ?>" >

                    </div>

                    <div class="card-body">
                        <span class="tag"><?= $article['nom'] ?></span>
                        <h1><?= $article['titre'] ?></h1>
                        <p>Posté par <?= $article['login'] ?> le <?= $article['date'] ?></p>
                        <p><?= $article['article'] ?></p>
                        <a href="../pages/article.php?id=<?= $article['id'] ?>" class="btn">Lire la suite</a>

                    </div>

                </div>
                
                <?php endforeach; ?>

            </div>

        </section>

        <div class="pagination">
        
        <!-- PARTIE PAGINATION -->

        <?php

            if ($currentPage != 1) {

                echo '<a href="articles.php?';
                
                if (isset($_GET['categorie'])) {
                    echo 'categorie='.$_GET['categorie'].'&';
                } 

                echo 'start='.($currentPage-1).'">Précédent</a>'; 
            } 
            
            for($page = 1; $page <= $pages; $page++) {
                    
                echo'<a href="articles.php?start='.$page.'">'.$page.'</a>';       
            }

            if ($currentPage < $pages) {

                echo '<a href="articles.php?';
                
                if (isset($_GET['categorie'])) {

                    echo 'categorie='.$_GET['categorie'].'&';
                }   
                
                echo 'start='.($currentPage+1).'">Suivant</a>';
            }

            ?>

        </div>

    </main>

    <!-- IMPORT DU FOOTER -->

    <footer>

    <?php include ('../common/footer.php'); ?>

    </footer>

</body>
</html>