<?php

// ----------------------------------------------------------
// AFFICHAGE ARTICLE, TRAITEMENT COMMENTAIRES <<<<<<<<<<<<<<<
// ----------------------------------------------------------

session_start();

require '../common/config.php'; 

// Initalisation variable vide message erreur commentaire
$msg['commentaire'] = "";

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

    // Verification si un utilisateur est connecté
    if(isset($_SESSION['id'])) {
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
            header("Refresh:0");
        }

    } else {

        // si utilisateur non connecté on laisse un message d'erreur
        $msg['commentaire'] = '<a href="connexion.php">Connectez-vous ici pour laisser un commentaire.</a>';
    }
}



?>

<!doctype html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../../public/css/style.css">
<title>Article</title>
</head>
<body>

    <!--Import du header -->

    <header>
        <?php include '../common/header.php'; ?>
    </header>

    <main>
        
        <section class="page_article">

            <article class="article">

                <?php foreach($article as $key) : ?>

                    <p>Categorie - <?= $key['nom'] ?></p>

                    <h3><?= $key['titre'] ?></h3>

                    <img src="../../public/images/<?=$key['image'] ?>" alt="<?= $key['nom_image'] ?>">

                    <p><?= $key['article'] ?></p>

                <?php endforeach; ?>

            </article>

            <h2>Commentaires :</h2>

            <?php foreach($commentaire as $key) : ?>

                <div class="commentaire">
                    <p><?= $key['commentaire'] ?></p>
                </div>

            <?php endforeach; ?>

            <form class="form_commentaire" action="" method="POST">

                <input class="input_commentaire" type="text" name="commentaire" placeholder="Ecrivez votre commentaire..."  required="required" />
                <p><?= $msg['commentaire'] ?></p>

                <input type="submit" value="Valider" name="formsend">
            </form>
        </section>
    </main>

    <footer>
        <?php require '../common/footer.php'; ?>
    </footer>
    
</body>
</html>