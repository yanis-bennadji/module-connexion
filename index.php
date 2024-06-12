<?php
// ! Première version du module de connexion
session_start(); // * Démarrage de la session
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abstergo Industries</title>
    <link rel="stylesheet" href="./style.css"> <!-- * Inclusion du fichier CSS -->
    <link rel="icon" href="./image/logo-animus.png"> <!-- * Favicon -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <?php include('_Header.php'); // * Inclusion du header ?>

    <div class="container mt-5">
        <h1 class="title text-center">Bienvenue chez Abstergo Industries</h1>
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
        <div class="intro mt-5">
            <!-- //* Introduction d'Abstergo Industries -->
            <p class="lead">Fondée en 1937, Abstergo Industries est une société internationale de pointe, spécialisée dans les technologies de l'information et la recherche scientifique. Nous innovons pour un avenir meilleur, en explorant les limites de l'humanité et en transformant les découvertes en opportunités tangibles.</p>
            <p class="lead">Notre mission est de vous fournir les outils et les connaissances nécessaires pour atteindre votre plein potentiel. Rejoignez-nous dans notre quête pour un avenir meilleur.</p>
        </div>
        <div class="logo mt-5 text-center">
            <img src="./image/logo-abstergo2.png" alt="Logo Abstergo" class="logo-animation"> <!-- * Logo avec animation -->
        </div>
        <br><br><br>
        <div class="section mt-5">
            <h2 class="section-title">Pourquoi nous rejoindre</h2>
            <!-- //* Section expliquant les raisons de rejoindre Abstergo Industries -->
            <p class="lead">Chez Abstergo Industries, nous croyons en l'amélioration continue de l'humanité. Nous œuvrons pour des causes nobles, telles que l'avancement de la science, la technologie et l'éducation. En rejoignant notre équipe, vous faites partie d'une organisation qui valorise l'innovation, l'intégrité et l'engagement pour un avenir meilleur.</p>
            <p class="lead">Nous offrons à nos employés un environnement de travail stimulant et collaboratif, des opportunités de croissance professionnelle et la chance de contribuer à des projets qui ont un impact mondial.</p>
        </div>

        <div class="section mt-5">
            <h2 class="section-title">Projet Animus</h2>
            <!-- //* Section présentant le projet Animus -->
            <p class="lead">Le projet Animus est au cœur de notre recherche sur les mémoires génétiques. Grâce à cette technologie révolutionnaire, nous sommes capables d'explorer les souvenirs de nos ancêtres et de découvrir des vérités cachées sur notre histoire. Cette innovation ouvre des perspectives inédites dans le domaine de la science historique et de la connaissance de soi.</p>
            <p class="lead">Rejoignez-nous dans cette aventure passionnante et participez à la découverte de notre passé pour mieux comprendre notre présent et façonner notre avenir.</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"></script>
</body>
</html>
