<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// * Définition des variables pour la connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "moduleconnexion";

try {
    // * Connexion à la base de données avec PDO
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // ! En cas d'erreur de connexion, afficher le message d'erreur
    die("Erreur de connexion à la base de données: " . $e->getMessage());
}

?>