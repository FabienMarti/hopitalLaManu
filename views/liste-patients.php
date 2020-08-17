<?php
include 'models/patient.php';
include 'controllers/liste-patientsController.php';
?>
<h1 class="text-center">Liste des patients</h1>
<div class="row justify-content-around">
    <table class="table table-striped border col-6">
            <?php 
                foreach ($showPatientInfo as $info) {
                    ?><tr><td>Nom : <?= $info->lastname ?></td>
                    <td>Prénom : <?= $info->firstname ?></td></tr><?php
                }?>
    </table>
</div>

