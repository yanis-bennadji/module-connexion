<?php 
session_start(); // * Démarrage de la session

// * Définition des variables pour la connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";

try {
    // * Connexion à la base de données avec PDO
    $bdd = new PDO("mysql:host=$servername;dbname=moduleconnexion", $username, $password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // ! En cas d'erreur de connexion, afficher le message d'erreur
    echo "Erreur : " . $e->getMessage();
}

if (isset($_POST['ok'])) {
    // * Récupération des valeurs du formulaire d'inscription
    $login = $_POST['login'];
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $mdp = $_POST['password'];
    
    // ? Vérification si le login existe déjà
    $requete = $bdd->prepare("SELECT * FROM utilisateurs WHERE login = :login");
    $requete->execute(['login' => $login]);
    $user = $requete->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // ! Si le login existe déjà, afficher un message d'erreur et rediriger vers la page d'inscription
        $_SESSION['message'] = 'Login déjà utilisé. Veuillez en choisir un autre.';
        $_SESSION['message_type'] = 'danger';
        header("Location: inscription.php");
        exit();
    } else {
        // * Insertion des valeurs dans la base de données
        $requete = $bdd->prepare("INSERT INTO utilisateurs VALUES (0, :login, :prenom, :nom, :mdp)");
        $requete->execute([
            'login' => $login,
            'prenom' => $prenom,
            'nom' => $nom,
            'mdp' => $mdp
        ]);

        // * Affichage d'un message de succès et redirection vers la page d'accueil
        $_SESSION['message'] = 'Inscription réussie.';
        $_SESSION['message_type'] = 'success';
        header("Location: index.php");
        exit();
    }
} else {
    // ! Si la requête POST n'est pas envoyée, rediriger vers le formulaire d'inscription
    header("Location: inscription.php");
    exit();
}
?>

