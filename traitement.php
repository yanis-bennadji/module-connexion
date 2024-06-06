<?php 
session_start();

// * Définition des variables pour la connexion à la DB.
$servername = "localhost";
$username = "root";
$password = "";

try {
    $bdd = new PDO("mysql:host=$servername;dbname=moduleconnexion", $username, $password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    echo "Erreur : ".$e->getMessage();
}

// * Récupération des valeurs depuis la page inscription.php.
if(isset($_POST['ok'])) {
    $login = $_POST['login'];
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $mdp = $_POST['password'];
   
    // * Insertion des valeurs de inscription.php dans la DB.
    $requete = $bdd->prepare("INSERT INTO utilisateurs VALUES (0, :login, :prenom, :nom, :mdp)");
    $requete->execute(
        array(
            "login" => $login,
            "prenom" => $prenom,
            "nom" => $nom,
            "mdp" => $mdp,
        )    
    );

    // * Stocker un message de confirmation dans la session
    $_SESSION['message'] = 'Bienvenue chez les templiers.';
    $_SESSION['message_type'] = 'success';

    // * Rediriger vers l'index
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./style.css">
    <link rel="icon" href="./image/logo-animus.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

    <?php include ('header.php'); ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>    

</body>
</html>
