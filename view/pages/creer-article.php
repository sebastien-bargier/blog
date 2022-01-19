<?php

// ------------------------------------------
// TRAITEMENT CREATION ARTICLE <<<<<<<<<<<<<<<
// ------------------------------------------

session_start();

require '../common/config.php'; 

$req = $db->prepare("SELECT * FROM categories");
$req->execute();
$categories = $req->fetchAll(PDO::FETCH_ASSOC);

// Vérification si le formulaire a été envoyé

if(isset($_POST["formsend"])) {

    // Vérirfication si le contenu de l'article n'est pas vide

    if(!empty($_POST['contenuArticle'])) {

        $categorieArticle = $_POST['categorieArticle'];
        $article = htmlspecialchars($_POST['contenuArticle']);
        //$fileImage = $_FILES['imageArticle'];
        //$repertoire = "public/images/articles/";


        // Insertion des données dans la table

        $insertArticle = $db->prepare("INSERT INTO articles (article, id_utilisateur, id_categorie, date) VALUES(:article, :id_utilisateur, :id_categorie,NOW())");
        $insertArticle->execute(array('article' => $article, 'id_utilisateur' => $_SESSION['id'], 'id_categorie' => $categorieArticle));

    } else {

    }
}

?>

<!--Création du formulaire ajout article-->

<!doctype html>
<html lang="fr">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Ajouter un article</title>
<link rel="stylesheet" href="../../public/css/style.css">
<link rel="icon" href="favicon.ico" />
</head>
<body>

    <!--Import du header -->

    <header>

    <?php include ('../common/header.php'); ?>

    </header>

    <!-- Formulaire -->

    <div class="user_login">

        <form action="" method="POST" enctype="multipart/form-data">

            <h1 class="login_text">Ajouter un article</h1>

            <div class="form_container">

                <select name="categorieArticle">

                    <?php foreach($categories as $categorie) :?>
                        <option value="<?= $categorie['id'] ?>"><?= $categorie['nom'] ?></option>
                    <?php endforeach; ?>

                </select>
            </div>

            <div class="form_container">
                <textarea placeholder="Ecrire votre article" name="contenuArticle" required autocomplete="off"></textarea>
            </div>

            <div class="form_container">
                <input type="submit" class="btn" name="formsend" value="Valider">
            </div>

        </form>
</body>
</html>