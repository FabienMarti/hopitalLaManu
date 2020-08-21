<?php 
include 'parts/header.php';
include_once '../models/appointment.php';
include_once '../controllers/liste-rendezvousController.php';
?>
<h1 class="text-center">Liste des rendez-vous</h1>
<div class="row justify-content-around">
    <table class="table table-striped border col-6 mt-5">
            <?php 
                foreach ($showAppointments as $info) {
                    ?><tr><td><?= $info->dateHour ?></td>
                    <td><?= $info->lastname ?></td>
                    <td><?= $info->firstname ?></td>
                    <td><?= $info->phone ?></td>
                    <td><a href="rendezvous.php?id=<?= $info->aptId ?>" class="btn btn-primary" role="button" aria-disabled="true">Fiche</a></td></tr><?php
                }?>
    </table>
</div>
<?php include 'parts/footer.php'; ?>