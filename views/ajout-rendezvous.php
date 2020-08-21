<?php 
include_once 'parts/header.php';
require_once '../models/patient.php';
require_once '../models/appointment.php'; 
require_once '../controllers/ajout-rendez-vousController.php';
?>
<body>
    <?php if(isset($messageSuccess)){ ?>
        <div class="alert alert-success" role="alert">
          <?= $messageSuccess ?>
        </div>
    <?php } ?>
    <?php if(isset($messageFail)){ ?>
        <div class="alert alert-danger" role="alert">
          <?= $messageFail ?>
        </div>
    <?php } ?>

    <form class="offset-4 col-4" method="POST" action="ajout-rendezvous.php">
        <div class="form-group">
            <label for="date">Date de rendez-vous : </label>
            <input type="date" id="date" name="date" value="<?= isset($_POST['date']) ? $_POST['date'] : '' ?>">
            <?php if(isset($formErrors['date'])) { ?>
                <p><?= $formErrors['date'];
            } ?></p>
        </div>
        <div class="form-group">
            <label for="hour">Heure de rendez-vous : </label>
            <input type="time" id="hour" name="hour" value="<?= isset($_POST['hour']) ? $_POST['hour'] : '' ?>">
            <?php if(isset($formErrors['hour'])) { ?>
                <p><?= $formErrors['hour'];
            } ?></p>
        </div>
        <div class="form-group">
            <label for="idPatients">Nom de Patient : </label>
            <select id="idPatients" name="idPatients">
                <option disabled selected>Sélectionner</option>
                <?php foreach($patientList as $patientDetails){?>
                    <option value="<?= $patientDetails->id ?>" <?= isset($_POST['idPatients']) && $_POST['idPatients'] == $patientDetails->id ? 'selected' : '' ?>><?= $patientDetails->lastname . ' ' . $patientDetails->firstname . ' - ' . $patientDetails->birthdateFR ?></option>
                <?php } ?>
            </select>
            <?php if(isset($formErrors['idPatients'])) { ?>
                <p><?= $formErrors['idPatients'];
            } ?></p>
        </div>
        <div class="button" class="form-group">
            <button type="submit" name="addAppointment">Ajouter un rendez-vous</button>
        </div>       
    </form>
<?php
include 'parts/footer.php';
?>