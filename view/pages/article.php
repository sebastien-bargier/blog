<?php

// ----------------------------------------------------------
// AFFICHAGE ARTICLE, TRAITEMENT COMMENTAIRES <<<<<<<<<<<<<<<
// ----------------------------------------------------------

session_start();

require '../common/config.php'; 

// DETERMINE SUR QUELLE PAGE ON SE TROUVE

if(isset($_GET['id']) && !empty($_GET['id'])) {

    $getid = htmlspecialchars($_GET['id']);

}

// Récupère l'article selon son id passé dans l'url

$requete = $db->prepare("SELECT * FROM articles a INNER JOIN categories c ON a.id_categorie = c.id WHERE a.id = :getid");
$requete->execute(array('getid' => $getid));
$article = $requete->fetchAll(PDO::FETCH_ASSOC); 


// Récupère les commentaires utilisateur lié a l'article

$requete = $db->prepare("SELECT * FROM commentaires c INNER JOIN utilisateurs u ON c.id_utilisateur = u.id WHERE id_article = :getid");
$requete->execute(array('getid' => $getid));
$commentaire = $requete->fetchAll(PDO::FETCH_ASSOC);


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

        <?php foreach($article as $key) : ?>

            <article>

            <p><?= $key['nom'] ?></p>

            <h3><?= $key['titre'] ?></h3>

            <img src="../../public/images/<?=$key['image'] ?>" alt="<?= $key['nom_image'] ?>">

            <p><?= $key['article'] ?></p>

            </article>
        <?php endforeach; ?>

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