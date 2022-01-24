

<?php

// ----------------------------
// ESPACE ADMIN <<<<<<<<<<<<<<<
// ----------------------------

// Démarrage de la session

session_start();

// Connexion à la base de donnée

require '../common/config.php'; 



?>

<?php $cat = $db->prepare('SELECT nom FROM categories');
        $cat->execute(array());
        ?>

<!doctype html>
<html lang="fr">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Espace Administrateur</title>
<link rel="stylesheet" href="../../public/css/style.css">
<link rel="icon" href="favicon.ico" />
</head>

<body>

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
    echo "<br>" . "Catégorie ajoutée.";
  }
    else {
      echo "<br>" . "Catégorie déjà existante.";
    }
}


?>
</form>
</div>
</section>