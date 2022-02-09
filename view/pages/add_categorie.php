

<?php

// ----------------------------
// ESPACE ADMIN <<<<<<<<<<<<<<<
// ----------------------------

// Démarrage de la session

session_start();

// Connexion à la base de donnée

require '../common/config.php'; 

if (!isset($_SESSION['id'])) {

    // On redirige vers l'accueil

    header('Location:accueil.php');

}

if ($_SESSION['id_droits'] == 1 OR $_SESSION['id_droits'] == 42) {

    // On redirige vers l'accueil

    header('Location:accueil.php');

}

?>

<?php $cat = $db->prepare('SELECT nom FROM categories');
        $cat->execute(array());
        ?>


<!--Création du formulaire de connexion-->

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.9.0/css/all.css" integrity="sha384-i1LQnF23gykqWXg6jxC2ZbCbUMxyw5gLZY6UiUS98LYV5unm8GWmfkIS6jqJfb4E" crossorigin="anonymous">
    <title>Innovatech - Droits utilisateurs</title>
    <link rel="stylesheet" href="../../public/css/styles.css">
</head>
<body>
    
    <!-- HEADER -->

    <header class="header">
 
    <?php include ('../common/header.php'); ?>

    </header>

    <!-- MAIN -->

    <main class="main2">

    <div class="center">

    <form class="admin_form2" action="" method="POST" enctype="multipart/form-data">

<h2 class="login_text">Catégories d'article</h2>
<br>

<div class="tbl-content">
  <table>
    <tbody>
      
      <?php while($categorie=$cat->fetch(PDO::FETCH_ASSOC)) : ?>
      
      <tr>
        <td class="td" ><?php echo htmlspecialchars($categorie['nom']); ?></td>
      </tr>
      
      <?php endwhile; ?>

    </tbody>
  </table>
</div>



<div class="">
  <input type="text" class="select" name="categorie" id="categorie" placeholder="Ajouter une catégorie" required="required" autocomplete="off">
      </div>

<div class="form_container">
  <input type="submit" class="btn" name="formsend" value="Valider">
</div>

<?php


if(isset($_POST) AND !empty($_POST) ) {


  $nom_categorie = htmlspecialchars($_POST['categorie']);

  $check_cat = $db->prepare('SELECT id, nom FROM categories WHERE nom = ?');
  $check_cat->execute(array($nom_categorie));
  $data_cat = $check_cat->fetch();
  $row_cat = $check_cat->rowCount();

  if ($row_cat == 0) {

    $insert = $db->prepare ('INSERT INTO categories(nom) VALUES (:nom)');
    $insert->execute(array('nom' => $nom_categorie));
    echo "<p class=success_php>Catégorie ajoutée.<p><br><br>";
  }
    else {
      echo "<p class=error2_php>Catégorie déjà existante.<p><br><br>";
    }
}

?>
</form>
</main>

    <!-- FOOTER -->

    <footer>
 
    <?php include ('../common/footer.php'); ?>

    </footer>

</body>
</html>
