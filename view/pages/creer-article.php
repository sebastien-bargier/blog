<?php

// ------------------------------------------
// TRAITEMENT CREATION ARTICLE <<<<<<<<<<<<<<<
// ------------------------------------------

session_start();

require '../common/config.php'; 

$msg['error_file'] = "";

$req = $db->prepare("SELECT * FROM categories");
$req->execute();
$categories = $req->fetchAll(PDO::FETCH_ASSOC);

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

                    $msg['error_file'] = "L'extension de l'image n'est pas autorisé.";
                }
                    //Si l'image est trop grande on affiche le message
            } else {

                $msg['error_file'] = "La taille de l'image est trop grande.";
            }

        }else{
                //Si aucun fichier n'a été envoyer on affiche le message
                $msg['error_file'] =  "Le téléchargement à échoué.";
        }
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
                <input name="titreArticle" placeholder="Entrez un titre" required="required" autocomplete="off">
            </div>

            <div class="form_container">
                <select name="categorieArticle">

                    <?php foreach($categories as $categorie) :?>

                        <option value="<?= $categorie['id'] ?>"><?= $categorie['nom'] ?></option>

                    <?php endforeach; ?>

                </select>
            </div>

            <div class="form_container">
                <textarea name="contenuArticle" placeholder="Ecrivez votre article" required="required" autocomplete="off"></textarea>
            </div>

            <div>
                <input type="file" name="imageArticle">
                <p><?= $msg['error_file'] ?></p>
            </div>

            <div class="form_container">
                <input type="submit" class="btn" name="formsend" value="Valider">
            </div>

        </form>
    <!--Import du footer -->
    
    <footer>

    <?php include ('../common/footer.php'); ?>

    </footer>

</body>
</html>