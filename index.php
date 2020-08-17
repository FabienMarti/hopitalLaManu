<?php include 'controllers/indexController.php' ?>
<!DOCTYPE html>
<html lang="FR" dir=ltr>
<!-- Head -->
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <title><?= isset($pageTitle) ? $pageTitle : 'Non-défini' ?></title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.18.0/css/mdb.min.css" />
  <!-- Your custom styles (optional) -->
  <link rel="stylesheet" href="assets/css/index.css" />
</head>
<!-- Début body -->
<body class="shadow mb-5 container p-0">
  <div id="headerBG" class="row m-0">
    <div class="col-4">
      <img id="logo" class="px-0 img-fluid" src="assets/img/logo.png" alt="" />
    </div>
    <div class="col text-white text-right my-auto font-weight-bold">
      <ul style="list-style: none;">
        <li>Hôpital LA MANU</li>
        <li>Tel : 03.44.25.52.25</li>
        <li>E-mail : hopital-e2n@gh.com</li>
      </ul>
    </div>
  </div>
  <!-- NavBar -->
  <div class="p-0">
    <nav class="navbar navbar-expand-lg">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mx-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.php?content=home"><i class="fas fa-home"></i></a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Patient</a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="index.php?content=ajout-patient">Ajout patient</a>
              <a class="dropdown-item" href="index.php?content=liste-patients">Liste des patients</a>
              <a class="dropdown-item" href="index.php?content=profil-patient">Profil patient</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Rendez-vous</a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="index.php?content=ajout-rendezvous">Ajout rendez-vous</a>
              <a class="dropdown-item" href="index.php?content=liste-rendezvous">Liste des rendez-vous</a>
              <a class="dropdown-item" href="index.php?content=rendezvous">Rendez-vous</a>
            </div>
          </li>
        </ul>
      </div>
    </nav>
  </div>
  <!-- Contenu-->
  <section class="p-5">
    <?php
    include $content;
    ?>
  </section>
  <!-- Début du footer -->
  <footer class="text-white">
    <div class="socials">
      <div class="container-fluid">
        <div class="row text-center py-4">
          <div class="col-lg-6 mb-4 mb-lg-0">
            <p class="networks mb-0 font-weight-bold">Rejoignez-nous sur les réseaux sociaux !</p>
          </div>
          <div class="col-lg-6">
            <!-- Facebook -->
            <a class="facebook">
              <i class="fab fa-facebook-f mr-4"> </i>
            </a>
            <!-- Twitter -->
            <a class="twitter">
              <i class="fab fa-twitter mr-4"> </i>
            </a>
            <!--Instagram-->
            <a class="instagram">
              <i class="fab fa-instagram"> </i>
            </a>
          </div>
        </div>
      </div>
    </div>
    <!-- Liens -->
    <div class="container text-center text-lg-left mt-5 pl-5">
      <div class="row">
        <!-- Liens part1 -->
        <div class="footerPart1 col-md-4 col-lg-4 mx-auto mb-4">
          <p class="title mb-4 text-uppercase font-weight-bold">Hôpital</p>
          <ul>
            <li class="mb-4"><a href="#!">Accueil</a></li>
            <li class="mb-4"><a href="#!">Plan du site</a></li>
            <li class="mb-4"><a href="#!">Plan d'accès</a></li>
            <li><a href="#!">Mentions légales</a></li>
          </ul>
        </div>
        <!-- Fin des liens part1 -->
        <!-- Liens part2 -->
        <div class="footerPart2 col-md-4 col-lg-4 mx-auto mb-4">
          <p class="title mb-4 text-uppercase font-weight-bold">E2N</p>
          <ul>
            <li class="mb-4"><a href="#!">Actualités</a></li>
            <li class="mb-4"><a href="#!">Offres d'emploi</a></li>
            <li class="mb-4"><a href="#!">F.A.Q</a></li>
            <li><a href="#!">Aide !</a></li>
          </ul>
        </div>
        <!-- Fin des liens part2 -->
        <!-- Liens part3 -->
        <div class="col-md-4 col-lg-4 mx-auto mb-4">
          <p class="title mb-4 text-uppercase font-weight-bold">Contact</p>
          <ul class="contact">
            <li class="mb-4"><i class="fas fa-home mr-3"></i> 17 rue de l'hôpital psychiatrique</li>
            <li class="mb-4"><i class="fas fa-envelope mr-3"></i> hopital-e2n@gh.com</li>
            <li><i class="fas fa-phone mr-3"></i> 03.44.25.52.25</li>
          </ul>
        </div>
        <!-- Fin des liens part3 -->
      </div>
    </div>
    <!-- Fin des liens -->
    <!-- Copyright -->
    <div class="footerCopyright title text-center py-3">©<?= date('Y') ?> HôpitalE2N</div>
    <!-- Fin de copyright -->
  </footer>
  <!-- Scripts -->
  <!-- jQuery -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>
  <!-- Your custom scripts (optional) -->
  <script type="text/javascript"></script>
</body>
</html>