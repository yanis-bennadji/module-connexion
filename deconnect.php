<?php
// Démarrage de la session
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
</head>
<body>
    <header>

    <?php 
    // Affichage du bouton de déconnexion si l'utilisateur est connecté
    if (isset($_SESSION['login'])) {
        echo '<form method="POST" action="logout.php" style="display:inline;">
            <input type="submit" value="Déconnexion">
            </form>';
            }
            ?>
        
    </header>
</body>
</html>
