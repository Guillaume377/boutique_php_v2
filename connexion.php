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

<body>
    <?php
    include 'header.php';
    ?>

    <?php

    if (isset($_POST['nom'])) {
    }


    //var_dump($_POST);
    //var_dump(checkInputsLenght())

    

    ?>


    <?php
    include 'footer.php';
    ?>