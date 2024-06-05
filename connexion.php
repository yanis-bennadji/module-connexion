<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Abstergo</title>
</head>
<body>

    

    <?php 
    // Démarrage de la session
    


    // Définition des variables pour la connexion à la DB.
    $servername = "localhost";
    $username = "root";
    $password = "";

    try {
        $bdd = new PDO("mysql:host=$servername;dbname=moduleconnexion", $username, $password);
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Erreur : ".$e->getMessage();
    }

    $error_msg = '';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $login = $_POST['login'];
        $password = $_POST['password'];
        if ($login != "" && $password != "") {
            // Connexion à la BDD
            $req = $bdd->query("SELECT * FROM utilisateurs WHERE login = '$login' AND password = '$password'");
            $rep = $req->fetch();
            if ($rep) {
                // Connexion réussie, création des variables de session
                $_SESSION['user_id'] = $rep['id'];
                $_SESSION['login'] = $rep['login'];
                echo "Connexion réussie !";
            } else {
                $error_msg = "Login ou mot de passe incorrect !";
            }
        } else {
            $error_msg = "Veuillez remplir tous les champs.";
        }
    }
    ?>

    <form method="POST" action="">
        <label for="login">Login</label>
        <input required type="text" placeholder="Entrez votre login..." id="login" name="login">
        <br>
        <label for="password">Mot de passe</label>
        <input required type="password" placeholder="Entrez votre mot de passe..." id="password" name="password">
        <br>
        <input type="submit" name="ok" value="Se connecter">
    </form>

    <?php 
    if ($error_msg){
        echo "<p>$error_msg</p>";
    }
    ?>

<?php include 'deconnect.php'; ?>

</body>
</html>
