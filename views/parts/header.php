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
  <link rel="stylesheet" href="<?= ($_SERVER['REQUEST_URI'] == '/' || $_SERVER['REQUEST_URI'] == '/index.php' ) ? '' : '../' ?>assets/css/index.css" />
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
            <a class="nav-link" href="<?= ($_SERVER['REQUEST_URI'] == '/' || $_SERVER['REQUEST_URI'] == '/index.php' ) ? '' : '../' ?>index.php"><i class="fas fa-home"></i></a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Patient</a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="<?= ($_SERVER['REQUEST_URI'] == '/' || $_SERVER['REQUEST_URI'] == '/index.php' ) ? 'views' : '../views' ?>/ajout-patient.php">Ajout patient</a>
              <a class="dropdown-item" href="<?= ($_SERVER['REQUEST_URI'] == '/' || $_SERVER['REQUEST_URI'] == '/index.php' ) ? 'views' : '../views' ?>/liste-patients.php">Liste des patients</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Rendez-vous</a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="<?= ($_SERVER['REQUEST_URI'] == '/' || $_SERVER['REQUEST_URI'] == '/index.php' ) ? 'views' : '../views' ?>/ajout-rendezvous.php">Ajout rendez-vous</a>
              <a class="dropdown-item" href="<?= ($_SERVER['REQUEST_URI'] == '/' || $_SERVER['REQUEST_URI'] == '/index.php' ) ? 'views' : '../views' ?>/liste-rendezvous.php">Liste des rendez-vous</a>
            </div>
          </li>
        </ul>
      </div>
    </nav>
  </div>