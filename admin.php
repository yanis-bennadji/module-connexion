<?php
// ! Première version du module de connexion

session_start(); // * Démarrage de la session
include('header.php'); // * Inclusion du header

// ! Vérification que l'utilisateur est bien "admin"
if (!isset($_SESSION['user_id']) || $_SESSION['user_id'] != 1) {
    header('Location: index.php'); // ! Redirection vers la page d'accueil si l'utilisateur n'est pas admin
    exit();
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

// * Récupération des informations des utilisateurs
$stmt = $pdo->prepare("SELECT id, login, prenom, nom, password FROM utilisateurs");
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'administration</title>
    <link rel="stylesheet" href="./style.css">
    <link rel="icon" href="./image/logo-animus.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

<div class="container mt-5">
    <h2 class="title text-center">Page d'administration</h2>
    <table class="table table-light table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Login</th>
                <th>Prénom</th>
                <th>Nom</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo htmlspecialchars($user['id']); ?></td>
                <td><?php echo htmlspecialchars($user['login']); ?></td>
                <td><?php echo htmlspecialchars($user['prenom']); ?></td>
                <td><?php echo htmlspecialchars($user['nom']); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"></script>
</body>
</html>
