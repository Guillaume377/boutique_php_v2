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
        <div class="boutique">
            <h1>Connexion / Inscription</h1>
        </div>
        <!-- ****************************** Connexion ******************************** -->

        <div class="container">
            <div class="row">
                <div class="col-md-5 inscription">

                    <div class="text-center my-3">
                        <h2>Connexion</h2>
                    </div>

                    <form method="POST" action="index.php">

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email :</label>
                            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ajouter votre email" required>
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Mot de passe : </label>
                            <input type="password" name="mot_de_passe" class="form-control" id="exampleInputPassword1">
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Se souvenir de moi</label>
                        </div>

                        <div class="d-flex justify-content-center mt-5">
                        <a href="./connexion.php"><button type="submit" class="btn btn-ghost-1">Se connecter</button>
                        </a>
                    </div>

                    </form>
                </div>

                <!-- ****************************** Inscription ******************************** -->

                <div class="col-md-5 inscription">
                    <div class="text-center my-3">
                        <h2>Inscription</h2>
                    </div>

                    <form method="POST" action="connexion.php">

                        <!-- ****************************** champ "nom" + "prénom" ****************************** -->

                        <div class="row">
                            <div class="d-flex justify-content-between">
                                <div class="mb-3 w-50">
                                    <label for="nom" class="form-label">Nom :</label>
                                    <input type="text" name="nom" class="form-control" placeholder="exemple : LEBLANC" required>
                                </div>

                                <div class="mb-3 w-50 ps-3">
                                    <label for="prenom" class="form-label">Prénom :</label>
                                    <input type="text" name="prenom" class="form-control" placeholder="exemple : Juste" required>
                                </div>
                            </div>
                        </div>

                        <!-- ****************************** champ "email" + "mot_de_passe" ***************** -->

                        
                           
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email :</label>
                                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ajouter votre email" required>
                                 </div>

                                <div class="mb-3">
                                    <label for="mot_de_passe" class="form-label">Mot de passe : </label>
                                    <input type="password" name="mot_de_passe" class="form-control" placeholder="(entre 8 et 15 caractères, min 1 lettre, 1 chiffre et 1 caractère spécial)" id="exampleInputPassword1" required>
                                </div>
                           
                        

                        <!-- ****************************** champ "adresse" ******************************** -->

                        <div class="mb-3">
                            <label for="adresse" class="form-label">Adresse :</label>
                            <input type="text" name="adresse" class="form-control" placeholder="exemple : 7 rue de la Tour Eiffel en allumettes" required>
                        </div>

                        <!-- ****************************** champ "code_postal" + "ville" ********************** -->

                        <div class="row">
                            <div class="d-flex justify-content-between">
                                <div class="mb-3 w-50">
                                    <label for="code_postal" class="form-label">Code postal :</label>
                                    <input type="text" name="code_postal" class="form-control" placeholder="exemple : 45200" required>
                                </div>

                                <div class="mb-3 w-50 ps-3">
                                    <label for="ville" class="form-label">Ville :</label>
                                    <input type="text" name="ville" class="form-control" placeholder="exemple : MONTARGIS" required>
                                </div>
                            </div>
                        </div>

                        <!-- ****************************** bouton "s'inscrire" ******************************** -->

                        <div class="d-flex justify-content-center mb-2">
                            <button type="submit" class="btn btn-ghost-1 ">S'inscrire</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <?php
        include 'footer.php';
        ?>