<?php

// ----------------------------
// PAGE ACCUEIL <<<<<<<<<<<<<<<
// ----------------------------

session_start();

require '../common/config.php';

// Récupération des données de tous les articles
// $requete = $db->prepare('SELECT * FROM categories INNER JOIN articles ON articles.id_categorie = categories.id ORDER BY date ASC LIMIT 3;');
// $requete->execute();
// $articles = $requete->fetchAll();

$requete = $db->prepare('SELECT login, date, image, articles.titre, categories.nom, articles.article, articles.id FROM utilisateurs INNER JOIN articles ON articles.id_utilisateur = utilisateurs.id INNER JOIN categories ON categories.id = articles.id_categorie ORDER BY date DESC LIMIT 3');
$requete->execute();
$articles = $requete->fetchAll();


// 

?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.9.0/css/all.css" integrity="sha384-i1LQnF23gykqWXg6jxC2ZbCbUMxyw5gLZY6UiUS98LYV5unm8GWmfkIS6jqJfb4E" crossorigin="anonymous">
    <title>Innovatech - Accueil</title>
    <link rel="stylesheet" href="../../public/css/styles.css">
</head>
<body>
    
    <!--IMPORT DU HEADER -->
    
    <header>

    <?php include ('../common/header_accueil.php'); ?>

    </header>

    <!-- MAIN -->

    <main>

        <!-- BANNIERE ACCUEIL -->

        <section class="hero">
            <div class="text-hero-banner">
                <?php if (isset($_SESSION['id'])) : ?>
                <h1> <?php echo ' Bonjour ' . $_SESSION['login'] . ', content de vous voir.' ?> </h1>  
                <a href="#articles">Nos derniers articles</a>
                <?php else : ?>
                <h2>Plongez dans l'univers de la technologie.</h2>
                <p>Découvrez les nouvelles tendances.</p>
                <a href="#articles">Nos derniers articles</a>
                <?php endif ?>
            </div>
        </section>

        <div id="articles" class="marge"></div>
        
        <!-- PARTIE ARTICLES -->

        <section class="content">
            <div class="container_article">
                <img src="../../public/img/article_logo.png"  alt="Article">
                <span>Nos derniers articles</span>
            </div>

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

                <div class="btn_articles">
                <a href="../../view/pages/articles.php">Tous les articles</a>
            </div>  

        </section>
        
    </main>

    <!-- SOCIAL MEDIAS -->

    <section class="social-media">

        <div class="icon facebook">
            <div class="tooltip">Facebook</div>
            <a href="https://www.facebook.com/" target="_blank"><span><i class="fab fa-facebook-f"></i></span></a>
        </div>
    
        <div class="icon twitter">
            <div class="tooltip">Twitter</div>
            <a href="https://www.twitter.com/" target="_blank"><span><i class="fab fa-twitter"></i></span></a>
        </div>
    
        <div class="icon youtube">
            <div class="tooltip">YouTube</div>
            <a href="https://www.youtube.com/" target="_blank"><span><i class="fab fa-youtube"></i></span></a>
        </div>
        
        <div class="icon github">
            <div class="tooltip">Github</div>
            <a href="https://github.com/sebastien-bargier/blog" target="_blank"><span><i class="fab fa-github"></i></span></a>
        </div>


    </section>

    <!--IMPORT DU FOOTER -->

    <footer>

    <?php include ('../common/footer.php'); ?>

    </footer>

    <!-- HEADER ACCUEIL SCROLL SCRIPT JS-->

    <script>
        
        window.addEventListener('scroll', function () {
            let header = document.querySelector('header');
            let windowPosition = window.scrollY > 0;
            header.classList.toggle('scrolling-active', windowPosition);
        })

    </script>

    <!-- SCROLL ACCUEIL SECTION SCRIPT JS -->

    <script>
    
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();

            document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
            });
        });
    });

    </script>

</body>
</html>
