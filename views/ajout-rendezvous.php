<?php
// include 'models/patient.php';
// include 'controllers/ajout-rendez-vousController.php';
?>

<h1 class="text-center">Ajout rendez-vous</h1>
<form action="" method="POST" class="d-flex justify-content-center mb-5">
    <div class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Rechercher" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="searchPatient"><i class="fas fa-search"></i></button>
    </div>
</form>
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