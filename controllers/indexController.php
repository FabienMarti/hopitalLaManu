<?php
/* $arrayTest = array('Profil patient' => 'profil-patient.php', );

$content = 'views/' .  */

//switch pages
    if(!empty($_GET['content'])){
        switch ($_GET['content']) {
            case 'profil-patient':
                $content = 'views/profil-patient.php';
                $pageTitle = 'Profil patient';
            break;
            case 'liste-patients':
                $content = 'views/liste-patients.php';
                $pageTitle = 'Liste des patients';
            break;
            case 'ajout-patient':
                $content = 'views/ajout-patient.php';
                $pageTitle = 'Ajout patient';
            break;
            case 'ajout-rendezvous':
                $content = 'views/ajout-rendezvous.php';
                $pageTitle = 'Ajout rendez-vous';
            break;
            case 'liste-rendezvous':
                $content = 'views/liste-rendezvous.php';
                $pageTitle = 'Liste des rendez-vous';
            break;
            case 'rendezvous':
                $content = 'views/rendezvous.php';
                $pageTitle = 'Rendez-vous';
            break;
            default:
                $content = 'views/home.php';
                $pageTitle = 'Accueil';
        }
    }else{
        $content = 'views/home.php';
        $pageTitle = 'Accueil';
    }