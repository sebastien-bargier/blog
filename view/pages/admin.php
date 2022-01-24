<?php

// ----------------------------
// ESPACE ADMIN <<<<<<<<<<<<<<<
// ----------------------------

// Démarrage de la session

session_start();

// Connexion à la base de donnée

require '../common/config.php'; 



?>

<?php

// Récupération des données de tous les utilisateurs

$req = $db->prepare('SELECT * FROM utilisateurs INNER JOIN droits ON utilisateurs.id_droits = droits.id  ORDER BY utilisateurs.id ASC');
$req->execute(array());

?>

<?php


?>

<!--Création du tableau -->

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
  
<!--Import du header -->

<header>

<?php include('../common/header.php'); ?>

</header>

<main>

<!-- Lister les utilisateurs -->

<section>
  
  <div class="big_container">
    <div class=tbl_container>
      <h1>Liste des utilisateurs</h1>
      <div class="tbl-header">
        <table>
          <thead>
            
            <tr>
              <th>Nom d'utilisateur</th>
              <th>Adresse e-mail</th>
              <th>Type de compte</th>
            </tr>
        
          </thead>
        </table>
      </div>
 
      <div class="tbl-content">
        <table>
          <tbody>
            
            <?php while($data = $req->fetch(PDO::FETCH_ASSOC)) : ?>
            
            <tr>
              <td><?php echo htmlspecialchars($data['login']); ?></td>
              <td><?php echo htmlspecialchars($data['email']); ?></td>
              <td><?php echo htmlspecialchars($data['nom']); ?></td>

            </tr>
            
            <?php endwhile; ?>

          </tbody>
        </table>
      </div>
              
      <div class="buttons">
              
              <ul>
                <li><a href="test.php">Modifier un droit d'accès</a></li>
                <li><a href="supp.php">Supprimer un utilisateur</a></li>
              </ul>
            </div>

    </div> 
  </div>
  
</section>

<!-- Lister les articles -->

<section>
  
  <div class="big_container">
    <div class=tbl_container>
      <h1>Liste des articles</h1>
      <div class="tbl-header">
        <table>
          <thead>
            
            <tr>
              <th>Titre</th>
              <th>Contenu</th>
              <th>Catégorie</th>
            </tr>
        
          </thead>
        </table>
      </div>
 
      <div class="tbl-content">
        <table>
          <tbody>
            
            <?php while($data = $req->fetch(PDO::FETCH_ASSOC)) : ?>
            
            <tr>
              <td><?php echo htmlspecialchars($data['login']); ?></td>
              <td><?php echo htmlspecialchars($data['email']); ?></td>
              <td><?php echo htmlspecialchars($data['nom']); ?></td>

            </tr>
            
            <?php endwhile; ?>

          </tbody>
        </table>
      </div>
    </div> 


</div>
</section>
            </main>

<!--Import du footer -->

<footer>

<?php include('../common/footer.php'); ?>

</footer>


</body>