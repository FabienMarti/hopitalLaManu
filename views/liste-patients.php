<?php
include 'parts/header.php';
include '../models/patient.php';
include '../controllers/liste-patientsController.php';
?>
<h1 class="text-center">Liste des patients</h1>
<div class="row justify-content-around">
    <table class="table table-striped border col-6 mt-5">
            <?php 
                foreach ($showPatientsInfo as $info) {
                    ?><tr><td>Nom : <?= $info->lastname ?></td>
                    <td>Prénom : <?= $info->firstname ?></td>
                    <td><a href="profil-patient.php?id=<?= $info->id ?>" class="btn btn-primary" role="button" aria-disabled="true">Fiche</a></td></tr><?php
                }?>
    </table>
</div>
<?php include 'parts/footer.php'; ?>