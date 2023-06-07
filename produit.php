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

        <?php
        // 1) je vais récupérer l'id transmis par le formulaire en GET
        $productId = $_GET['productId'];
        //var_dump($productId); // je teste ma variable

        //2) je vais récupérer le produit qui correspond à cet id
        $article = getArticleFromId($productId);
        //var_dump($article); // je teste ma variable

        // 3) afficher ses infos
        ?>

        <div class="text-center">
            <h1><?= $article['nom'] ?></h1>
        </div>

        <div class="card mb-3">
            <img src="./images/<?= $article['image'] ?>" class="card-img-top mx-auto" alt="...">
            <div class="card-body">
                <h5 class="card-title"><?= $article['nom'] ?></h5>
                <h5 class="card-title"><?= $article['prix'] ?> €</h5>
                <p class="card-text"><?= $article['description'] ?></p>
                <p class="card-text"><small class="text-body-secondary"><?= $article['description_detaillee'] ?></small></p>
            </div>
            <form method="GET" action="panier.php">
                <input type="hidden" name="productId" value=<?= $article['id'] ?>>
                <input type="submit" class="btn btn-ghost-2" value="Ajout panier">
            </form>
        </div>




    </main>

    <?php
    include 'footer.php';
    ?>