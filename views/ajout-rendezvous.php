<?php
include 'models/patient.php';
include 'models/appointment.php';
include 'controllers/ajout-rendez-vousController.php';
?>
<?php
    if($patientExists == true){ ?>
    <p class="h3 text-center mb-5">Le patient sélectionné est <?= $patient->lastname . ' ' . $patient->firstname?></p>
    <form action="" method="POST">
        <div class="form-group row text-center">
            <div class="col-6">
                <label for="rdvDate">Date du rendez-vous</label>
                <input type="date" id="rdvDate" name="rdvDate" />
            </div>
            <div class="col-6">
                <label for="rdvHour">Heure du rendez-vous</label>
                <select name="rdvHour" id="rdvHour">
                    <?php
                    for ($hour = 8; $hour <= 20; $hour++) {
                        if($hour >= 10){
                            ?><option value="<?= $hour ?>:00:00"><?= $hour ?>h00</option><?php
                        }else{
                            ?><option value="0<?= $hour ?>:00:00"><?= $hour ?>h00</option><?php
                        }
                    }?>
                </select>
            </div>
        </div>
            <div class="text-center mt-5">
                <input type="submit" class="btn btn-primary" value="Ajouter" name="addRdv" />
            </div>
    </form>
   <?php } else{ ?>
    <form action="" method="POST">
        <p class="h4">Etape 1 : Patient</p>
        <div class="row">
            <div class="col form-group md-form">
                <label for="lastname">Nom</label>
                <input type="text" id="lastname" name="lastname" class="form-control" />
            </div>
            <div class="col form-group md-form">
                <label for="firstname">Prénom</label>
                <input type="text" id="firstname" name="firstname" class="form-control" />
            </div>
            <div class="col form-group md-form">
                <label for="mail">Adresse mail</label>
                <input type="email" id="mail" name="mail" class="form-control" />
            </div>
        </div>
        <div class="form-group text-center">
                <input type="submit" name="searchPatient" value="Rechercher" class="btn btn-primary" />
            </div>
        <p class="text-center text-danger font-weight-bold"><?= isset ($message) ? $message : '' ?></p>
    </form>
<?php } ?>
