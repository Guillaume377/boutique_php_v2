<?php

// ******************************** connexion à la base de données ************************************** */

function getConnection()
{
    // try : je tente une connexion
    try {
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
    // je me connecte à la base de données
    $db = getConnection();

    // j'exécute une requête qui va récupérer toutes les gammes
    $results = $db->query('SELECT * FROM gammes');

    // je récupère les résultats et je les renvoie grâce à return
    return $results->fetchAll();
}


function getArticlesByGamme($id)
{
    // je me connecte à la bdd
    $db = getConnection();

    // /!\ JAMAIS DE VARIABLE PHP DIRECTEMENT DANS UNE REQUETE /!\ (risque d'injection SQL)

    // je prépare ma requête
    $query = $db->prepare('SELECT * FROM articles WHERE id_gamme = ?');

    // je l'exécute avec le bon paramètre
    $query->execute([$id]);

    // retourne l'article sous forme de tableau associatif
    return $query->fetchAll();
}

function showArticles($getArticlesByGamme)
{
}


// **************************** Vérifier qu'aucun input n'est vide **************************

function checkEmptyFields()
{
    foreach ($_POST as $field) {
        if (empty($field)) {
            return true;
        }
    }
    return false;
}

// **************************** Vérifier la longueur des champs **************************

function checkInputsLenght()
{
    $inputsLenghtOk = true;

    if (isset($_POST['nom'])) {
        if (strlen($_POST['nom']) > 25 || strlen($_POST['nom']) < 3) {
            $inputsLenghtOk = false;
        }
    }

    if (isset($_POST['prenom'])) {
        if (strlen($_POST['prenom']) > 25 || strlen($_POST['prenom']) < 3) {
            $inputsLenghtOk = false;
        }
    }

    if (isset($_POST['email'])) {
        if (strlen($_POST['email']) > 25 || strlen($_POST['email']) < 5) {
            $inputsLenghtOk = false;
        }
    }

    if (isset($_POST['adresse'])) {
        if (strlen($_POST['adresse']) > 100 || strlen($_POST['adresse']) < 5) {
            $inputsLenghtOk = false;
        }
    }

    if (isset($_POST['code_postal'])) {
        if (strlen($_POST['code_postal']) !== 5) {
            $inputsLenghtOk = false;
        }
    }

    if (isset($_POST['ville'])) {
        if (strlen($_POST['ville']) > 40 || strlen($_POST['ville']) < 3) {
            $inputsLenghtOk = false;
        }
    }

    return $inputsLenghtOk;
}


// **************************** Vérifier si l'e-mail existe déjà dans le système de stockage (base de données) **************************


function emailExist()
{
    // je me connecte à la base
    $db = getConnection();

    // je prépare ma requete pour recuperer si déjà un email
    $query = $db->prepare('SELECT * FROM clients WHERE email = ?');

    // j'exécute ma requête
    $query->execute([$_POST['email']]);

    // je vais chercher les résultats et je les stocke dans une variable
    $client = $query->fetch();

    return $client;
}

// **************************** Vérifier que le mot de passe réunit tous les critères demandés **************************

function checkPassword($password)
{
    // minimum 8 caractères et maximum 15, minimum 1 lettre, 1 chiffre et 1 caractère spécial
    // (?=.*[0-9])= minimum 1 chiffre ; (?=.*[a-zA-Z]) = minimum 1 lettre ; (?=.*[@$!%*?/&])(?=\S+$) = minimum 1 caractère spécial ; {8,15}$ = entre 8 et 15 caractères
    $regex = "^(?=.*[0-9])(?=.*[a-zA-Z])(?=.*[@$!%*?/&])(?=\S+$).{8,15}$^";
    return preg_match($regex, $password);
}

// ********************************************** Vérifier cette inscription ***************************** 

function validInscription()
{
    // je me connecte à la bdd
    $db = getConnection();


    if (checkEmptyFields()) {
        echo "Veuillez remplir tous les champs obligatoires.";
    } else {

        if (checkInputsLenght() == false) {
            echo "Veuillez respecter le nombre de caractères.";
        } else {

            if (emailExist()) {
                echo "Cet email existe déjà.";
            } else {

                if (checkPassword($_POST['mot_de_passe']) == false) {
                    echo "Veuillez respecter les conditions requises.";
                } else {

                    var_dump('test');
                    // ********************************************** Hachage du mot de passe *******************************************

                    $hashedPassword = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT);


                    // ********************************************* Sauvegarde utilisateur *********************************************

                    $nom = $_POST['nom'];
                    $prenom = $_POST['prenom'];
                    $email = $_POST['email'];


                    // ---------------------------------------------- SYNTAXE 1 : ? -------------------------------------------

                    /* je prépare ma requête : INSERT INTO "ma table" (le nom exact des champs de ma table) VALUES ()

                    $query = $db->prepare("INSERT INTO clients (nom, prenom, email, mot_de_passe) VALUES (?, ?, ?, ?)");


                    // je l'exécute avec le bon paramètre : mettre les variables dans l'ordre du VALUES (?, ?, ?, ?)

                    $query->execute([$nom, $prenom, $email, $hashedPassword]);*/



                    // ----------------------------------------------OU SYNTAXE 2 : TABLEAU ASSOCIATIF -------------------------------------------

                    // je prépare ma requête : INSERT INTO "ma table" (le nom exact des champs de ma table) VALUES (:nom de chaque champ)

                    $query = $db->prepare("INSERT INTO clients (nom, prenom, email, mot_de_passe) VALUES (:nom, :prenom, :email, :mot_de_passe)");


                    // je l'exécute avec le bon paramètre : mettre les variables dans l'ordre du VALUES (:nom, :prenom, :email, :mot_de_passe)

                    $query->execute([
                        "nom" => strip_tags($nom),
                        "prenom" => strip_tags($prenom),
                        "email" => strip_tags($email),
                        "mot_de_passe" => $hashedPassword
                    ]);

                    // récupération de l'id de l'utilisateur créé
                    $id = $db->lastInsertId();

                    // insertion de adresse dans la table "adresses"
                    creatAddress($id);

                    // on renvoie un message de succès
                    echo '<script>alert(\'Le compte a bien été créé !\')</script>';
                }
            }
        }
    }
}

