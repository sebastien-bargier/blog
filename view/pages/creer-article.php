<?php

// ------------------------------------------
// TRAITEMENT DE LA CONNEXION <<<<<<<<<<<<<<<
// ------------------------------------------

// Démarrage de la session

session_start();

// Connexion à la base de donnée

require '../common/config.php'; 

// Checker si l'utilisateur est déjà connecté ou pas

if (!isset($_SESSION['id'])) {

    // On redirige vers l'accueil

    header('Location:accueil.php');

}

if ($_SESSION['id_droits'] == 1) {

    // On redirige vers l'accueil

    header('Location:accueil.php');

}

// Récupération des catégories

$req = $db->prepare("SELECT * FROM categories");
$req->execute();
$categories = $req->fetchAll(PDO::FETCH_ASSOC);

?>

<!--Création du formulaire de création d'article-->

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.9.0/css/all.css" integrity="sha384-i1LQnF23gykqWXg6jxC2ZbCbUMxyw5gLZY6UiUS98LYV5unm8GWmfkIS6jqJfb4E" crossorigin="anonymous">
    <title>Innovatech - Créer un article</title>
    <link rel="stylesheet" href="../../public/css/styles.css">
</head>
<body>
    
    <!-- HEADER -->

    <header class="header">
    
    <?php include ('../common/header.php'); ?>

    </header>

    <!-- MAIN -->

    <main class="main">

        <div class="center">

        <h1>Création d'article</h1>

        <form action="" method="POST" enctype="multipart/form-data">

            <div class="txt_field">
                <input name="titreArticle" required="required" autocomplete="off">
                <span></span>
                <label>Titre de l'article</label>
            </div>

            <div class="select">
                <select name="categorieArticle">

                    <?php foreach($categories as $categorie) :?>

                        <option value="<?= $categorie['id'] ?>"><?= $categorie['nom'] ?></option>

                    <?php endforeach; ?>

                </select>
            </div>

            <div class="textarea">
                <textarea name="contenuArticle" placeholder="Contenu de article" required="required" autocomplete="off"></textarea>
            </div>

            <div class="file">
                <input type="file" name="imageArticle">
            </div>

            <div>
                <input type="submit" class="btn" name="formsend" value="Valider">
            </div>
            
            <?php

// Vérification si le formulaire a été envoyé

if(isset($_POST["formsend"])) {

    // Vérirfication si le contenu de l'article n'est pas vide

    if(!empty($_POST['contenuArticle'])) {

        $titreArticle = htmlspecialchars($_POST['titreArticle']);
        $categorieArticle = $_POST['categorieArticle'];
        $article = htmlspecialchars($_POST['contenuArticle']);
         
        if (isset($_FILES['imageArticle']) && $_FILES['imageArticle']['error'] == 0) {

            // Testons si le fichier n'est pas trop gros

            if ($_FILES['imageArticle']['size'] <= 1000000) {

                // Testons si l'extension est autorisée

                $infosfichier = pathinfo($_FILES['imageArticle']['name']);
                $extension_upload = $infosfichier['extension'];
                $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');

                $imageArticle = $_FILES['imageArticle']['name'];
                $nomImage = $infosfichier['filename'];

                if (in_array($extension_upload, $extensions_autorisees)){

                    // On peut valider le fichier et le stocker définitivement dans le dossier 'public/images'

                    move_uploaded_file($_FILES['imageArticle']['tmp_name'], '../../public/images/' .basename($imageArticle));
                    echo '<div class= "success_php">' . "Votre article a été publié avec succès." . '</div>';

                    // Insertion des données dans la table

                    $insertArticle = $db->prepare("INSERT INTO articles (titre, article, image, nom_image, id_utilisateur, id_categorie, date) VALUES(:titre, :article, :image, :nom_image, :id_utilisateur, :id_categorie, NOW())");
                    $insertArticle->execute(array(
                        'titre' => $titreArticle,
                        'article' => $article,
                        'image' => $imageArticle,
                        'nom_image' => $nomImage,
                        'id_utilisateur' => $_SESSION['id'],
                        'id_categorie' => $categorieArticle
                    ));
                    
                } else {

                    echo '<div class= "error_php">' . "L'extension de l'image n'est pas autorisé." . '</div>';
                }
                    //Si l'image est trop grande on affiche le message
            } else {

                echo '<div class= "error_php">' . "La taille de l'image est trop grande." . '</div>';
            }

        }else{
                //Si aucun fichier n'a été envoyer on affiche le message
                
                echo '<div class= "error_php">' . "Le téléchargement à échoué." . '</div>';
        }
    }
}

?>
        <br>

        </form>

        </div>

    </main>

    <!-- FOOTER -->

    <footer>

    <?php include ('../common/footer.php'); ?>

    </footer>

</body>
</html>