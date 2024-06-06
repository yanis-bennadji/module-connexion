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
    <link rel="stylesheet" href="./style.css">
    <link rel="icon" href="./image/logo-animus.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<h2>Modifier le Profil</h2>
<form method="post" action="profil.php" class="form-container">
    <label for="login" class="form-label">Login:</label>
    <input type="text" id="login" name="login" value="<?php echo htmlspecialchars($user['login']); ?>" required class="form-control"><br>
    
    <label for="prenom" class="form-label">Prénom:</label>
    <input type="text" id="prenom" name="prenom" value="<?php echo htmlspecialchars($user['prenom']); ?>" required class="form-control"><br>
    
    <label for="nom" class="form-label">Nom:</label>
    <input type="text" id="nom" name="nom" value="<?php echo htmlspecialchars($user['nom']); ?>" required class="form-control"><br>
    
    <label for="password" class="form-label">Mot de passe (laisser vide si inchangé):</label>
    <input type="password" id="password" name="password" class="form-control"><br>
    
    <input type="submit" value="Mettre à jour" class="btn btn-dark btn-lg">
</form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>    
</body>
</html>
