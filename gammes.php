<?php

//inclure le fichier des fonctions pour pouvoir les appeler ici
include 'functions.php';

// initialiser la session et accéder à la superglobal $_SESSION (tableau associatif)
session_start();

// J'initialise le panier
createCart();

//inclure le head avec les balises de base + la balise head (pour ne pas répéter le code qu'il contient)
include 'head.php';

var_dump (getGammes());
var_dump (getArticlesByGamme(2));

foreach ($gammes as $gamme) {
    echo "<div class=\"col-sm-4 p-5 h-75\">
    <div class=\"card text-center\">
            <h5 class=\"card-title\">" . $gamme['nom'] . "</h5>
            <p class=\"description-index card-text\">" . $getArticlesByGamme['$id_gamme'] . "</p>
    </div> 
</div>";
}

?>
