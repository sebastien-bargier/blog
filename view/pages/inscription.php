<?php

session_start();

// -------------------------------------------
// TRAITEMENT DE L'INSCRIPTION <<<<<<<<<<<<<<<
// -------------------------------------------

// Connexion à la base de donnée

require '../common/config.php';

// Checker si l'utilisateur est déjà connecté ou pas

if (isset($_SESSION['id'])) {

    // On redirige vers l'accueil

    header('Location:accueil.php');

}

?>

<!--Création du formulaire d'inscription-->

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.9.0/css/all.css" integrity="sha384-i1LQnF23gykqWXg6jxC2ZbCbUMxyw5gLZY6UiUS98LYV5unm8GWmfkIS6jqJfb4E" crossorigin="anonymous">
    <title>Innovatech- Inscription</title>
    <link rel="stylesheet" href="../../public/css/styles.css">
</head>
<body>
    
    <!-- HEADER -->

    <header class="header">

    <?php include ('../common/header.php'); ?>

    </header>

    <!-- MAIN -->

    <main class="main2">

        <div class="center">
            
            <h1>Inscription</h1>
            
            <form method="post">
                
                <div class="txt_field">
                    <input type="text" name="login" required autocomplete="off">
                    <span></span>
                    <label>Nom d'utilisateur</label>
                </div>

                <div class="txt_field">
                    <input type="email" name="email" required autocomplete="off">
                    <span></span>
                    <label>Adresse e-mail</label>
                </div>
              
                <div class="txt_field">
                    <input type="password" name="password" required autocomplete="off">
                    <span></span>
                    <label>Mot de passe</label>
                </div>

                <div class="txt_field">
                    <input type="password" name="cpassword" required autocomplete="off">
                    <span></span>
                    <label>Confirmation du mot de passe</label>
                </div>
            
                    <input type="submit" name="formsend" value="S'inscrire">
                    <div class="signup_link">
                    <p>Vous avez déjà un compte ?</p><br>
                     <a href="connexion.php">Connectez-vous ici.</a>

                    <?php

                    // Vérification si le formulaire a été envoyé
                    
                    if(isset($_POST) AND !empty($_POST) ) {
                    
                    // Empêcher les failles XSS
                    
                    $login = htmlspecialchars($_POST['login']);
                    $email = htmlspecialchars($_POST['email']);
                    
                    // Checker si le nom d'utilisateur existe
                    
                    $check_user = $db->prepare('SELECT login, email, password, id_droits FROM utilisateurs WHERE login = ?');
                    $check_user->execute(array($login));
                    $data_user = $check_user->fetch();
                    $row_user = $check_user->rowCount();
                    
                    // Si le nom d'utilisateur n'existe pas
                    
                    if ($row_user == 0) {
                    
                        // Checker si l'email existe
                    
                        $check_email = $db->prepare('SELECT login, email, password, id_droits FROM utilisateurs WHERE email = ?');
                        $check_email->execute(array($email));
                        $data_email = $check_email->fetch();
                        $row_email = $check_email->rowCount();
                    
                        // Si l'email n'existe pas
                    
                        if ($row_email == 0) {
                    
                            $password = htmlspecialchars($_POST['password']);
                            $cpassword = htmlspecialchars($_POST['cpassword']);
                    
                            // Si les deux mots de passe sont identiques
                        
                            if ($password == $cpassword) {
                    
                            // Hashage du mot de passe
                    
                            $cost= ['cost' => 12];
                            $password = password_hash($password, PASSWORD_BCRYPT, $cost);
                    
                            // Insertion des données entrées par l'utilisateur dans la table
                    
                            $insert = $db->prepare ('INSERT INTO utilisateurs(login, email, password, id_droits) VALUES (:login, :email, :password, 1)');
                            $insert->execute(array('login' => $login, 'email' => $email, 'password' => $password));
                    
                            // Si inscription réussie
                    
                            $_SESSION['id'] = $data_user['id'];
                    
                            // echo '<div class= "success_php">' ."L'inscription a été effectué avec succès." . '</br>' . "Vous pouvez vous connecter " . '<a style= "color: #337BD4" href="connexion.php">' . "ici" . '</a>' . '</div>';
                            header('Location:connexion.php' . $_SESSION['id']);
                            
                    
                            }
                    
                            else {
                    
                            // Si les mots de passes ne correspondent pas
                    
                            echo '<div class= "error2_php">' ."Les mots de passe ne sont pas identiques." . '</div>';
                    
                            }
                    
                        }
                    
                        else {
                    
                            // Si le login entré par l'utilisateur existe déjà dans la base de donnée
                            
                            echo '<div class= "error2_php">' ."L'e-mail est déjà utilisé." . '</div>';
                    
                        }
                    }
                    
                        else {
                    
                            // Si le login entré par l'utilisateur existe déjà dans la base de donnée
                            
                            echo '<div class= "error2_php">' ."Le nom d'utilisateur est déjà utilisé." . '</div>';
                    
                        }
                    
                        }
                    
                    
                    
                    ?>


                    </div>
            
            </form>

        </div>

    </main>

    <!-- FOOTER -->

    <footer>

    <?php include ('../common/footer.php'); ?>

    </footer>

</body>
</html>