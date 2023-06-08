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
        <h1>Inscription</h1>

        <div class="container">
            <div class="row">
                <div class="col">
                    <form method="POST" action="connexion.php">
                        <div class="container ">
                            <div class="row">
                                <div class="col d-flex flex-column">
                                    <h2>Connexion</h2>
                                    <label for="email">Email :</label>
                                    <input type="email" name="email" id="email" placeholder="Ajouter votre email" required><br><br>

                                    <label for="motdepasse">Mot de passe :</label>
                                    <input type="password" name="motdepasse" id="motdepasse" required><br><br>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col">
                    <form method="POST" action="connexion.php">
                        <div class=row>
                            <div class="col">
                                <h2>Inscription</h2>
                                <div class=row>
                                    <div class="col d-flex flex-column">
                                        <label for="nom">Nom :</label>
                                        <input type="text" name="nom" id="nom" required><br><br>
                                    </div>

                                    <div class="col d-flex flex-column">
                                        <label for="prenom">Prénom :</label>
                                        <input type="text" name="prenom" id="prenom" required><br><br>
                                    </div>
                                </div>

                                <div class=row>
                                    <div class="col d-flex flex-column">
                                        <label for="email">Email :</label>
                                        <input type="email" name="email" id="email" placeholder="Ajouter votre email" required><br><br>
                                    </div>

                                    <div class="col d-flex flex-column">
                                        <label for="motdepasse">Mot de passe :</label>
                                        <input type="password" name="motdepasse" id="motdepasse" required><br><br>
                                    </div>
                                </div>

                                <div class="col d-flex flex-column">
                                    <label for="adresse">Adresse :</label>
                                    <textarea name="adresse" id="adresse" rows="3" required></textarea><br><br>
                                </div>

                                <div class=row>
                                    <div class="col d-flex flex-column">
                                        <label for="codepostal">Code postal :</label>
                                        <input type="text" name="codepostal" id="codepostal" required><br><br>
                                    </div>

                                    <div class="col d-flex flex-column">
                                        <label for="ville">Ville :</label>
                                        <input type="text" name="ville" id="ville" required><br><br>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <input type="submit" value="S'inscrire">
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <?php
    include 'footer.php';
    ?>