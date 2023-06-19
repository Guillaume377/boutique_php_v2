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

<?php
    include 'header.php';
    ?>


<div class="boutique">
    <h1>Gammes</h1>
</div>
    
<?php
    
$gammes = getGammes();

foreach ($gammes as $gamme) {
    echo "<div class= container\">
    <div class=\"card text-center\">
            <h2 class=\"card-title\">" . $gamme['nom'] . "</h2>
    </div> 
</div>

<div class=\"container-fluid\">
           
    <div class=\"row list\">";
    // $articles = articles associés à ma gamme
    // getArticlesByGamme = fonction
    // $gamme = alias du foreach
    $articles = getArticlesByGamme($gamme['id']);

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
                        <input type=\"submit\" class=\"btn btn-ghost-1\" value=\"Détails produits\">
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
   echo "</div>
</div>";
    }
?>

    <?php
    include 'footer.php';
    ?>
