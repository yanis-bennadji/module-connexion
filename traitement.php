<?php 

// * Définition des variables pour la connexion a la DB.


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
    $reponse = $requete->fetchAll(PDO::FETCH_ASSOC);
    echo "Inscription réussie.";
    $error = '';
    $ok = '';
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p>test</p>
    
</body>
</html>