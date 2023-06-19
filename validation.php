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
    //Déclencher la fonction "modifinfos"

    if (isset($_POST['nom'])) {

        modifinfos();
    }

    //Déclencher la fonction "modifadresse"

    if (isset($_POST['adresse'])) {
        //var_dump($_POST);
        modifadresse();
    }
    ?>

    <?php
    include 'header.php';
    ?>

    <main>
        <div class="boutique">
            <h1>Validation</h1>
        </div>

        <?php

        if (count($_SESSION['panier']) > 0) { //s'il y a au moins 1 élément dans le panier

            $total = calculerPrixTotal($_SESSION['panier']);

            foreach ($_SESSION['panier'] as $article) {

                echo "<div class=\"validation row pt-5\"> 
                    <div class=\"validation-card row d-flex justify-content-center\">
                        <div class=\"col-md-2\">
                        <img src=\"./images/" . $article['image'] . "\" class=\" card-img-top\" alt=\"...\">
                    </div>

                    <div class=\"col-md-2\">
                    <h5 class=\"card-title\">" . $article['nom'] . "</h5>
                    </div>

                    <div class=\"col-md-1\">
                    <p class=\"card-text\">" . $article['prix'] . " €</p>
                    </div> 

                    <div class=\"col-md-1\">
                    <p class=\"card-text\">" . $article['quantite'] . "</p>
                    </div> 
         
                </div>";
            }
            $total = calculerPrixTotal($_SESSION['panier']);


            $totalFraisPort = CalculerFraisPort($_SESSION['panier']);


            $totalorder = $total + $totalFraisPort;
        }

        ?>

        <div class="totalcommande container text-center fs-5">
            <div class="d-flex flex-column m-2">
                Prix total : <?= $total ?> €
            </div>
            <div class="d-flex flex-column m-2">
                Montant total frais de port : <?= $totalFraisPort ?> €
            </div>
            <div class="d-flex flex-column m-2">
                <span class="total">Total de la commande : <?= $totalorder ?> €</span>
            </div>
        </div>


        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h3>Coordonnées</h3>
                    <div class="inscription">
                        <form method="POST" action="validation.php">

                            <!-- ****************************** champ "nom" + "prénom" ****************************** -->

                            <div class="modifcoordos">
                                <label for="nom" class="form-label">Nom :</label>
                                <input type="text" name="nom" class="form-control" value="<?php echo $_SESSION['client']['nom'] ?>" required>
                            </div>

                            <div class="modifcoordos">
                                <label for="prenom" class="form-label">Prénom :</label>
                                <input type="text" name="prenom" class="form-control" value="<?php echo $_SESSION['client']['prenom'] ?>" required>
                            </div>


                            <!-- ****************************** champ "email"  ***************** -->

                            <div class="modifcoordos">
                                <label for="email" class="form-label">Email :</label>
                                <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $_SESSION['client']['email'] ?>" required>
                            </div>

                            <!-- ****************************** bouton ************************** -->

                            <div class="d-flex justify-content-center mb-2">
                                <button type="submit" class="btn btn-ghost-1 ">Valider</button>
                            </div>

                        </form>
                    </div>
                </div>


                <div class="col-md-6">
                    <h3>Adresse de livraison</h3>

                    <div class="inscription">
                        <form method="POST" action="validation.php">

                            <!-- ****************************** champ "adresse" + "code postal" ****************************** -->

                            <div class="modifcoordos">
                                <label for="adresse" class="form-label">Adresse :</label>
                                <input type="text" name="adresse" class="form-control" value="<?php echo $_SESSION['adresse']['adresse'] ?>" required>
                            </div>

                            <div class="modifcoordos">
                                <label for="code_postal" class="form-label">Code postal :</label>
                                <input type="text" name="code_postal" class="form-control" value="<?php echo $_SESSION['adresse']['code_postal'] ?>" required>
                            </div>


                            <!-- ****************************** champ "ville"  ***************** -->

                            <div class="modifcoordos">
                                <label for="ville" class="form-label">Ville :</label>
                                <input type="text" name="ville" class="form-control" value="<?php echo $_SESSION['adresse']['ville'] ?>" required>
                            </div>

                            <!-- ****************************** bouton ************************** -->

                            <div class="d-flex justify-content-center mb-2">
                                <button type="submit" class="btn btn-ghost-1 ">Valider</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="container text-center fs-5 pt-5">
            <!-- Button trigger modal -->
            <button type="submit" name="clearCart" class="button-valid btn btn-ghost-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Valider la commande
            </button>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content text-center">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 mx-auto" id="exampleModalLabel">Félicitations !</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Votre commande a été validée.</p>
                        <!--Afficher le montant total du panier-->
                        <p> Le montant total est de <?php echo $totalorder . ' €. <br>' ?></p>
                        <p>Expédition à partir du <?php
                                                    // **** obtenir et afficher la date du jour formatée ****
                                                    $dateJour = date("d-m-Y");
                                                    echo $dateJour;
                                                    ?> </p>
                        <p>Livraison estimée le
                            <?php
                            // ********************* calcul : date du jour + 3 jours *****************

                            // je récupère la date du jour en format DateTime (exigé par la fonction date_add)
                            $date = new DateTime("now");

                            // on utilise date_add pour ajouter 3 jours
                            // date_interval... => permet d'obtenir l'intervalle de temps souhaité pour l'ajouter
                            date_add($date, date_interval_create_from_date_string("3 days"));

                            // à ce stade, $date est directement modifiée
                            // je l'affiche en la formatant : jour mois année => 09-06-2023
                            echo date_format($date, "d-m-Y");
                            ?>
                        </p>
                        <p>Merci de votre confiance.</p>
                    </div>
                    <div class="modal-footer">
                        <form method="POST" action="./index.php">
                            <button type="submit" name="commandeValidee" class="btn btn-ghost-2">
                                Retour à l'accueil
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </main>

    <?php
    include 'footer.php';
    ?>