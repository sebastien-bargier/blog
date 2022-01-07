<?php
session_start();

$msg['login'] = "";
$msg['email'] = "";
$msg['pwd'] = "";
$msg['c-pwd'] = "";

// CONNEXION BDD
$db = new PDO('mysql:host=localhost;dbname=blog','root', '');

// RECUPERE LES INFORMATIONS UTILISATEUR DE LA SESSION
$req = $db->prepare("SELECT * FROM utilisateurs WHERE login = '".$_SESSION['login']."' ");
$req->execute();
$userSession = $req->fetchAll(PDO::FETCH_ASSOC);

if(isset($_POST['mod']) && isset($_POST['mod']) == 'Modifier') {

    $login = htmlentities(trim($_POST['login']));
    $email = htmlentities(trim($_POST['email']));
    $pwd = password_hash(trim($_POST['password']), PASSWORD_ARGON2ID);
    $confirmPwd = htmlentities(trim($_POST['confirm-password']));

    $req = $db->prepare("SELECT login FROM utilisateurs WHERE login = :login");
    $req->execute(array('login' => $login));
    $result = $req->fetchAll(PDO::FETCH_ASSOC);

    var_dump($result);

    //var_dump($_SESSION['login']);

    if(($result) && $login != $_SESSION['login']) {
        $msg['login'] = "Ce login est déjà utilisé.";

    } else {
        if ($_POST["password"] == $_POST["confirm-password"]) {
            // METTRE A JOUR INFORMATION UTILISATEUR EN BDD
            $req = $db->prepare("UPDATE utilisateurs
                                SET login = :login,
                                email = :email,
                                password = :password
                                WHERE login = '".$_SESSION['login']."' ");
            $updateUser = $req->execute(array(
                'login' => $login,
                'email' => $email,
                'password' => $pwd
            ));
            
            $_SESSION['login'] = $login;

            header('Location: profil.php');
        } else {
            $msg['pwd'] = "Les mots de passe ne correspondent pas";
        }
    }
}


?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../public/css/style.css" />
    <title>Profil</title>
</head>
<body>

<header>
    <?php require '../common/header.php'; ?>
</header>

<main>
    <form action='#' method='POST'>

    <h1>Mon profil</h1>

    <br />

    <label for="login">Login</label>
    <input type="text" name="login" value="<?= $userSession[0]['login']; ?>">
    <p class="error"><?= $msg['login'] ?></p>

    <label for="email">Email</label>
    <input type="email" name="email" value="<?= $userSession[0]['email']; ?>">
    <p class="error"><?= $msg['email'] ?></p>

    <label for="password">Password</label>
    <input type="password" name="password">
    <p class="error"><?= $msg['pwd'] ?></p>

    <label for="confirm-password">Confirm password</label>
    <input type="password" name="confirm-password">
    <p class="error"><?= $msg['c-pwd'] ?></p>

    <input type="submit" class="btn" name="mod" value="Modifier"></input>
    </form>
<main>

<footer>
    <?php require '../common/footer.php'; ?>
</footer>

</body>
</html>