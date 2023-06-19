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
    //Déclencher la fonction "modifinfos"

    if (isset($_POST['nom'])) {

        modifinfos();
    }
    ?>

    <?php
    include 'header.php';
    ?>
    
    <main>

        <div class="boutique">
            <h1>Mes informations</h1>
        </div>

        <form method="POST" action="modifinfos.php">

            <!-- ****************************** champ "nom" + "prénom" ****************************** -->

            <div class="modifinfos">
                <label for="nom" class="form-label">Nom :</label>
                <input type="text" name="nom" class="form-control" value="<?php echo $_SESSION['client']['nom'] ?>" required>
            </div>

            <div class="modifinfos">
                <label for="prenom" class="form-label">Prénom :</label>
                <input type="text" name="prenom" class="form-control" value="<?php echo $_SESSION['client']['prenom'] ?>" required>
            </div>


            <!-- ****************************** champ "email"  ***************** -->

            <div class="modifinfos">
                <label for="email" class="form-label">Email :</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $_SESSION['client']['email'] ?>" required>
            </div>

            <!-- ****************************** bouton ************************** -->

            <div class="d-flex justify-content-center mb-2">
                <button type="submit" class="btn btn-ghost-1 ">Modifier mes informations</button>
            </div>

        </form>

        <div class="row d-flex justify-content-between">
            <div class="modification row text-center col-md-4 pt-5">
                <i class="logo-font fa-solid fa-key" style="color: #B8860B;"></i>
                <a href="./modifmdp.php" class="button-infos navbar-brand btn btn-ghost-2">Modifier mon mot de passe</a>
            </div>

            <div class="modification row text-center col-md-4 pt-5">
                <i class="logo-font fa-solid fa-house" style="color: #B8860B;"></i>
                <a href="./modifadresse.php" class="button-infos navbar-brand btn btn-ghost-2">Modifier mon adresse</a>
            </div>

            <div class="modification row text-center col-md-4 pt-5">
                <i class="logo-font fa-solid fa-rectangle-list" style="color: #B8860B;"></i>
                <a href="./commande.php" class="button-infos navbar-brand btn btn-ghost-2">Mes commandes</a>
            </div>
        </div>



    </main>

    <?php
    include 'footer.php';
    ?>