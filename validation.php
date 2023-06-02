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
        <h1>Validation</h1>
        <?php

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

                    <div class=\"col-md-1\">
                    <p class=\"card-text\">" . $article['quantite'] . "</p>
                    </div> 
         
                </div>";

            }
            $total = calculerPrixTotal($_SESSION['panier']);
            echo "Prix total : " . $total . " €";

            $totalFraisPort = CalculerFraisPort($_SESSION['panier']);
            echo "Montant total frais de port : " .$totalFraisPort . " €";

            $totalorder = $total + $totalFraisPort;
            echo "Total de la commande : " .$totalorder . " €";
        }

        ?>

    
        <form method="POST" action="./index.php">
            <button type="submit" name="commandeValidee" class="btn btn-success">
                Valider la commande
            </button>
        </form>


        
    </main>

    <?php
    include 'footer.php';
    ?>