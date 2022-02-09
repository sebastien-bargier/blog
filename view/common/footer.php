<?php if(isset($_SESSION['id'])) : ?>

<div class="footer_container">
    <nav>
        <ul>
            <li><a href="accueil.php">Accueil</a></li>
            <li class="bar_footer">|</li>
            <li><a href="articles.php">Articles</a></li>
            <li class="bar_footer">|</li>
            <li><a href="contact.php">Contact</a></li>
            <li class="bar_footer">|</li>
            <li><a href="profil.php">Profil</a></li>
            <li class="bar_footer">|</li>
            <li><a href="../../view/common/deconnexion.php">Déconnexion</a></li>
            <li class="bar_footer">|</li>
            <li><a href="https://github.com/sebastien-bargier/blog">Github</a></li>
        </ul>
    </nav>
</div>

<?php else : ?>

<div class="footer_container">
    <nav>
        <ul>
            <li><a href="accueil.php">Accueil</a></li>
            <li class="bar_footer">|</li>
            <li><a href="articles.php">Articles</a></li>
            <li class="bar_footer">|</li>
            <li><a href="contact.php">Contact</a></li>
            <li class="bar_footer">|</li>
            <li><a href="inscription.php">Inscription</a></li>
            <li class="bar_footer">|</li>
            <li><a href="connexion.php">Connexion</a></li>
            <li class="bar_footer">|</li>
            <li><a href="https://github.com/sebastien-bargier/blog">Github</a></li>
        </ul>
    </nav>
</div>

<?php endif ?>