<?php 

$servername = "localhost";
$username = "root";
$password = "";

try {
    $bdd = new PDO("mysql:host=$servername;dbname=moduleconnexion", $username, $password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    echo "Erreur : ".$e->getMessage();
}


if(isset($_POST['ok'])) {
    $login = $_POST['login'];
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $mdp = $_POST['password'];
   

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
}
?>