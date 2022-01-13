<?php
session_start();

$msg['erreur'] = "";
$msg['valid'] = "";

if ((isset($_POST['valider'])) && $_POST['valider'] == 'Valider') {

    if (!empty($_POST['article'])) {

        $article = $_POST['article'];

        $db = new PDO('mysql:host=localhost;dbname=blog','root', '');
        $req = $db->prepare("INSERT INTO articles(article,date) VALUES(:article,NOW())");
        $req->execute(array(
            'article' => $article,
        ));

        $msg['valid']= "Votre commentaire à bien été ajouté";

    } else {
        $msg['erreur']= "Veuillez écrire un commentaire";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../public/css/style.css" />
    <title>Créer article</title>
</head>
<body>

<header>
    <?php require '../common/header.php'; ?>
</header>

<main>

    <form action="#" method="POST">
        <label for="commentaire">Votre article : </label>
        <textarea name="article"></textarea>

        <input type="submit" class="btn" name="valider" value="Valider">
        <br />
        <p class='error'><?= $msg['erreur'] ?></P>
        <p class='valid'><?= $msg['valid'] ?></P>
    </form>

</main>

<footer>
    <?php require '../common/footer.php'; ?>
</footer>

</body>
</html>