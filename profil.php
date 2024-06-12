<?php
// ! Première version du module de connexion
//* Inclusion du Header + démarrage de la session
session_start(); // * Démarrage de la session
include('_Header.php'); // * Inclusion du header

// ! Vérification que l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: connexion.php'); // ! Redirection vers la page de connexion si l'utilisateur n'est pas connecté
    exit();
}

require_once('_BDD.php');

// * Récupération des informations de l'utilisateur connecté
$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // * Récupération des nouvelles valeurs du formulaire de modification du profil
    $new_login = $_POST['login'];
    $new_prenom = $_POST['prenom'];
    $new_nom = $_POST['nom'];
    $new_mdp = !empty($_POST['password']) ? $_POST['password'] : $user['password'];

    // * Mise à jour des informations de l'utilisateur dans la base de données
    $update_stmt = $pdo->prepare("UPDATE utilisateurs SET login = ?, prenom = ?, nom = ?, password = ? WHERE id = ?");
    $update_result = $update_stmt->execute([$new_login, $new_prenom, $new_nom, $new_mdp, $user_id]);

    if ($update_result) {
        // * Récupération des nouvelles informations de l'utilisateur après mise à jour
        $stmt->execute([$user_id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $_SESSION['message'] = 'Profil mis à jour avec succès.';
        $_SESSION['message_type'] = 'success';
    } else {
        // ! Affichage d'un message d'erreur en cas d'échec de la mise à jour
        $_SESSION['message'] = 'Erreur lors de la mise à jour du profil.';
        $_SESSION['message_type'] = 'danger';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Modifier le Profil</title>
    <link rel="stylesheet" href="./style.css"> <!-- //* Inclusion du fichier CSS -->
    <link rel="icon" href="./image/logo-animus.png"> <!-- //* Favicon -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

<div class="container mt-5">
    <h1 class="title text-center">Modifier le profil</h1>
    <?php
    // * Affichage des messages de session s'ils existent
    if (isset($_SESSION['message'])) {
        echo '<div class="alert alert-' . $_SESSION['message_type'] . ' alert-dismissible fade show" role="alert">';
        echo $_SESSION['message'];
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        echo '</div>';
        unset($_SESSION['message']);
        unset($_SESSION['message_type']);
    }
    ?>
    <div class="form-container mt-4">
        <form method="post" action="profil.php" class="needs-validation" novalidate>
            <div class="mb-3">
                <label for="login" class="form-label">Login:</label>
                <input type="text" id="login" name="login" value="<?php echo htmlspecialchars($user['login']); ?>" required class="form-control" placeholder="Entrez votre login...">
            </div>
            <div class="mb-3">
                <label for="prenom" class="form-label">Prénom:</label>
                <input type="text" id="prenom" name="prenom" value="<?php echo htmlspecialchars($user['prenom']); ?>" required class="form-control" placeholder="Entrez votre prénom...">
            </div>
            <div class="mb-3">
                <label for="nom" class="form-label">Nom:</label>
                <input type="text" id="nom" name="nom" value="<?php echo htmlspecialchars($user['nom']); ?>" required class="form-control" placeholder="Entrez votre nom...">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe (laisser vide si inchangé):</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Entrez votre mot de passe...">
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-dark btn-lg">Mettre à jour</button> <!-- //* Bouton de validation -->
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"></script>    
</body>
</html>
