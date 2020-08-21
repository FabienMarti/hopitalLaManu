<?php 
include_once 'parts/header.php';
require_once '../models/patient.php';
require_once '../models/appointment.php'; 
require_once '../controllers/ajout-rendez-vousController.php';
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout Rendezvous</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css" />
</head>
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
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<?php
include 'parts/footer.php';
?>
</body>
</html>