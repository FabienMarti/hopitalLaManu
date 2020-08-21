<?php 
include 'parts/header.php';
include_once '../models/appointment.php';
include_once '../controllers/liste-rendezvousController.php';
?>
<h1 class="text-center mt-5">Liste des rendez-vous</h1>
<div class="row justify-content-around">
    <table class="table table-striped border col-8 mt-5">
            <?php 
                foreach ($showAppointments as $info) {
                    ?><tr><td><?= $info->dateHour ?></td>
                    <td><?= $info->lastname ?></td>
                    <td><?= $info->firstname ?></td>
                    <td><?= $info->phone ?></td>
                    <td><a href="rendezvous.php?id=<?= $info->aptId ?>" class="btn btn-primary" role="button" aria-disabled="true">Fiche</a></td>
                    <td><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal" data-whatever="<?= $info->aptId ?>">Supprimer</button></td></tr>
            <?php } ?>
    </table>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirmez-vous la suppression ?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label"></label>
                        <input type="hidden" class="form-control" name="recipient-name" id="recipient-name" value="" />
                    </div>
                    <div class="text-center">
                        <input type="submit" name="deleteProfil" value="Supprimer" class="btn btn-danger" />
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include 'parts/footer.php'; ?>