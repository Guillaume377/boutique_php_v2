<nav class="navbar navbar-expand-lg fixed-top">

  <div class="container-fluid">

    <a class="navbar-brand" href="./index.php"><img src="images/logo BBA.png" alt="Logo"></a> 

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item me-auto">
          <a class="nav-link active" style = "color:brown" aria-current="page" href="./panier.php"><i class="fa-solid fa-cart-shopping" style="color:brown"></i><?= count($_SESSION['panier']) ?></a>
        </li>
    </div>
    <a href="./gammes.php" class="navbar-brand btn btn-ghost-2">Gammes</a>
    <a href="./inscription.php" class="navbar-brand btn btn-ghost-2" >Mon compte</a>
  </div>
</nav>