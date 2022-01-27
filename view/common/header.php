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
        
        <li><a href="">Categorie 1</a></li>
        <li><a href="">Categorie 2</a></li>
        <li><a href="">Categorie 3</a></li>

      </ul>
    </li>
  </ul>
</nav>