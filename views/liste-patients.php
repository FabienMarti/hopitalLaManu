<?php
include 'parts/header.php';
include '../models/patient.php';
include '../models/appointment.php';
include '../controllers/liste-patientsController.php';
?>
<h1 class="text-center">Liste des patients</h1>
<?php 
if(isset($messageSuccess)){ ?>
        <div class="alert alert-success" role="alert">
          <?= $messageSuccess ?>
        </div>
    <?php } ?>
    <?php if(isset($messageFail)){ ?>
        <div class="alert alert-danger" role="alert">
          <?= $messageFail ?>
        </div>
    <?php } ?>
<form action="" method="POST" class="form-inline my-2 my-lg-0">
    <input class="form-control mr-sm-2" type="text" placeholder="Rechercher" aria-label="Search" name="searchPatientRequest" />
    <input type="date" name="searchbydate" />
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="sendSearch">Go</button>
</form>
<div class="row justify-content-around">
    <table class="table table-striped border col-6 mt-5">
            <?php 
                foreach ($showPatientsInfo as $info) {
                    ?><tr><td>Nom : <?= $info->lastname ?></td>
                    <td>Prénom : <?= $info->firstname ?></td>
                    <td><a href="profil-patient.php?id=<?= $info->id ?>" class="btn btn-primary" role="button" aria-disabled="true">Fiche</a></td>
                    <td><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal" data-whatever="<?= $info->id ?>">Supprimer</button></td></tr><?php
                }?>
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