<?php
include 'parts/header.php';
include '../models/patient.php';
include '../controllers/profil-patientController.php';

?>
<h1 class="text-center mt-5">Profil de <?= $showPatientInfo->firstname . ' ' . $showPatientInfo->lastname ?></h1>
<div class="row justify-content-around">
    <div class="col-5 border border-dark rounded shadow pt-3 my-5">
        <p><?= isset($addPatientMessage) ? $addPatientMessage : '' ?></p>
        <?php
        if (isset($_GET['edit'])) {
            if ($_GET['edit'] == true) { ?>
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="lastname">Nom : </label>
                        <input class="form-control" type="text" id="lastname" name="lastname" value="<?= isset($_POST['lastname']) ? $_POST['lastname'] : $showPatientInfo->lastname ?>" />
                    </div>
                    <div class="form-group">
                        <label for="firstname">Prénom : </label>
                        <input class="form-control" type="text" id="firstname" name="firstname" value="<?= isset($_POST['firstname']) ? $_POST['firstname'] : $showPatientInfo->firstname ?>" />
                    </div>
                    <div class="form-group">
                        <label for="birthdate">Date de naissance : </label>
                        <input class="form-control" type="text" id="birthdate" name="birthdate" value="<?= isset($_POST['birthdate']) ? $_POST['birthdate'] : $showPatientInfo->birthdateFR ?>" />
                    </div>
                    <div class="form-group">
                        <label for="phone">Numéro de téléphone : </label>
                        <input class="form-control" type="text" id="phone" name="phone" value="<?= isset($_POST['phone']) ? $_POST['phone'] : $showPatientInfo->phone ?>" />
                    </div>
                    <div class="form-group">
                        <label for="mail">Adresse mail : </label>
                        <input class="form-control" type="email" id="mail" name="mail" value="<?= isset($_POST['mail']) ? $_POST['mail'] : $showPatientInfo->mail ?>" />
                    </div>
                    <div class="form-group d-flex justify-content-center">
                        <input type="submit" class="btn btn-info mb-2" name="editProfil" value="Enregistrer" />
                    </div>
                </form>
            <?php }
        } else { ?>
            <ul>
                <li>Nom : <?= $showPatientInfo->lastname ?></li>
                <li>Prénom : <?= $showPatientInfo->firstname ?></li>
                <li>Date de naissance : <?= $showPatientInfo->birthdateFR ?></li>
                <li>Téléphone : <?= $showPatientInfo->phone ?></li>
                <li>Adresse mail : <?= $showPatientInfo->mail ?></li>
            </ul>
            <a href="<?= $_SERVER['REQUEST_URI'] ?>&edit=true" class="btn btn-primary">Modifier</a>
            <?php
                foreach ($showAppointmentById as $appointment) { ?>
                    <p><?='Rendez-vous fixé le : ' . $appointment->date . ' à ' . $appointment->hour ?></p>
               <?php } ?>
        <?php } ?>
    </div>
</div>
<?php include 'parts/footer.php'; ?>