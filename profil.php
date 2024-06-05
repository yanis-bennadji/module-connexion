<?php
//* Inclusion du Header + démarrage de la session
session_start();
include('header.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: connexion.php');
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

$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_login = $_POST['login'];
    $new_prenom = $_POST['prenom'];
    $new_nom = $_POST['nom'];
    $new_mdp = !empty($_POST['password']) ? $_POST['password'] : $user['password'];

    $update_stmt = $pdo->prepare("UPDATE utilisateurs SET login = ?, prenom = ?, nom = ?, password = ? WHERE id = ?");
    $update_result = $update_stmt->execute([$new_login, $new_prenom, $new_nom, $new_mdp, $user_id]);

    if ($update_result) {
        echo "Profil mis à jour avec succès!";
        $stmt->execute([$user_id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        echo "Erreur lors de la mise à jour du profil.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Modifier le Profil</title>
</head>
<body>
<h2>Modifier le Profil</h2>
<form method="post" action="profil.php">
    <label for="login">Login:</label>
    <input type="text" id="login" name="login" value="<?php echo htmlspecialchars($user['login']); ?>" required><br>
    
    <label for="prenom">Prénom:</label>
    <input type="text" id="prenom" name="prenom" value="<?php echo htmlspecialchars($user['prenom']); ?>" required><br>
    
    <label for="nom">Nom:</label>
    <input type="text" id="nom" name="nom" value="<?php echo htmlspecialchars($user['nom']); ?>" required><br>
    
    <label for="password">Mot de passe (laisser vide si inchangé):</label>
    <input type="password" id="password" name="password"><br>
    
    <input type="submit" value="Mettre à jour">
</form>
</body>
</html>
