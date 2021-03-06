<?php
$patternGroup = '%^([A-Z]{1}[a-zÀ-ÖØ-öø-ÿ]+)([\-\ ]{1}[A-Z]{1}[a-zÀ-ÖØ-öø-ÿ]+)*$%'; // Regex pour plusieurs champs
$patternMail = '%^[a-zA-Z0-9\._\-]+@[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,10}$%';
$patternPhone = '%^(?:0|\(?\+33\)?\s?|0033\s?)[1-79](?:[\.\-\s]?\d\d){4}$%';
$regexbirthdate = '%^\d{1,2}\/\d{1,2}\/\d{4}$%';
$formErrors = array();
$appointment = new appointment();
$patient = new patient();

if(!empty($_GET['id'])) {
    // On stock la valeur de $_GET['id'] dans l'attribut id de l'objet patient 
    $patient->id = htmlspecialchars($_GET['id']);
    // On vérifie avec la méthode checkPatientExistById que notre patient existe dans notre BDD.
    if ($patient->checkPatientExistById() == '1') {
        // Si le patient existe, on exécute la méthode getPatientInfo(). 
        $showPatientInfo = $patient->getPatientInfo();
    }else {
        // Redirige vers la page liste-patients
        header ('Location: liste-patients.php');
        exit;
    }
    $appointment->idPatients = $patient->id;
    $showAppointmentById = $appointment->getPatientAppointmentsByIdPatients();

}

if(isset($_POST['editProfil'])){
    if(!empty($_POST)){
        if (!empty($_POST['lastname'])) {
            // Si la valeur est présente dans le tableau 
            if (preg_match($patternGroup, $_POST['lastname'])) {
                $patient->lastname = htmlspecialchars($_POST['lastname']);
            }else {
                $formErrors['lastname'] = 'Votre nom de famille est incorrect, exemple : Dupont, De-Sousa';
            }
        }else {
        $formErrors['lastname'] = 'Veuillez renseigner votre nom de famille';
        }
        // Prénom
        if (!empty($_POST['firstname'])) {
            if (preg_match($patternGroup, $_POST['firstname'])) {
                $patient->firstname = htmlspecialchars($_POST['firstname']);
            }else {
                $formErrors['firstname'] = 'Votre prénom est incorrect, exemple : Jean, Marie-Anne';
            }
        }else {
        $formErrors['firstname'] = 'Veuillez renseigner votre prénom';
        }
        // Adresse mail
        if (!empty($_POST['mail'])) {
            if (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
                $patient->mail = htmlspecialchars($_POST['mail']);
            }else {
                $formErrors['mail'] = 'Votre adresse mail est incorrect, exemple : jean-dupont@gmail.com';
            }
        }else {
        $formErrors['mail'] = 'Veuillez renseigner votre adresse mail';
        }
    
        // Numéro de téléphone 
        if (!empty($_POST['phone'])) {
            if (preg_match($patternPhone, $_POST['phone'])) {
                $patient->phone = htmlspecialchars($_POST['phone']);
            }else {
                $formErrors['phone'] = 'Votre numéro de téléphone est incorrect, exemple : 0606060606.';
            }
        }else {
        $formErrors['phone'] = 'Veuillez renseigner votre numéro de téléphone';
        }
    
        if (!empty($_POST['birthdate'])) {
            
            $patient->birthdate = date('Y-d-m', strtotime(htmlspecialchars($_POST['birthdate'])));
            
        } else {
            $formErrors['birthdate'] = 'Merci de renseigner votre date de naissance';
        }
        
        // Modification du patient
        if(empty($formErrors)){
            // On récupère l'id du patient et on le stock dans l'attribut id de l'objet patient
            $patient->id = htmlspecialchars($showPatientInfo->id);
            if($patient->editPatientInfo()){
                $addPatientMessage = 'Le patient a bien été modifié.';
            }else {
                $addPatientMessage = 'Une erreur est survenue pendant l\'enregistrement. Veuillez contacter le service informatique.';
            }
        }
    }
}
