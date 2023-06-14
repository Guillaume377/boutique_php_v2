<?php
//inclure le fichier des fonctions pour pouvoir les appeler ici
include 'functions.php';

// initialiser la session et accéder à la superglobal $_SESSION (tableau associatif)
session_start();

// initialiser le panier
createCart();
//var_dump($_SESSION);

//inclure le head avec les balises de base + la balise head (pour ne pas répéter le code qu'il contient)
include 'head.php';

?>

<body>
    <?php
    include 'header.php';
    ?>
    <main>

    <div class="boutique">
            <h1>Mon mot de passe</h1>
        </div>

        <div class="container d-flex justify-content-between">
            <div class="row text-center col-md-4 p-5">
                <i class="logo-font fa-solid fa-user" style="color: #B8860B;"></i>
                <a href="./modifinfos.php" class="button-infos navbar-brand btn btn-ghost-2">Modifier mes informations</a>
            </div>

            <div class="row text-center col-md-4 p-5">
                <i class="logo-font fa-solid fa-house" style="color: #B8860B;"></i>
                <a href="./modifadresse.php" class="button-infos navbar-brand btn btn-ghost-2">Modifier mon adresse</a>
            </div>

            <div class="row text-center col-md-4 p-5">
                <i class="logo-font fa-solid fa-rectangle-list" style="color: #B8860B;"></i>
                <a href="./commande.php" class="button-infos navbar-brand btn btn-ghost-2">Modifier mes commandes</a>
            </div>
        </div>

    </main>

    <?php
    include 'footer.php';
    ?>