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

        <?php if(!isset($_SESSION['id'])) {

        echo '<li>
            <a href="#" id="nav_hide"class="nav-link">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </a>
        </li>

        <li>
            <a href="#" id="nav_hide" class="nav-link">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </a>
        </li>';

        }

        ?>
        
        <?php if(isset($_SESSION['id'])) : ?>

        <?php if($_SESSION['id_droits'] == 42) : ?>
          
        <li>
          <a href="../../view/pages/creer-article.php" class="nav-link">Créer un article</a>
        </li> 
        <?php endif; ?>

        <?php if(($_SESSION['id_droits']) == 1337) : ?>

        <li>
        <a href="../../view/pages/admin.php" class="nav-link">Administration</a>
        </li>
        
        <?php endif; ?>

      </ul>

      <a href="../../view/pages/profil.php" id="nav-cta">Profil</a>
      <a href="../../view/common/deconnexion.php" id="nav-cta">Déconnexion</a>

      <?php else : ?>

      <a href="../../view/pages/inscription.php" id="nav-cta">Inscription</a>
      <a href="../../view/pages/connexion.php" id="nav-cta">Connexion</a>

      <?php endif; ?>

  </nav>
</div>