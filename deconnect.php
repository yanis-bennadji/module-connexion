<?php
//! Première version du module de connexion
session_start();

//* Stocker un message de confirmation dans la session
$_SESSION['message'] = 'Déconnexion réussie.';
$_SESSION['message_type'] = 'danger';

//* Détruire la session après avoir stocké le message
session_unset();
session_destroy();

//* Redémarrer la session pour stocker le message
session_start();
$_SESSION['message'] = 'Déconnexion réussie.';
$_SESSION['message_type'] = 'danger';

//* Rediriger vers l'index
header('Location: index.php');
exit();
?>
