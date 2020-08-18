<?php
$patternGroup = '%^([A-Z]{1}[a-zÀ-ÖØ-öø-ÿ]+)([\-\ ]{1}[A-Z]{1}[a-zÀ-ÖØ-öø-ÿ]+)*$%'; // Regex pour plusieurs champs

$patient = new patient();

$formErrors = array();

$patientId = 0;

$patientExists = false;
if(isset($_POST['searchPatient'])){
    if(!empty($_POST)){
        
        //Nom
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

        //Prénom
        if (!empty($_POST['firstname'])) {
            if (preg_match($patternGroup, $_POST['firstname'])) {
                $patient->firstname = htmlspecialchars($_POST['firstname']);
            }else {
                $formErrors['firstname'] = 'Votre prénom est incorrect, exemple : Jean, Marie-Anne';
            }
        }else {
            $formErrors['firstname'] = 'Veuillez renseigner votre prénom';
        }

        if(empty($formErrors)){
            if($patient->getPatientByName()){
                $patientId = $patient->id;
                $patientExists = true;
            }else{
                $message = 'Une erreur est survenue, merci de vérifier si le patient existe ou si votre saisie est correcte';
            }
        }
    }
}