// ******************************** Insertion de l'adresse en base de données (SYNTAXE 2) ******************

function creatAddress($user_id)

{
    $db = getConnection();

    $adresse = $_POST['adresse'];
    $code_postal = $_POST['code_postal'];
    $ville = $_POST['ville'];

    // je prépare ma requête : INSERT INTO "ma table" (le nom exact des champs de ma table) VALUES (:nom de chaque champ)

    $query = $db->prepare("INSERT INTO adresses (id_client, adresse, code_postal, ville) VALUES (:id_client, :adresse, :code_postal, :ville)");

    // je l'exécute avec le bon paramètre : mettre les variables dans l'ordre du VALUES ()

    $query->execute([
        "id_client" => $user_id,
        "adresse" => strip_tags($adresse),
        "code_postal" => strip_tags($code_postal),
        "ville" => strip_tags($ville)
    ]);
}


// ************************************************* Modification des informations **************************************


function modifinfos()
{
    // je me connecte à la bdd
    $db = getConnection();

    if (checkEmptyFields()) {
        echo '<script>alert(\'Veuillez remplir tous les champs obligatoires.\')</script>';
    } else {

        if (checkInputsLenght() == false) {
            echo '<script>alert(\'Veuillez respecter le nombre de caractères.\')</script>';
        } else {

            // je prépare ma requête : MISE A JOUR des informations
            $query = $db->prepare("UPDATE clients SET nom=:nom, prenom=:prenom, email=:email WHERE id=:id");

            // je l'exécute avec les bons paramètres
            $query->execute([
                "id" => $_SESSION['client']['id'],
                "nom" => strip_tags($_POST['nom']),
                "prenom" => strip_tags($_POST['prenom']),
                "email" => strip_tags($_POST['email']),
            ]);

            $_SESSION['client']['nom'] = strip_tags($_POST['nom']);
            $_SESSION['client']['prenom'] = strip_tags($_POST['prenom']);
            $_SESSION['client']['email'] = strip_tags($_POST['email']);

            // on renvoie un message de succès
            echo '<script>alert(\'Les modifications ont été enregistrées !\')</script>';
        }
    }
}


// ************************************************* Modification de l'adresse **************************************


