<?php 
include 'parts/header.php'; 
include '../models/appointment.php';
include '../controllers/rendezvousController.php';
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
<h1 class="text-center">Profil de <?= $showAppointment->firstname . ' ' . $showAppointment->lastname ?></h1>
            <ul>
                <li>Nom : <?= $showAppointment->lastname ?></li>
                <li>Prénom : <?= $showAppointment->firstname ?></li>
                <li>Date de naissance : <?= $showAppointment->birthdateFR ?></li>
                <li>Téléphone : <?= $showAppointment->phone ?></li>
                <li>Adresse mail : <?= $showAppointment->mail ?></li>
            </ul>
            <form action="" method="POST">
              <div class="form-group">
                  <label for="date">Date de rendez-vous : </label>
                  <input type="date" id="date" name="date" value="<?= isset($_POST['date']) ? $_POST['date'] : $date ?>">
                  <?php if(isset($formErrors['date'])) { ?>
                      <p><?= $formErrors['date'];
                  } ?></p>
              </div>
              <div class="form-group">
                  <label for="hour">Heure de rendez-vous : </label>
                  <input type="time" id="hour" name="hour" value="<?= isset($_POST['hour']) ? $_POST['hour'] : $hour ?>">
                  <?php if(isset($formErrors['hour'])) { ?>
                      <p><?= $formErrors['hour'];
                  } ?></p>
              </div>
            <input class="btn btn-primary" type="submit" name="editRDV" value="Modifier" />
        </form>
    </div>
</div>
<?php include 'parts/footer.php' ?>