<?php
//inclure le fichier des fonctions pour pouvoir les appeler ici
include 'functions.php';

// initialiser la session et accéder à la superglobal $_SESSION (tableau associatif)
session_start();

// J'initialise le panier
createCart();

//inclure le head avec les balises de base + la balise head (pour ne pas répéter le code qu'il contient)
include 'head.php';
?>

<h1>Inscription</h1>

<form action="connexion.php" method="post">
    <label for="nom">Nom :</label>
    <input type="text" name="nom" id="nom" required><br><br>

    <label for="prenom">Prénom :</label>
    <input type="text" name="prenom" id="prenom" required><br><br>

    <label for="email">Email :</label>
    <input type="email" name="email" id="email" required><br><br>

    <label for="motdepasse">Mot de passe :</label>
    <input type="password" name="motdepasse" id="motdepasse" required><br><br>

    <label for="adresse">Adresse :</label>
    <input type="text" name="adresse" id="adresse" required><br><br>

    <label for="codepostal">Code postal :</label>
    <input type="text" name="codepostal" id="codepostal" required><br><br>

    <label for="ville">Ville :</label>
    <input type="text" name="ville" id="ville" required><br><br>

    <input type="submit inscription" value="S'inscrire">
</form>


























?>