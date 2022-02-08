<?php if(isset($_SESSION['id'])) : ?>

<div class="container">
  <nav class="nav">
    <a href="../../index.php" class="logo">InnovaTech</a>
    <ul class="nav-list">
        <li>
            <a href="../../index.php" class="nav-link">Accueil</a>
        </li>
        <li>
            <a href="../../view/pages/articles.php" class="nav-link">Articles</a>
        </li>
        <li>
            <a href="#" class="nav-link">Contact</a>
        </li>               
        <li>
          <a href="../../view/pages/creer-article.php" class="nav-link">Créer un article</a>
        </li>
      </ul>
      <a href="../../view/pages/profil.php" id="nav-cta">Profil</a>
      <a href="../../view/common/deconnexion.php" id="nav-cta">Déconnexion</a>
  </nav>
</div>

<?php else : ?>

<div class="container">
  <nav class="nav">
      <a href="../../index.php" class="logo">InnovaTech</a>
      <ul class="nav-list">
          <li>
              <a href="../../index.php" class="nav-link">Accueil</a>
          </li>
          <li>
              <a href="../../view/pages/articles.php" class="nav-link">Articles</a>
          </li>
          <li>
              <a href="#" class="nav-link">Contact</a>
          </li>                
        </ul>
        <a href="../../view/pages/inscription.php" id="nav-cta">Inscription</a>
        <a href="../../view/pages/connexion.php" id="nav-cta">Connexion</a>
  </nav>
</div>

<?php endif ?>