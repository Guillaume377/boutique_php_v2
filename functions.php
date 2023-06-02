<?php

// ******************************** renvoyer un tableau d'articles ************************************** */

function getArticles()
{
    return [
        //***************************** article 1***************************** */
        [
            'name' => 'Coffret Atelier Albrecht Dürer',
            'id' => '1',
            'price' => 89.99,
            'description' => 'Un coffret de 36 crayons très facile à emporter',
            'detailedDescription' => 'Coffret Atelier Albrecht Dürer, 36 crayons Albrecht Dürer et 1 pinceau aquarelle haut de gamme 
                            dans un superbe coffret en imitation cuir à fermeture magnétique.
                            Très facile à emporter lors de vos voyages et magnifique écrin pour votre atelier.',
            'picture' => 'coffret_dürer.jpg'
        ],

        //*****************************article 2****************************** */

        [
            'name' => 'Coffret de crayons en bois Lightfast',
            'id' => '2',
            'price' => 349.99,
            'description' => 'La gamme Lightfast dans un superbe coffret en bois.',
            'detailedDescription' => 'Tous les plaisirs et les exceptionnelles qualités de la gamme Lightfast. 
                            Un superbe coffret en bois contenant 100 crayons de bois aux couleurs uniques.',
            'picture' => 'coffret_lightfast.jpg'
        ],

        //*****************************article 3****************************** */
        [
            'name' => 'Coffret en bois de 120 crayons supracolor soft',
            'id' => '3',
            'price' => 495.99,
            'description' => 'L´ensemble de la gamme de couleurs Supracolor dans dans un coffret en bois de couleur acajou.',
            'detailedDescription' => 'Coffret en bois de 120 crayons supracolor soft : Dimensions du coffret: 24,5 x 39,5 x 6 cm. Une parfaite idée de cadeau.
                         Les crayons aquarellables Supracolor Soft ont une mine tendre de 3,8 mm de diamétre, mine très résistante mais aussi économique grâce à son opacité remarquable. 
                         Destinées aux œuvres de grande ampleur, les mines sont extrêmement solides.
                         La gamme de crayons aquarellables Supracolor Soft propose une grande variété d’applications grâce à la luminosité des teintes et à leur excellent pouvoir couvrant.
                         Le dessin au crayon peut ainsi être délavé, estompé au doigt, texturé au frottement de la mine sur un papier abrasif ou pleinement aquarellé.',
            'picture' => 'coffret_supracolor.jpg'
        ],

    ];
}

// ****************************************** récupérer le produit  qui correspond à l'id fourni en paramètre ***********************

function getArticleFromId($id)
{   //$id : je peux choisir le nom que je souhaite

    //récupérer la liste des articles
    $articles = getArticles();

    // aller chercher dedans l'article qui comporte l'id en paramètre
    foreach ($articles as $article) {
        if ($article['id'] == $id) {

            // le renvoyer avec un return
            return $article;
        }
    }
}
// ******************************************* initialiser le panier **************************************************

function createCart()
{
    if (isset($_SESSION['panier']) == false) { // si mon panier n'existe pas encore
        $_SESSION['panier'] = [];              // je l'initialise
    }
}

// ****************************************** ajouter l'article au panier et tester le résultat ***********************

function addToCart($article)
{

    // j'attribue une quantité de 1 (par défaut)  à l'article
    $article['quantite'] = 1;

    // je vérifie si l'article n'est pas déjà présent en comparant les id
    // for :
    //$i = index de la boucle
    //$i < count($_SESSION['panier']) = condition de maintien de la boucle (évaluée avant chaque tour)
    //(si condition vraie => on lance la boucle)
    //$i++ = évolution de l'index $i à la FIN de chaque boucle

    for ($i = 0; $i < count($_SESSION['panier']); $i++) {

        // si présent => quantité +1
        if ($_SESSION['panier'][$i]['id'] == $article['id']) {
            $_SESSION['panier'][$i]['quantite']++;
            return; //permet de sortir de la fonction
        }
    }

    // si pas présent => ajout classique via array_push
    array_push($_SESSION['panier'], $article);
}


// ***************************************** Calculer le prix total dans le panier ***************************************

function calculerPrixTotal()
{

    $prixTotal = 0; //j'initialise le prix à 0.

    foreach ($_SESSION['panier'] as $article) {

        $prixTotal += $article['price'] * $article['quantite']; //prix multiplié par la quantité + cumul du total
    }
    return $prixTotal;
}

// ***************************************** Modifier la quantité de l'article dans le panier ****************************
function updateQuantity()
{

    // je boucle sur le panier => je cherche l'article à modifier
    for ($i = 0; $i < count($_SESSION['panier']); $i++) {

        // dès que je trouve mon article
        if ($_SESSION['panier'][$i]['id'] == $_POST['modifiedArticleId']) {

            // je remplace son ancienne quantité par la nouvelle
            $_SESSION['panier'][$i]['quantite'] = $_POST['newQuantity'];

            //j'affiche un message de succès dans une petite fenêtre via Javascript
            echo "<script> alert(\"Quantité modifiée !\");</script>";

            // je sors de la fonction pour éviter de boucler sur les articles suivants
            return;
        }
    }
}

// **************************************** Supprimer la quantité de l'article dans le panier ********************************

function removeFromCart()
{
    // je boucle sur le panier => je cherche l'article à modifier
    for ($i = 0; $i < count($_SESSION['panier']); $i++) {

        // dès que je trouve mon article
        if ($_SESSION['panier'][$i]['id'] == $_POST['deletedArticleId']) {
            // L'article a été trouvé dans le panier, le supprimer
            array_splice($_SESSION['panier'], $i, 1);
            // je sors de la fonction pour éviter de boucler sur les articles suivants
            return;
        }
    }
}

// ***************************************** Vider le panier ***************************************

function clearCart() {
    // Vider le panier en supprimant toutes les entrées, tout en conservant l'existence du panier (à la différence du "unset()" qui fait disparaitre le panier)
    $_SESSION['panier'] = [];
  }

// ****************************************** Calculer les frais de port ***************************

function calculerFraisPort() {

    $quantitytotal = 0; //j'initialise le prix à 0.

    foreach ($_SESSION['panier'] as $article) {

        $quantitytotal += $article['quantite']; //j'incrémente ma quantité totale de la quantité de l'article
    }
    return $quantitytotal*3; // je multiplie le total d'articles par 3 euros.

}
