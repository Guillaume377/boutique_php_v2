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
    //Déclencher la fonction "modifmdp"

    if (isset($_POST['modifMdp'])) {
        //var_dump($_POST);
        modifMotDePasse();
    }
    ?>

    <?php
    include 'header.php';
    ?>
    <main>

        <div class="boutique">
            <h1>Mon mot de passe</h1>
        </div>

        <!-- ****************************** champ "ancien MDP + nouveau MDP"  ***************** -->
        <form method="POST" action="modifmdp.php">
            <div class="mb-3 modifmdp">
                <label for="exampleInputPassword1" class="form-label">Mot de passe actuel : </label>
                <input type="password" name="oldPassword" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="mb-3 modifmdp">
                <label for="exampleInputPassword1" class="form-label">Nouveau mot de passe : </label>
                <input type="password" name="newPassword" class="form-control" id="exampleInputPassword1">
            </div>

            <!-- ****************************** bouton ************************** -->

            <div class="d-flex justify-content-center mb-2">
                <button type="submit" name="modifMdp" class="btn btn-ghost-1 ">Modifier mon mot de passe</button>
            </div>
        </form>





        <div class="container d-flex justify-content-between">
            <div class="row text-center col-md-4 p-5">
                <i class="logo-font fa-solid fa-user" style="color: #B8860B;"></i>
                <a href="./modifinfos.php" class="button-infos navbar-brand btn btn-ghost-2">Modifier mes informations</a>
            </div>

            <div class="row text-center col-md-4 p-5">
                <i class="logo-font fa-solid fa-house" style="color: #B8860B;"></i>
                <a href="./modifadresse.php" class="button-infos navbar-brand btn btn-ghost-2">Modifier mon adresse</a>
            </div>

            <div class="row text-center col-md-4 p-5">
                <i class="logo-font fa-solid fa-rectangle-list" style="color: #B8860B;"></i>
                <a href="./commande.php" class="button-infos navbar-brand btn btn-ghost-2">Modifier mes commandes</a>
            </div>
        </div>

    </main>

    <?php
    include 'footer.php';
    ?>