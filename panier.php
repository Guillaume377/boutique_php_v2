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
        if (isset($_GET['productId'])) {


            // 1) je vais récupérer l'id transmis par le formulaire en GET
            $productId = $_GET['productId'];
            //var_dump($productId); // je teste ma variable

            //2) je vais récupérer le produit qui correspond à cet id
            $article = getArticleFromId($productId);
            //var_dump($article); // je teste ma variable

            // 3) ajouter l'article au panier et tester le panier
            addToCart($article);
            //var_dump($_SESSION);
        }

        if (count($_SESSION['panier']) > 0) { //s'il y a au moins 1 élément dans la panier

            $total = calculerPrixTotal($_SESSION['panier']);

            foreach ($_SESSION['panier'] as $article) {

                echo "<div class=\"container\"> 
                <div class=\"row\">
                   <div class=\"col-md-2\">
                        <img src=\"./images/" . $article['picture'] . "\" class=\" card-img-top\" alt=\"...\">
                   </div>

                   <div class=\"col-md-2\">
                        <h5 class=\"card-title\">" . $article['name'] . "</h5>
                   </div>

                   <div class=\"col-md-2\">
                        <p class=\"card-text\">" . $article['price'] . " €</p>
                   </div>
                </div>
            </div>";
            }

            $total = calculerPrixTotal($_SESSION['panier']);
            echo "Prix total : " . $total . " €";
        } else {

            echo "<p>Votre panier est vide.</p>";
        }




        echo <div class =>
        
        <form method=\"GET\" action=\"produit.php\">

        <input type=\"hidden\" name=\"productId\" value=\"" . $article['id'] . "\">

        <input type=\"submit\" class=\"btn btn-outline-success\" value=\"Modifier la quantité\">

        </form>


        <form method=\"GET\" action=\"panier.php\">  

        <input type=\"hidden\" name=\"productId\" value=\"" . $_SESSION['panier'] . "\">

        <input type=\"submit\" class=\"btn btn-warning\" value=\"Supprimer\">
    
        </form>

        ?>
    </main>

    <?php
    include 'footer.php';
    ?>