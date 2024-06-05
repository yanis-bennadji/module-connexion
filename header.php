<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mon Site</title>
    <style>
        /* Styles de base pour les boutons */
        .header-button {
            padding: 10px 20px;
            margin: 5px;
            text-decoration: none;
            background-color: #007BFF;
            color: white;
            border-radius: 5px;
        }
        .header-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <a class="header-button" href="index.php">Accueil</a>
            <?php if (isset($_SESSION['user_id'])): ?>
                <a class="header-button" href="profil.php">Profil</a>
                <a class="header-button" href="deconnect.php">Déconnexion</a>
                <?php if ($_SESSION['user_id'] == 1):?>
                    <a class="header-button" href="admin.php">Administration</a>
                <?php endif; ?>
            <?php else: ?>
                <a class="header-button" href="connexion.php">Se connecter</a>
                <a class="header-button" href="inscription.php">Créer un compte</a>
            <?php endif; ?>
        </nav>
    </header>
</body>
</html>
