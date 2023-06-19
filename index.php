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

    //Déclencher la fonction "connexion" --> if (isset($_POST['nom d'un input'])) --> /!\ et pas le nom d'une fonction
    if (isset($_POST['email'])) {
        //var_dump($_POST);
        createConnection();
    }

    //Déclencher la fonction "déconnexion"
    if (isset($_POST['deconnexion'])) {

        deconnexion();
    }

    //Déclencher la fonction "modifMotDePasse"
    if (isset($_POST['newPassword'])) {

        modifMotDePasse();
    }

    // je déclenche la fonction de vider le panier
    if (isset($_POST['commandeValidee'])) {

        enregistrerCommande();
        clearCart();
    }

    ?>


    <?php
    include 'header.php';
    ?>

    <main>
        <div class="boutique">
            <h1>Boutique des beaux-arts</h1>
        </div>

        <div class="text-center">
            <h4> <?php
                    if (isset($_SESSION['client']['id'])) {
                        echo "Bienvenue " . $_SESSION['client']['prenom'] . " " . $_SESSION['client']['nom'] . "!";
                    }
                    ?></h4>
        </div>



        <div class="row list">

            <?php
            // je déclare la variable qui contient mon tableau d'articles
            // sa valeur,c'est le tableau d'articles renvoyé par la fonction getArticles
            $articles = getArticles();

            // je teste cette variable pour vérifier que l'ai bien mes 3 articles
            //var_dump($articles);

            //ou à la place des 2($articles = getArticles() + var_dump($articles)), je mets la fonction plus courte = var_dump(getArticles)

            //je lance ma boucle pour afficher une card bootstrap par article
            foreach ($articles as $article) {
                echo "<div class=\"produit col-sm-4 p-5 h-75\">
                            <div class=\"card text-center\">
                                <img src=\"./images/" . $article['image'] . "\" class=\"card-img-top mx-auto w-75\" alt=\"...\">
                                <div class=\"card-body\">
                                    <h5 class=\"card-title\">" . $article['nom'] . "</h5>
                                    <p class=\"description-index card-text\">" . $article['description'] . "</p>

                                    <div class=\"button-card d-flex justify-content-around\">
                                        <form method=\"GET\" action=\"produit.php\">  
                                        <input type=\"hidden\" name=\"productId\" value=\"" . $article['id'] . "\">
                                        <input type=\"submit\" class=\"button-index btn btn-ghost-1\" value=\"Détails produits\">
                                        </form>
                                    
                                        <form method=\"GET\" action=\"panier.php\">  
                                        <input type=\"hidden\" name=\"productId\" value=\"" . $article['id'] . "\">
                                        <input type=\"submit\" class=\"button-index btn btn-ghost-2\" value=\"Ajout panier\">
                                        </form>
                                    </div>
                                </div>  
                            </div>
                        </div>";
            }
            // Pour faire fonctionner le Foreach, je mets des "" (echo "... et ...</div>";) ainsi qu'un \ avant chaque " .

            ?>
        </div>
        
    </main>

    <?php
    include 'footer.php';
    ?>