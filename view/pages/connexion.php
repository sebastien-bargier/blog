<?php

session_start();

$msg['login'] = '';
$msg['pwd'] = '';

if(isset($_POST['co']) && $_POST['co'] == 'Se connecter') {

    $login = htmlentities(trim($_POST['login']));

    if(empty($login)) {
        $msg['login'] = "Veuillez entrer votre login";
    }

    if(empty($_POST['password'])) {
        $msg['pwd'] = "Vueillez entrer votre mot de passe";
    }

    if(!empty($login) && !empty($_POST['password'])) {

        $db = new PDO('mysql:host=localhost;dbname=blog','root', '');
        $req = $db->prepare("SELECT * FROM utilisateurs WHERE login = :login");
        $req->execute(array('login' => $login));
        $user = $req->fetchAll(PDO::FETCH_ASSOC);
        
        if(count($user)) {
            if(password_verify($_POST['password'], $user[0]['password'])){

                $_SESSION['login'] = $user[0]['login'];
                $_SESSION['id'] = $user[0]['id'];
                
                header('Location: accueil.php');
                
            } else {
                $msg['pwd']= "Le mot de passe est incorrect.";
            }

        } else {
            $msg['login'] = "Le login est inconnu";
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
    <title>Connexion</title>
</head>
<body>

<header>
    <?php require '../common/header.php'; ?>
</header>

<main>
    <form action='' method='post'>
        
        <h1>Connexion</h1>

        <br />

        <label for="login">Login</label>
        <input type="text" name="login" value="<?php if(isset($_POST['co'])) {echo $login;} ?>">
        <p class="error"><?= $msg['login'] ?></p>

        <label for="password">Password</label>
        <input type="password" name="password">
        <p class="error"><?= $msg['pwd'] ?></p>

        <input type="submit" class="btn" name="co" value="Se connecter"></input>
    </form>
<main>

<footer>
    <?php require '../common/footer.php'; ?>
</footer>

</body>
</html>
