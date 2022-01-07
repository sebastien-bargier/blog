<nav>
    <ul id="menu"> 
        
        <li><a href="accueil.php">Accueil</a></li>
        <?php 
        
        if($_SESSION) {
            echo ('
                <li><a href="profil.php">Profil</a></li>
                <li><a href="deconnexion.php">Déconnexion</a></li>
            ');

        } else {
            echo ('
                <li><a href="inscription.php">Inscription</a></li>
                <li><a href="connexion.php">Connexion</a></li>
            ');
        }
        
        ?>

        <li><a href="articles.php">Articles</a></li>
    </ul> 
</nav>