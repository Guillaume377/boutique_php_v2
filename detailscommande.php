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
            <h1>Détails de ma commande</h1>
        </div>


























        
    </main>
        <?php
    include 'footer.php';
    ?>