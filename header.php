<nav class="navbar navbar-expand-lg fixed-top" data-bs-theme="dark">

  <div class="container-fluid">

    <a class="navbar-brand" href="./index.php"><img src="images/logo BBA.png" alt="Logo">
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <?php
    if (isset($_SESSION['client']['id'])) {
      echo "Bienvenue " . $_SESSION['client']['prenom'] . " " . $_SESSION['client']['nom'] . "!";
    }
    ?>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <a href="./index.php" class="button-nav navbar-brand btn btn-ghost-2">Accueil</a>
        <a href="./gammes.php" class="button-nav navbar-brand btn btn-ghost-2">Gammes</a>

        <?php
        if (isset($_SESSION['client']['id'])) {
          echo "<a href=\"./moncompte.php\" class=\"button-nav navbar-brand btn btn-ghost-2\">Mon compte</a>";

          echo "<form method=\"POST\" action=\"./index.php\">
          <button type=\"submit\" name=\"deconnexion\" class=\"navbar-brand btn btn-ghost-2\">
            Déconnexion
          </button>
          </form>";
        } else {
          echo "<a href=\"./inscription.php\" class=\"button-nav navbar-brand btn btn-ghost-2\">Connexion / Inscription</a>";
        }
        ?>

        <li class="nav-item me-auto">
          <a class="nav-link active" style="color:brown" aria-current="page" href="./panier.php"><i class="fa-solid fa-cart-shopping" style="color:brown"></i><?= count($_SESSION['panier']) ?>
          </a>
        </li>
      </ul>
    </div>



  </div>

</nav>