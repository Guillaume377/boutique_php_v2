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
            <h1>Mon adresse</h1>
        </div>

        <form method="POST" action="modifadresse.php">

            <!-- ****************************** champ "adresse" + "code postal" ****************************** -->

            <div class="modifinfos">
                <label for="adresse" class="form-label">Adresse :</label>
                <input type="text" name="adresse" class="form-control" value="<?php echo $_SESSION['adresse']['adresse'] ?>" required>
            </div>

            <div class="modifinfos">
                <label for="code_postal" class="form-label">Code postal :</label>
                <input type="text" name="code_postal" class="form-control" value="<?php echo $_SESSION['adresse']['code_postal'] ?>" required>
            </div>


            <!-- ****************************** champ "ville"  ***************** -->

            <div class="modifinfos">
                <label for="ville" class="form-label">Ville :</label>
                <input type="text" name="ville" class="form-control" value="<?php echo $_SESSION['adresse']['ville'] ?>" required>
            </div>

            <!-- ****************************** bouton ************************** -->

            <div class="d-flex justify-content-center mb-2">
                <button type="submit" class="btn btn-ghost-1 ">Modifier mon adresse</button>
            </div>

        </form>

        <div class="row d-flex justify-content-between">
            <div class="modification row text-center col-md-4 pt-5">
                <i class="logo-font fa-solid fa-user" style="color: #B8860B;"></i>
                <a href="./modifinfos.php" class="button-infos navbar-brand btn btn-ghost-2">Modifier mes informations</a>
            </div>

            <div class="modification row text-center col-md-4 pt-5">
                <i class="logo-font fa-solid fa-key" style="color: #B8860B;"></i>
                <a href="./modifmdp.php" class="button-infos navbar-brand btn btn-ghost-2">Modifier mon mot de passe</a>
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