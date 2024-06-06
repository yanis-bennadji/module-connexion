

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejoignez-nous</title>
    <link rel="stylesheet" href="./style.css">
    <link rel="icon" href="./image/logo-animus.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

<?php include('header.php');
 ?>

<!-- //! Formulaire d'inscription !  -->

<form method="POST" action="traitement.php" class="form-container">
    <label for="login" class="form-label">Votre login*</label>
    <input required type="text" id="login" name="login" placeholder="Entrez votre login..." class="form-control">
    <br>
    <label for="prenom" class="form-label">Votre prénom*</label>
    <input required type="text" id="prenom" name="prenom" placeholder="Entrez votre prénom..." class="form-control">
    <br>
    <label for="nom" class="form-label">Votre nom*</label>
    <input required type="text" id="nom" name="nom" placeholder="Entrez votre nom..." class="form-control">
    <br>
    <label for="password" class="form-label">Votre mot de passe*</label>
    <input required type="password" id="password" name="password" placeholder="Entrez votre mot de passe..." class="form-control">
    <br>
    <label for="confirm_password" class="form-label">Confirmez votre mot de passe*</label>
    <input required type="password" id="confirm_password" name="confirm_password" placeholder="Confirmez votre mot de passe..." class="form-control">
    <br>
    <input type="submit" value="M'inscrire" name="ok" class="btn btn-dark btn-lg">
</form>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>    


    
</body>
</html>