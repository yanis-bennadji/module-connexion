<?php
session_start();
include('header.php');

// Vérification que l'utilisateur est bien "admin"
if (!isset($_SESSION['user_id']) || $_SESSION['user_id'] != 1) {
    header('Location: index.php');
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "moduleconnexion";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données: " . $e->getMessage());
}

// Récupération des informations des utilisateurs
$stmt = $pdo->prepare("SELECT id, login, prenom, nom, password FROM utilisateurs");
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Administration</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
<h2>Page d’administration</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Login</th>
        <th>Prénom</th>
        <th>Nom</th>
    </tr>
    <?php foreach ($users as $user): ?>
    <tr>
        <td><?php echo htmlspecialchars($user['id']); ?></td>
        <td><?php echo htmlspecialchars($user['login']); ?></td>
        <td><?php echo htmlspecialchars($user['prenom']); ?></td>
        <td><?php echo htmlspecialchars($user['nom']); ?></td>
    </tr>
    <?php endforeach; ?>
</table>
</body>
</html>
