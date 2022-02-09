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

if (isset($_SESSION['id'])) {

$check = $db->prepare('SELECT * FROM utilisateurs WHERE id= ?');
$check->execute(array($_SESSION['id']));
$data = $check->fetch();

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
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.9.0/css/all.css" integrity="sha384-i1LQnF23gykqWXg6jxC2ZbCbUMxyw5gLZY6UiUS98LYV5unm8GWmfkIS6jqJfb4E" crossorigin="anonymous">
    <title>Innovatech - Article</title>
    <link rel="stylesheet" href="../../public/css/styles.css">
</head>
<body>
    
    <!-- HEADER -->

    <header class="header">
 
    <?php include ('../common/header.php'); ?>

    </header>

    <!-- MAIN -->

    <main class="main2">
    
    <div class="marge"></div>
        
        <section class="page_article">

            <article class="article">

                <?php foreach($article as $key) : ?>

                    <img src="../../public/images/<?=$key['image'] ?>" alt="<?= $key['nom_image'] ?>">
                    
                    <h1><?=$key['nom'] ?></h1>

                    <h2><?= $key['titre'] ?></h2>

                    <p><?= $key['article'] ?></p>

                <?php endforeach; ?>

            </article>

            <hr><br><br>

            <h3>Commentaires</h3>


            <?php foreach($commentaire as $key) : ?>

                <div class="commentaire">
                    <div class="com_container">
                        <p>Posté par <?= $key['login'] ?>&nbsp;le&nbsp;</p>
                        <p> </p>
                        <p><?= $key['date']?> : </p>
                    </div>
                    <p><?= $key['commentaire'] ?></p>
                </div>

                <?php $_SESSION['login'] = $key['login']; ?>

                <br>

            <?php endforeach; ?>
            
            <?php if (isset($_SESSION['id'])) : ?>
                
            <br><br><hr><br><br>
            <h3>Ecrivez votre commentaire</h3>

            <form class="form_commentaire" action="" method="POST">

                <textarea class="input_commentaire" type="text" name="commentaire" placeholder="Ecrivez votre commentaire..."  required="required"></textarea>
                <p><?= $msg['commentaire'] ?></p>

                <input type="submit" value="Valider" name="formsend">
            </form>

            <?php else : ?> 

            <br><p class="warning">Vous devez être connecté pour poster un commentaire. Connectez-vous <a href="connexion.php">ici</a></p><br><br>

            <?php endif ?>

        </section>
    </main>

    <footer>
        <?php require '../common/footer.php'; ?>
    </footer>
    
</body>
</html>