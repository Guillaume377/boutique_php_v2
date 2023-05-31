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

    <main>
    <h1>Panier</h1>
    <?php
    // *****************************************si je viens d'un bouton d'ajout : je déclenche l'ajout***********************************
    if (isset($_GET['productId'])){


        // 1) je vais récupérer l'id transmis par le formulaire en GET
        $productId = $_GET['productId'];
        //var_dump($productId); // je teste ma variable

        //2) je vais récupérer le produit qui correspond à cet id
        $article = getArticleFromId($productId);
        //var_dump($article); // je teste ma variable
        
        // 3) ajouter l'article au panier et tester le panier
        addToCart($article);

        var_dump($_SESSION);
    }

        ?>
    </main>

    <?php
    include 'footer.php';
    ?>





