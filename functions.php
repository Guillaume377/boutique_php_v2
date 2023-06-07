<?php

// ******************************** connexion à la base de données ************************************** */

function getConnection()
{
    // try : je tente une connexion
    try{
        $db = new PDO(
            'mysql:host=localhost;dbname=boutique_en_ligne;charset=utf8', // infos : sgbd, nom base, adresse (host) +
            'root', // pseudo utilisateur (root en local)
            '', // mot de passe (aucun en local)
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC)
        ); // options PDO : 1) affichage des erreurs / 2) récupération des données simplifiée

        // si ça ne marche pas : je mets fin au code php en affichant l'erreur
    } catch (Exception $erreur) { // je récupère l'erreur en paramètre
        die('Erreur : ' . $erreur->getMessage()); //je l'affiche et je mets fin au script
    }

    // je retourne la connexion stockée dans une variable
    return $db;
}





// ******************************** récupérer la liste des articles ************************************** */

function getArticles()
{
    // je me connecte à la base de données
    $db = getConnection();

    // j'exécute une requête qui va récupérer tous les articles
    $results = $db->query('SELECT * FROM articles');

    // je récupère les résultats et je les renvoie grâce à return
    return $results->fetchAll();
}




// ******************************* récupérer les gammes et leurs articles ************************************ */

function getGammes()
{
    $db = getConnection();

    $results = $db->query('SELECT * FROM gammes');

    return $results->fetchAll();
}


function getArticlesByGamme ($id)
{
    $db = getConnection();

    $results = $db->query
    



}

// ********************************************* récupérer un article à partir de son id **********************

function getArticleFromId($id)
{ 
    // je me connecte à la bdd
     $db = getConnection();

    // /!\ JAMAIS DE VARIABLE PHP DIRECTEMENT DANS UNE REQUETE /!\ (risque d'injection SQL)

    // je prépare ma requête
    $query = $db->prepare('SELECT * FROM Articles WHERE id = ?');

    // je l'exécute avec le bon paramètre
    $query->execute([$id]); 

    // retourne l'article sous forme de tableau associatif
    return $query->fetch(); 
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
