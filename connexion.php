<?php
// ! Première version du module de connexion
session_start(); // * Démarrage de la session

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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // * Récupération des valeurs du formulaire de connexion
    $login = $_POST['login'];
    $mdp = $_POST['password'];

    // ? Vérification des informations de l'utilisateur
    $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE login = ?");
    $stmt->execute([$login]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && $mdp === $user['password']) {
        // * Connexion réussie, stockage de l'ID utilisateur dans la session et redirection vers la page d'accueil
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['message'] = 'Connexion réussie.';
        $_SESSION['message_type'] = 'success';
        header('Location: index.php');
        exit();
    } else {
        // ! Login ou mot de passe incorrect, affichage d'un message d'erreur et redirection vers la page de connexion
        $_SESSION['message'] = 'Login ou mot de passe incorrect.';
        $_SESSION['message_type'] = 'danger';
        header('Location: connexion.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="./style.css">
    <link rel="icon" href="./image/logo-animus.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

<?php include('header.php'); // * Inclusion du header ?>

<div class="container mt-5">
    <h1 class="title text-center">Connexion</h1>
    <?php
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
        <form method="post" action="connexion.php" class="needs-validation" novalidate>
            <div class="mb-3">
                <label for="login" class="form-label">Login:</label>
                <input type="text" id="login" name="login" required class="form-control" placeholder="Entrez votre login...">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe:</label>
                <input type="password" id="password" name="password" required class="form-control" placeholder="Entrez votre mot de passe...">
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-dark btn-lg">Se connecter</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"></script>    

</body>
</html>
