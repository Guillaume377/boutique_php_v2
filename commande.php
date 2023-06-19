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
    include 'header.php';
    ?>
    <main>

        <div class="boutique">
            <h1>Mes commandes</h1>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Numéro</th>
                    <th scope="col">Date</th>
                    <th scope="col">Prix</th>
                    <th scope="col">Détails</th>
                </tr>
            </thead>
            <tbody>

                <?php
                foreach (recupCommandes() as $commande) {
                    echo "
                
                    <tr>
                        <th scope=\"row\">" . $commande['numero'] . "</th>
                        <td>" . $commande['date_commande'] . "</td>
                        <td>" . $commande['prix'] . "</td>
                        <td>
                            <form method=\"POST\" action=\"./detailscommande.php\">
                            <input type =\"hidden\" name=\"detail\">
                            <button type=\"submit\" class=\"navbar-brand btn btn-ghost-2\">
                                 Détails
                            </button>
                        </form>
                        </td>
                    </tr>

                ";
                
                }

                ?>

            </tbody>
        </table>






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
                <i class="logo-font fa-solid fa-house" style="color: #B8860B;"></i>
                <a href="./modifadresse.php" class="button-infos navbar-brand btn btn-ghost-2">Modifier mon adresse</a>
            </div>
        </div>
    </main>

    <?php
    include 'footer.php';
    ?>