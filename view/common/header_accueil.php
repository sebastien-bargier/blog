<?php
// REQUETE CHOIX CATEGORIE 
$filtreCategorie = $db->prepare("SELECT * FROM categories");
$filtreCategorie->execute(array());
?>

<div class="container">
  <nav class="nav_accueil">
    <a href="../../index.php" class="logo">InnovaTech</a>
    <ul class="nav-list">
        <li>
            <a href="../../index.php" class="nav-link_accueil">Accueil</a>
        </li>
        
        <li>
            <a href="#" class="nav-link_accueil">Contact</a>
        </li>

        <li><a href="../../view/pages/articles.php" class="deroulant">Articles</a>
        <ul class="sous">
          <li>&nbsp;</li>
          <li>&nbsp;</li>
          <li>&nbsp;</li>
          <li>&nbsp;</li>

          <?php

          while($categorie = $filtreCategorie->fetch(PDO::FETCH_ASSOC)) : ?>

          <li><a style="font-size: 19px;" href="../pages/articles.php?categorie=<?= $categorie['id'] ?>"><?= $categorie['nom'] ?></a></li><br>
                                        
          <?php endwhile; ?>

        </ul>
        </li>

        <?php if(!isset($_SESSION['id'])) {

        echo '<li>
            <a href="#" id="nav_hide"class="nav-link_accueil">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </a>
        </li>

        <li>
            <a href="#" id="nav_hide" class="nav-link_accueil">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </a>
        </li>';

        }

        ?>
        
        <?php if(isset($_SESSION['id'])) : ?>

        <?php if($_SESSION['id_droits'] == 42) : ?>
          
        <li>
          <a href="../../view/pages/creer-article.php" class="nav-link_accueil">Créer un article</a>
        </li> 
        <?php endif; ?>

        <?php if(($_SESSION['id_droits']) == 1337) : ?>

        <li>
        <a href="../../view/pages/admin.php" class="nav-link_accueil">Administration</a>
        </li>
        
        <?php endif; ?>

      </ul>

      <a href="../../view/pages/profil.php" id="nav-cta_accueil">Profil</a>
      <a href="../../view/common/deconnexion.php" id="nav-cta_accueil">Déconnexion</a>

      <?php else : ?>

      <a href="../../view/pages/inscription.php" id="nav-cta_accueil">Inscription</a>
      <a href="../../view/pages/connexion.php" id="nav-cta_accueil">Connexion</a>

      <?php endif; ?>

  </nav>
</div>
