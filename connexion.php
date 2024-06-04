<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Abstergo</title>
</head>
<body>

    <?php 
    // * Définition des variables pour la connexion a la DB.


    $servername = "localhost";
    $username = "root";
    $password = "";

    try {
        $bdd = new PDO("mysql:host=$servername;dbname=moduleconnexion", $username, $password);
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Connexion réussie";

    } catch (PDOException $e) {
        echo "Erreur : ".$e->getMessage();
    }

    $error_msg = '';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $login = $_POST['login'];
        $password = $_POST['password'];
        if ($login != "" && $password != "") {
            // ! connexion à la BDD
            $req = $bdd->query("SELECT * FROM utilisateurs WHERE login = '$login' AND password = '$password'");
            $rep = $req->fetch();
            if ($rep) {
                echo "Connexion réussie !";
            } else {
                $error_msg = "Email ou mot de passe incorrect !";
            }
        } else {
            $error_msg = "Veuillez remplir tous les champs.";
        }
    }
    ?>


<form method="POST" action="">
    <label for="">Login</label>
    <input required type="login" placeholder="Entrez votre login..." id="login" name="login">
    <br>
    <label for="">Mot de passe</label>
    <input required type="password" placeholder="Entrez votre mot de passe..." id="password" name="password">
    <br>
    <input type="submit" name="ok" value="Se connecter">
</form>

<?php 
if ($error_msg){
   ?>
   <p><?php echo $error_msg; ?></p>
   <?php
}
?>

<a href="./index.php">Index</a><br>
<a href="./inscription.php">Inscription</a><br>
<a href="./connexion.php">Connexion</a><br>
<a href="./admin.php">Admin</a><br>
<a href="./profil.php">Profil</a>
    
</body>
</html>
