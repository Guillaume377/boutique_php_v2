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
// je déclenche la fonction detail de la commande
    if (isset($_POST['commandeId'])) {

        $articles = recupArticlesCommande();
       //var_dump($articles);
    }
        ?>

    <?php
    include 'header.php';
    ?>
    <main>

        <div class="boutique">
            <h1>Détails de ma commande</h1>
        </div>

        <table class="table mt-5 mb-5 table-striped">
            <thead>
                <tr>
                    <th scope="col">Article</th>
                    <th scope="col">Prix</th>
                    <th scope="col">Quantité</th>
                    <th scope="col">Montant</th>
                </tr>
            </thead>

            <tbody>
                <?php
                foreach ($articles as $article) 
                    echo "
                    <tr>
                        <th scope=\"row\">" . $article['nom'] . "</th>
                        <td>" . $article['prix'] . " €</td>
                        <td>" . $article['quantite'] . "</td>
                        <td>" . $article['prix'] * $article['quantite'] . " €</td>
                     </tr>"
                
                ?>
        
            </tbody>

        </table>
        
    </main>


        <?php
    include 'footer.php';
    ?>