<?php 
include 'parts/header.php'; 
include '../models/appointment.php';
include '../controllers/rendezvousController.php';

    if(isset($messageSuccess)){ ?>
        <div class="alert alert-success" role="alert">
            <?= $messageSuccess ?>
        </div>
    <?php }
    
    if(isset($messageFail)){ ?>
        <div class="alert alert-danger" role="alert">
            <?= $messageFail ?>
        </div>
    <?php } ?>
    
        <h1 class="text-center my-5">Profil de <?= $showAppointment->firstname . ' ' . $showAppointment->lastname ?></h1>
            <div class="row justify-content-center text-center">
                <div class="col-6 border border-danger p-5 mb-5">
                    <p><?= $showAppointment->lastname ?></p>
                    <p><?= $showAppointment->firstname ?></p>
                    <p><?= $showAppointment->birthdateFR ?></p>
                    <p><?= $showAppointment->phone ?></p>
                    <p><?= $showAppointment->mail ?></p>
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="date">Date de rendez-vous : </label>
                        <input type="date" id="date" name="date" value="<?= isset($_POST['date']) ? $_POST['date'] : $showAppointment->date ?>">
                        <?php if(isset($formErrors['date'])) { ?>
                            <p><?= $formErrors['date'];
                        } ?></p>
                    </div>
                    <div class="form-group">
                        <label for="hour">Heure de rendez-vous : </label>
                        <input type="time" id="hour" name="hour" value="<?= isset($_POST['hour']) ? $_POST['hour'] : $showAppointment->hour ?>">
                        <?php if(isset($formErrors['hour'])) { ?>
                            <p><?= $formErrors['hour'];
                        } ?></p>
                    </div>
                    <input class="btn btn-primary" type="submit" name="editRDV" value="Modifier" />
                </form>
            </div>
        </div>
</div>

</div>
<?php include 'parts/footer.php' ?>