<?php if(isset($_SESSION['id'])) : ?>

<div class="container">
  <nav class="nav_accueil">
    <a href="../../index.php" class="logo">InnovaTech</a>
    <ul class="nav-list">
        <li>
            <a href="../../index.php" class="nav-link_accueil">Accueil</a>
        </li>
        <li>
            <a href="../../view/pages/articles.php" class="nav-link_accueil">Articles</a>
        </li>
        <li>
            <a href="#" class="nav-link_accueil">Contact</a>
        </li>               
        <li>
          <a href="../../view/pages/creer-article.php" class="nav-link_accueil">Créer un article</a>
        </li>
      </ul>
      <a href="../../view/pages/profil.php" id="nav-cta_accueil">Profil</a>
      <a href="../../view/common/deconnexion.php" id="nav-cta_accueil">Déconnexion</a>
  </nav>
</div>

<?php else : ?>

<div class="container">
  <nav class="nav_accueil">
      <a href="../../index.php" class="logo">InnovaTech</a>
      <ul class="nav-list">
          <li>
              <a href="../../index.php" class="nav-link_accueil">Accueil</a>
          </li>
          <li>
              <a href="../../view/pages/articles.php" class="nav-link_accueil">Articles</a>
          </li>
          <li>
              <a href="#" class="nav-link_accueil">Contact</a>
          </li>                
        </ul>
        <a href="../../view/pages/inscription.php" id="nav-cta_accueil">Inscription</a>
        <a href="../../view/pages/connexion.php" id="nav-cta_accueil">Connexion</a>
  </nav>
</div>

<?php endif ?>