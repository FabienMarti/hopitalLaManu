<?php
include 'models/patient.php';
include 'controllers/profil-patientController.php';
?>
<h1 class="text-center">Liste des patients</h1>
<div class="row justify-content-around">
<?php 
    foreach ($showPatientInfo as $sheet) {
        ?><div class="col-5 border border-dark rounded shadow pt-3 my-5">
            <ul>
                <li>Nom : <?= $sheet->lastname ?></li>
                <li>Prénom : <?= $sheet->firstname ?></li>
                <li>Date de naissance : <?= $sheet->birthDateFr ?></li>
                <li>Téléphone : <?= $sheet->phone ?></li>
                <li>Adresse mail : <?= $sheet->mail ?></li>
            </ul>
        </div><?php
    }?>
</div>

