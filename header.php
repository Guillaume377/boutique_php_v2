<nav class="navbar navbar-expand-lg fixed-top">

  <div class="container-fluid">

    <a class="navbar-brand" href="./index.php"><img src="images/logo1.png" alt=""> Boutique des beaux-arts </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item me-auto">
          <a class="nav-link active" style = "color:brown" aria-current="page" href="./panier.php"><i class="fa-solid fa-cart-shopping" style="color:brown"></i><?= count($_SESSION['panier']) ?></a>
        </li>
    </div>
    <a class="navbar-brand" href="./gammes.php">Gammes</a>
    <a class="navbar-brand" href="./connexion.php">Inscription</a>
  </div>
</nav>