<?php
// ! Première version du module de connexion
session_start(); // * Démarrage de la session
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejoignez-nous</title>
    <link rel="stylesheet" href="./style.css"> <!-- * Inclusion du fichier CSS -->
    <link rel="icon" href="./image/logo-animus.png"> <!-- * Favicon -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

<?php include('_Header.php'); // * Inclusion du header ?>

<div class="container mt-5">
    <h1 class="title text-center">Rejoignez Abstergo Industries</h1>
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
        <form method="POST" action="traitement.php" class="needs-validation" novalidate>
            <div class="mb-3">
                <label for="login" class="form-label">Votre login*</label>
                <input type="text" class="form-control" id="login" name="login" placeholder="Entrez votre login..." required>
            </div>
            <div class="mb-3">
                <label for="prenom" class="form-label">Votre prénom*</label>
                <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Entrez votre prénom..." required>
            </div>
            <div class="mb-3">
                <label for="nom" class="form-label">Votre nom*</label>
                <input type="text" class="form-control" id="nom" name="nom" placeholder="Entrez votre nom..." required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Votre mot de passe*</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Entrez votre mot de passe..." required>
            </div>
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirmez votre mot de passe*</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirmez votre mot de passe..." required>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-dark btn-lg" name="ok">M'inscrire</button> <!-- * Bouton de soumission -->
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"></script>    
</body>
</html>
