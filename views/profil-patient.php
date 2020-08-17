<?php
include 'models/patient.php';
include 'controllers/profil-patientController.php';
?>
<h1 class="text-center">Profil de <?= $showPatientInfo->firstname . ' ' . $showPatientInfo->lastname ?></h1>
<div class="row justify-content-around">
    <div class="col-5 border border-dark rounded shadow pt-3 my-5">
        <ul>
            <li>Nom : <?= $showPatientInfo->lastname ?></li>
            <li>Prénom : <?= $showPatientInfo->firstname ?></li>
            <li>Date de naissance : <?= $showPatientInfo->birthdateFR ?></li>
            <li>Téléphone : <?= $showPatientInfo->phone ?></li>
            <li>Adresse mail : <?= $showPatientInfo->mail ?></li>
        </ul>
    </div>
</div>