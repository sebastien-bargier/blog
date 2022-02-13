<?php

// ------------------------------------------
// ESPACE ADMINISTRATION <<<<<<<<<<<<<<<<<<<<
// ------------------------------------------

// Démarrage de la session

session_start();

// Connexion à la base de donnée

require '../common/config.php'; 

// Checker si l'utilisateur est déjà connecté ou pas

if (!isset($_SESSION['id'])) {

    // On redirige vers l'accueil

    header('Location:accueil.php');

}

if ($_SESSION['id_droits'] == 1 OR $_SESSION['id_droits'] == 42) {

    // On redirige vers l'accueil

    header('Location:accueil.php');

}

?>

<?php

// Récupération des données de tous les utilisateurs

$req = $db->prepare('SELECT * FROM droits INNER JOIN utilisateurs ON utilisateurs.id_droits = droits.id  ORDER BY utilisateurs.id ASC');
$req->execute(array());

$req2 = $db->prepare("SELECT * FROM categories INNER JOIN articles ON articles.id_categorie = categories.id");
$req2->execute();

$req3 = $db->prepare("SELECT * FROM categories");
$req3->execute();

$req4 = $db->prepare("SELECT * FROM articles INNER JOIN commentaires ON articles.id = commentaires.id_article INNER JOIN utilisateurs ON commentaires.id_utilisateur = utilisateurs.id ORDER BY articles.titre ASC");
$req4->execute();




?>



<!--Création du formulaire de connexion-->

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.9.0/css/all.css" integrity="sha384-i1LQnF23gykqWXg6jxC2ZbCbUMxyw5gLZY6UiUS98LYV5unm8GWmfkIS6jqJfb4E" crossorigin="anonymous">
    <title>Innovatech - Administration</title>
    <link rel="stylesheet" href="../../public/css/styles.css">
</head>
<body>
    
    <!-- HEADER -->

    <header class="header">
 
    <?php include ('../common/header.php'); ?>

    </header>

    <!-- MAIN -->

    <div class="marge"></div>

    <main class="main2">

    <!-- Lister les utilisateurs -->

        <section>
        
        <div class="panel_container">
            <div class=tbl_container>
            <h1>Liste des utilisateurs</h1>
            <div class="tbl-header">
                <table>
                <thead>
                    
                    <tr>
                    <th>Nom d'utilisateur</th>
                    <th>Adresse e-mail</th>
                    <th>Type de compte</th>
                    <th>Suppression</th>
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
                    <td> <?php echo '<a href="user-delete.php?id='.$data['id'] . '">Supprimer</a>';?></td>
                    </tr>
                    
                    <?php endwhile; ?>

                </tbody>
                </table>
            </div>
                    
            <div class="buttons">
                    
                    
                    <a href="mod_acces.php">Modifier un droit d'accès</a>
                    
                    </div>

            </div> 
        </div>
        
        </section>

        <!-- Lister les articles -->

        <section>
        

        <div class="big_container">
        <div class="panel_container">
            <div class=tbl_container>
            <h1>Liste des articles</h1>
            <div class="tbl-header">
                <table>
                <thead>
                    
                    <tr>
                    <th>Titre</th>
                    <th>Contenu</th>
                    <th>Catégorie</th>
                    <th>Date</th>
                    <th>Modifier</th>
                    <th>Supprimer</th>
                    </tr>
                
                </thead>
                </table>
            </div>
        
            <div class="tbl-content">
            <form action="" method="post">  
            <table>
                <tbody>
                    
                    <?php while($data = $req2->fetch(PDO::FETCH_ASSOC)) : ?>
                    
                    <tr>
                    <td><?php echo htmlspecialchars($data['titre']); ?></td>
                    <td><?php echo htmlspecialchars($data['article']); ?></td>
                    <td><?php echo htmlspecialchars($data['nom']); ?></td>
                    <td><?php echo htmlspecialchars($data['date']); ?></td>
                    <td><a href="updatea-rticle.php?id=<?= $data['id'] ?>">Modifier</a></td>
                    <td> <?php echo '<a href="delete-article.php?id='.$data['id'] . '">Supprimer</a>';?></td>
                    </tr>
                    
                    <?php endwhile; ?>
                </tbody>
                </table>
                    </form>
            </div>

            <div class="buttons">
                    
                <a href="creer-article.php">Ajouter un article</a>

            </div> 


        </div>
        </section>

            <!-- Lister les catégories -->

            <section>
        
        <div class="panel_container">
            <div class=tbl_container>
            <h1>Liste des catégories</h1>
            <div class="tbl-header">
                <table>
                <thead>
                    
                    <tr>
                    <th>Nom de la catégorie</th>
                    <th>Supprimer</th>
                    </tr>
                
                </thead>
                </table>
            </div>
        
            <div class="tbl-content">
                <table>
                <tbody>
                    
                    <?php while($data = $req3->fetch(PDO::FETCH_ASSOC)) : ?>
                    
                    <tr>
                    <td><?php echo htmlspecialchars($data['nom']); ?></td>
                    <td> <?php echo '<a href="delete-categorie.php?id='.$data['id'] . '">Supprimer</a>';?></td>
                    </tr>
                    
                    <?php endwhile; ?>

                </tbody>
                </table>
            </div>
                    
            <div class="buttons">
                    
                    
                    <a href="add_categorie.php">Ajouter une catégorie</a>
                    
                    </div>

            </div> 
        </div>
        </section>

    <!-- Lister les commentaires -->

    <section>
        
        <div class="panel_container">
            <div class=tbl_container>
            <h1>Liste des commentaires</h1>
            <div class="tbl-header">
                <table>
                <thead>
                    
                    <tr>
                    <th>Commentaire</th>
                    <th>Nom de l'article</th>
                    <th>Nom de l'utilisateur</th>
                    <th>Date</th>
                    <th>Supprimer</th>
                    </tr>
                
                </thead>
                </table>
            </div>
        
            <div class="tbl-content">
                <table>
                <tbody>
                    
                    <?php while($data = $req4->fetch(PDO::FETCH_ASSOC)) : ?>
                    
                    <tr>
                    <td><?php echo htmlspecialchars($data['commentaire']); ?></td>
                    <td><?php echo htmlspecialchars($data['titre']); ?></td>
                    <td><?php echo htmlspecialchars($data['login']); ?></td>
                    <td><?php echo htmlspecialchars($data['date']); ?></td>
                    <td> <?php echo '<a href="delete-commentaire.php?id='.$data['id'] . '">Supprimer</a>';?></td>
                    </tr>
                    
                    <?php endwhile; ?>

                </tbody>
                </table>
            </div>
                    
            <div class="buttons"> </div>

            </div> 
        </div>
        </section>

    </main>

    <!-- FOOTER -->

    <footer>
 
    <?php include ('../common/footer.php'); ?>

    </footer>

</body>
</html>
    