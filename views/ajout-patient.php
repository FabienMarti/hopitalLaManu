<?php 
    include 'models/patient.php';
    include 'controllers/ajout-patientController.php'; 
     
?>
<p class="text-center mt-5"><?= isset($addPatientMessage) ? $addPatientMessage : '' ?></p>
<form action="" method="POST" class="container">
    <div class="row">
        <div class="form-group col-4 <?= count($_POST) > 0 ? (isset($formErrors['lastname']) ? 'has-danger' : 'has-success') : '' ?>">
            <div class="md-form">
                <label for="lastname">Nom</label>
                <input type="text" name="lastname" id="lastname" class="form-control <?= count($_POST) > 0 ? (isset($formErrors['lastname']) ? 'is-invalid' : 'is-valid') : '' ?>" <?= isset($_POST['lastname']) ? 'value="' . $_POST['lastname'] . '"' : '' ?> />
            <?php if (isset($formErrors['lastname'])) { ?>
                <p class="text-danger text-center"><?= $formErrors['lastname'] ?></p>
            <?php } ?>
            </div>
        </div>
        <div class="form-group col-4 <?= count($_POST) > 0 ? (isset($formErrors['firstname']) ? 'has-danger' : 'has-success') : '' ?>">
            <div class="md-form">
                <label for="firstname">Prénom</label>
                <input type="text" name="firstname" id="firstname"  class="form-control <?= count($_POST) > 0 ? (isset($formErrors['firstname']) ? 'is-invalid' : 'is-valid') : '' ?>" <?= isset($_POST['firstname']) ? 'value="' . $_POST['firstname'] . '"' : '' ?> />
            <?php if (isset($formErrors['firstname'])) { ?>
                <p class="text-danger text-center"><?= $formErrors['firstname'] ?></p>
            <?php } ?>
            </div>
        </div>
        <div class="form-group col-4 <?= count($_POST) > 0 ? (isset($formErrors['birthDate']) ? 'has-danger' : 'has-success') : '' ?>">
            <div class="md-form input-with-post-icon">
                <label for="birthDate">Date de naissance</label>
                <input type="text" name="birthDate" id="birthDate" class="form-control <?= count($_POST) > 0 ? (isset($formErrors['birthDate']) ? 'is-invalid' : 'is-valid') : '' ?>" <?= isset($_POST['birthDate']) ? 'value="' . $_POST['birthDate'] . '"' : '' ?> />
            <?php if (isset($formErrors['birthDate'])) { ?>
                <p class="text-danger text-center"><?= $formErrors['birthDate'] ?></p>
            <?php } ?>
                <i class="fas fa-calendar input-prefix" tabindex=0></i>
            </div>
        </div>
    </div>
    <div class="row">
    <div class="form-group col <?= count($_POST) > 0 ? (isset($formErrors['phone']) ? 'has-danger' : 'has-success') : '' ?>">
            <div class="md-form">
                <label for="phone">Téléphone</label>
                <input type="tel" name="phone" id="phone" class="form-control <?= count($_POST) > 0 ? (isset($formErrors['phone']) ? 'is-invalid' : 'is-valid') : '' ?>" <?= isset($_POST['phone']) ? 'value="' . $_POST['phone'] . '"' : '' ?> />
            <?php if (isset($formErrors['phone'])) { ?>
                <p class="text-danger text-center"><?= $formErrors['phone'] ?></p>
            <?php } ?>
            </div>
        </div>
        <div class="form-group col <?= count($_POST) > 0 ? (isset($formErrors['mail']) ? 'has-danger' : 'has-success') : '' ?>">
            <div class="md-form">
                <label for="mail">Adresse e-mail</label>
                <input type="text" name="mail" id="mail"  class="form-control <?= count($_POST) > 0 ? (isset($formErrors['mail']) ? 'is-invalid' : 'is-valid') : '' ?>" <?= isset($_POST['mail']) ? 'value="' . $_POST['mail'] . '"' : '' ?> />
            <?php if (isset($formErrors['mail'])) { ?>
                <p class="text-danger text-center"><?= $formErrors['mail'] ?></p>
            <?php } ?>
            </div>
        </div>
    </div>
    <div class="text-center">
        <input class="btn formBtn" type="submit" value="Enregistrer" name="addPatient" />
    </div>
</form>