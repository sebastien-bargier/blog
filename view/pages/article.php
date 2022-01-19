<?php

// ----------------------------------------------------------
// AFFICHAGE ARTICLE, TRAITEMENT COMMENTAIRES <<<<<<<<<<<<<<<
// ----------------------------------------------------------

session_start();

require '../common/config.php'; 

// DETERMINE SUR QUELLE PAGE ON SE TROUVE

if(isset($_GET['id']) && !empty($_GET['id'])) {

    $getid = htmlspecialchars($_GET['id']);

    // Récupere l'article selon l'id

    $requete = $db->prepare("SELECT * FROM articles WHERE id = :getid");
    $requete->execute(array('getid' => $getid));
    $article = $requete->fetch();
}


// Vérification si le formulaire a été envoyé

if(isset($_POST) && !empty($_POST)) {

    // Vérification champ commentaire

    if(!empty($_POST['commentaire'])) {

        $commentaire = htmlspecialchars($_POST['commentaire']);

        // Insertion du commentaire en base de données

        $insertCom = $db->prepare('INSERT INTO commentaires(commentaire, id_article, id_utilisateur, date) VALUES(:commentaire, :id_article, :id_utilisateur, NOW())');
        $insertCom->execute(array(
            'commentaire' => $commentaire,
            'id_article' => $getid,
            'id_utilisateur' => $_SESSION['id']
        ));


    } else {
        echo "Veuillez entrer un commentaire";
    }
}

// 

$commentaire = $db->prepare("SELECT * FROM commentaires c INNER JOIN utilisateurs u ON c.id_utilisateur = u.id WHERE id_article = $getid");
$commentaire->execute();
$commentaire = $commentaire->fetchAll();

?>

<!doctype html>
<html lang="fr">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Article</title>
<link rel="stylesheet" href="../../public/css/style.css">
<link rel="icon" href="favicon.ico" />
</head>
<body>

    <!--Import du header -->

    <header>

    <?php include ('../common/header.php'); ?>

    </header>

    <main>
        
        <section>

            <article>

                <p><?= $article['article'] ?></p>

            </article>

            <h2>Commentaires</h2>

            <?php foreach($commentaire as $key) : ?>

            <div>
                <p><?= $key['commentaire'] ?></p>
            </div>

            <?php endforeach; ?>

            <form action="" method="POST">
                
                <textarea name="commentaire" placeholder="Ecrivez votre commentaire..."></textarea>

                <input type="submit" value="Valider" name="formsend">

            </form>
        </section>
    </main>

    <footer>
        <?php require '../common/footer.php'; ?>
    </footer>
    
</body>
</html>