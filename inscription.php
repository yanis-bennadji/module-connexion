<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejoignez-nous</title>
    <link rel="stylesheet" href="./styles.css">
</head>
<body>

<!-- //! Formulaire d'inscription !  -->

<form method="POST" action="traitement.php">
    <label for="nom">Votre login*</label>
    <input required type="text" id="login" name="login" placeholder="Entrez votre login...">
    <br>
    <label for="nom">Votre prénom*</label>
    <input required type="text" id="prenom" name="prenom" placeholder="Entrez votre prénom...">
    <br>
    <label for="nom">Votre nom*</label>
    <input required type="text" id="nom" name="nom" placeholder="Entrez votre nom..." >
    <br>
    <label for="nom">Votre mot de passe*</label>
    <input required type="password" id="password" name="password" placeholder="Entrez votre mot de passe...">
    <br>
    <label for="confirm_password">Confirmez votre mot de passe*</label>
    <input required type="password" id="password" name="confirm_password">
    <br>
    <input type="submit" value="M'inscrire" name="ok">

</form>



    
</body>
</html>