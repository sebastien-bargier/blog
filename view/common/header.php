<?php

$categorie = $db->prepare("SELECT * FROM categories");
$categorie->execute(array());

?>

<nav>
  
  <a class="logo" href="accueil.php">eBLOG</a>

  <ul>
    
    <?php if(isset($_SESSION['id'])) : ?>
      
      <li><a href="profil.php">Profil</a></li>
      <li><a href="../common/deconnexion.php">Déconnexion</a></li>

    <?php else : ?>
        
      <li><a href="inscription.php">Inscription</a></li>
      <li><a href="connexion.php">Connexion</a></li>

    <?php endif; ?>

    <li class="deroulant"><a href="articles.php">Articles</a>
      <ul class="sous">

        <?php while($cat = $categorie->fetch(PDO::FETCH_ASSOC)) :?>

          <li><a href="../pages/articles.php?categorie=<?= $cat['id'] ?>"><?= $cat['nom'] ?></a></li>
        <?php endwhile; ?>

      </ul>
    </li>
  </ul>
</nav>