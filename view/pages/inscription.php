<?php
session_start();

$msg['login'] = '';
$msg['email'] = '';
$msg['pwd'] = '';
$msg['c-pwd'] = '';

if(isset($_POST["in"]) && $_POST["in"] == "S'inscrire") {

    $login = htmlentities(trim($_POST['login']));
    $email = htmlentities(trim($_POST['email']));
    $pwd = password_hash(trim($_POST['password']), PASSWORD_ARGON2ID);

    $db = new PDO('mysql:host=localhost;dbname=blog','root', '');
    $requete = $db->prepare("SELECT * FROM utilisateurs WHERE login = :login");
    $requete->execute(array('login' => $login));
    //$result = $req->fetch(PDO::FETCH_ASSOC);
    $rowLogin = $requete->rowCount();
   
    if($rowLogin != 0) {
        $msg['login'] = "Ce login existe déjà";

    } else if(!empty($_POST['login']) && !empty($_POST['email']) &&
    !empty($_POST['password']) && !empty($_POST['confirm-password'])) {

        if ($_POST["password"] == $_POST["confirm-password"]) {
            
            $req = $db->prepare("INSERT INTO utilisateurs(login,email,password) VALUES(:login,:email,:password)");
            $req->execute(array(
                'login' => $login,
                'email' => $email,
                'password' => $pwd
            ));
        
            header('Location: connexion.php');
        } else {
            $msg['pwd'] = "Les mots de passe ne correspondent pas!";
        }

    } else {
        
        if(empty($_POST['login'])) {
            $msg['login'] = "Veuillez entrer un login.";
        }
    
        if(empty($_POST['email'])) {
            $msg['email'] = "Veuillez entrer un prenom.";
        }
    
        if(empty($_POST['password'])) {
            $msg['pwd'] = "Veuillez entrer un mot de passe.";
        }
    
        if(empty($_POST['confirm-password'])) {
            $msg['c-pwd'] = "Veuillez entrer la confirmation du mot de passe.";
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
    <title>Inscription</title>
</head>
<body>

<header>
    <?php require '../common/header.php'; ?>
</header>

<main>
    <form action="" method="POST">
        
        <h1>Inscription</h1>

        <br />

        <label for="login">Login :</label>
        <input type="text" name="login" value="<?php if(isset($_POST['in'])) {echo $login;} ?>">
        <p class="error"><?= $msg['login'] ?></p>


        <label for="email">Email :</label>
        <input type="email" name="email"  value="<?php if(isset($_POST['in'])) {echo $email;} ?>">
        <p class="error"><?= $msg['email'] ?></p>

        <label for="password">Password :</label>
        <input type="password" name="password">
        <p class="error"><?= $msg['pwd'] ?></p>

        <label for="confirm-password">Confirm password :</label>
        <input type="password" name="confirm-password">
        <p class="error"><?= $msg['c-pwd'] ?></p>

        <input type="submit" class="btn" name="in" value="S'inscrire"></input>
    </form>
<main>

<footer>
    <?php require '../common/footer.php'; ?>
</footer>

</body>
</html>
