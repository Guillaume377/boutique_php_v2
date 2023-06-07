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

        // ****************************************** si je viens d'un changement de quantité  **************************************

        if (isset($_POST['newQuantity'])) {
            // je déclenche la fonction de chargement de quantité
            updateQuantity();
        }

        // ****************************************** si je viens d'un bouton supprimer : je déclenche le retrait *********************
        if (isset($_POST['deletedArticleId'])) {
            // je déclenche la fonction de suppression d'un article
            removeFromCart();
        }

        // ******************************************* si je veux vider le panier *******************************
        if (isset($_POST['clearCart'])) {
            // je déclenche la fonction de vider le panier
            clearCart();
        }


        if (count($_SESSION['panier']) > 0) { //s'il y a au moins 1 élément dans le panier

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

                   <div class=\"col-md-1\">
                        <p class=\"card-text\">" . $article['price'] . " €</p>
                   </div>

                    <form class=\"col-lg-3\" action=\"panier.php\" method=\"POST\">
                        <div class=\"row pt-1\">
                        <input type=\"hidden\" name=\"modifiedArticleId\" value=\"" . $article['id'] . "\">
                        <input class=\"col-3 offset-2\" type=\"number\" id=\"numberInput\" min=\"1\" max=\"10\" step=\"1\" name=\"newQuantity\" 
                        value=\"" . $article['quantite'] . "\">
                        <button type=\"submit\" class=\" col-4 offset-1 btn btn-ghost-1\">
                            Modifier quantité
                        </button>
                        </div>    
                    </form>

                    <form class=\"col-lg-2\" action=\"panier.php\" method=\"post\">
                        <input type=\"hidden\" name=\"deletedArticleId\" value=\"" . $article['id'] . "\">
                        <button type=\"submit\" class=\"btn btn-ghost-2 mt-2 mt-lg-0\">
                            Supprimer
                        </button>
                    </form>    
                 
                </div>";
            }

            $total = calculerPrixTotal($_SESSION['panier']);

        ?>
            <div class="container text-center fs-5 p-5">
                <div class="mx-auto m-2">
                    <span class= "total">Prix total : <?= $total ?> €</span>
                </div>
            


            <!----------------------------------------------Bouton qui vide le panier ---------------------------------------------------->

            <!-- je mets le bouton "vider panier" à l'interieur des {} du if = le bouton apparait seulement s'il y a au moins 1 article dans le panier-->
            
                <form method="POST" action="./panier.php">
                    <button type="submit" name="clearCart" class="btn btn-ghost-1 m-2">
                        Vider panier
                    </button>
                </form>
         
            <!-------------------------------------------------Bouton qui valide le panier -------------------------------------------------->

            
                <a href="./validation.php">
                    <button class="btn btn-ghost-2 m-2">
                        Validation panier
                    </button>
                </a>
            </div>
            
        <?php

        } else {
            echo "<div class=\"text-center\">
                     <p>Votre panier est vide.</p>
                    </div>";
        }

        ?>
    </main>

    <?php
    include 'footer.php';
    ?>