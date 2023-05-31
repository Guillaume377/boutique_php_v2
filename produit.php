<?php
//inclure le fichier des fonctions pour pouvoir les appeler ici
include 'functions.php';

session_start();

//inclure le head avec les balises de base + la balise head (pour ne pas répéter le code qu'il contient)
include 'head.php';

?>

<body>
    <?php
    include 'header.php';
    ?>

    <main>
    <h1>Produit</h1>
        <?php
        // 1) je vais récupérer l'id transmis par le formulaire en GET
        $productId = $_GET['productId'];
        //var_dump($productId); // je teste ma variable

        //2) je vais récupérer le produit qui correspond à cet id
        $article = getArticleFromId($productId);
        //var_dump($article); // je teste ma variable
        
        // 3) afficher ses infos
        ?>

        <div class="card mb-3">
            <img src="./images/<?= $article['picture']?>" class="card-img-top w-50 mx-auto" alt="...">
            <div class="card-body">
                <h5 class="card-title"><?= $article['name']?></h5>
                <h5 class="card-title"><?= $article['price']?> €</h5>
                <p class="card-text"><?= $article['description']?>"</p>
                <p class="card-text"><small class="text-body-secondary"><?=$article['detailedDescription']?></small></p>
            </div>
        </div>



        
    </main>

    <?php
    include 'footer.php';
    ?>