function modifadresse()
{
    // je me connecte à la bdd
    $db = getConnection();

    if (checkEmptyFields()) {
        echo '<script>alert(\'Veuillez remplir tous les champs obligatoires.\')</script>';
    } else {

        if (checkInputsLenght() == false) {
            echo '<script>alert(\'Veuillez respecter le nombre de caractères.\')</script>';
        } else {

            // je prépare ma requête : MISE A JOUR des informations
            $query = $db->prepare("UPDATE adresses SET adresse=:adresse, code_postal=:code_postal, ville=:ville WHERE id_client=:id_client");

            // je l'exécute avec les bons paramètres
            $query->execute([
                "id_client" => $_SESSION['adresse']['id_client'],
                "adresse" => strip_tags($_POST['adresse']),
                "code_postal" => strip_tags($_POST['code_postal']),
                "ville" => strip_tags($_POST['ville']),
            ]);

            $_SESSION['adresse']['adresse'] = strip_tags($_POST['adresse']);
            $_SESSION['adresse']['code_postal'] = strip_tags($_POST['code_postal']);
            $_SESSION['adresse']['ville'] = strip_tags($_POST['ville']);

            // on renvoie un message de succès
            echo '<script>alert(\'Les modifications ont été enregistrées !\')</script>';
        }
    }
}

// ************************************************* adresse liée à l'id client **************************************

function getAddressFromId()
{
    // je me connecte à la base
    $db = getConnection();

    // je prépare ma requete pour recuperer 
    $query = $db->prepare('SELECT * FROM adresses WHERE id_client = ?');

    // j'exécute ma requête
    $query->execute([$_SESSION['client']['id']]);

    // je vais chercher les résultats et je les stocke dans une variable
    return $query->fetch();
}



// ************************************************* Modification du mot de passe **************************************

function modifMotDePasse()
{

    // je me connecte à la bdd
    $db = getConnection();

    //1.  je vérifie s'il y a des champs libres
    if (checkEmptyFields()) {
        echo '<script>alert(\'Veuillez remplir tous les champs obligatoires.\')</script>';
    } else {


        //2. je récupère le mot de passe existant (/!\ pas de variable dans un prepare)
        $query = $db->prepare('SELECT mot_de_passe FROM clients WHERE id = ?');

        $query->execute([$_SESSION['client']['id']]);

        $motDePasseActuel = $query->fetch();


        //3. je vérifie si le MDP actuel = MDP en base
        if ($motDePasseActuel != $_POST['oldPassword']) {
            echo "Le mot de passe est erroné !";
        } else {

            //4. je vérifie que le mot de passe respecte les critères

            if (checkPassword($_POST['newPassword']) == false) {
                echo '<script>alert(\'Veuillez respecter les conditions requises.\')</script>';
            } else {

                //5. Hachage du nouveau mot de passe 
                $motDePasseActuel = password_hash($_POST['newPassword'], PASSWORD_DEFAULT);


                //6. je prépare la mise à jour

                $query = $db->prepare("UPDATE clients SET mot_de_passe=:mot_de_passe WHERE id=:id");

                // 7. je l'exécute avec les bon paramètres
                $query->execute([
                    "newPassword" => strip_tags($_POST['newPassword']),
                ]);

                // on renvoie un message de succès
                echo '<script>alert(\'Les modifications ont été enregistrées !\')</script>';
            }
        }
    }
}


// ****************************************************** Vérifier la connexion *******************************

function createConnection()
{

    // je me connecte à la base
    $db = getConnection();

    //je récupère le client s'il existe
    $client = emailExist();

    if ($client == true) {

        if (password_verify($_POST['mot_de_passe'], $client['mot_de_passe'])) {
            $_SESSION['client'] = $client;
            $address = getAddressFromId();
            $_SESSION['adresse'] = $address;
            echo '<script>alert(\'Vous êtes connectés!\')</script>';
        } else {
            echo "Votre mot de passe est incorrect !";
        }
    } else {
        echo "Vous n'avez pas de compte client !";
    }
}

// ****************************************************** Se déconnecter de son compte ******************************

function deconnexion()

{
    $_SESSION['client'] = [];


    // on renvoie un message de succès
    echo '<script>alert(\'Vous êtes déconnectés!\')</script>';
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

        $prixTotal += $article['prix'] * $article['quantite']; //prix multiplié par la quantité + cumul du total
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

function clearCart()
{
    // Vider le panier en supprimant toutes les entrées, tout en conservant l'existence du panier (à la différence du "unset()" qui fait disparaitre le panier)
    $_SESSION['panier'] = [];
}

// ****************************************** Calculer les frais de port ***************************

function calculerFraisPort()
{

    $quantitytotal = 0; //j'initialise le prix à 0.

    foreach ($_SESSION['panier'] as $article) {

        $quantitytotal += $article['quantite']; //j'incrémente ma quantité totale de la quantité de l'article
    }
    return $quantitytotal * 3; // je multiplie le total d'articles par 3 euros.

}
