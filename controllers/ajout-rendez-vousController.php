<?php
$patternGroup = '%^([A-Z]{1}[a-zÀ-ÖØ-öø-ÿ]+)([\-\ ]{1}[A-Z]{1}[a-zÀ-ÖØ-öø-ÿ]+)*$%'; // Regex pour plusieurs champs

$patient = new patient();
$appointment = new appointment();


$formErrors = array();

$patientExists = false;

if(isset($_POST['searchPatient'])) {
    if(!empty($_POST)) {
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

        //adresse mail
        if (!empty($_POST['mail'])) {
            if (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
                $patient->mail = htmlspecialchars($_POST['mail']);
            }else {
                $formErrors['mail'] = 'Votre adresse mail est incorrect, exemple : jean-dupont@gmail.com';
            }
        }else {
        $formErrors['mail'] = 'Veuillez renseigner votre adresse mail';
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

if(isset($_POST['addRdv'])) {
    if(!empty($_POST)) {
        // Date
        if(!empty($_POST['rdvDate'])){
            $date = date('Y-d-m', strtotime(htmlspecialchars($_POST['rdvDate'])));
        }else {
            $formErrors['rdvDAte'] = 'Veuillez renseigner une date';
        }
        // Heure
        if(isset($_POST['rdvHour'])){
            $hour = htmlspecialchars($_POST['rdvHour']);
        }else {
            $formErrors['rdvDAte'] = 'Veuillez renseigner une heure';
        }
        
        if(empty($formErrors)) {
            $dateHourInput = $date . ' ' . $hour; //0000-00-00 00:00:00, on concatene pour obtenir le format SQL pour dateTime
            $appointment->dateHour = $dateHourInput; //$appointment = nouvelle instance de la classe appointment 
            $appointment->idPatients = $patient->id; //
            $appointment->addAppointment();
            var_dump($patient->id);
        }else {
            $errorAddRdv = 'Une erreur est survenue, merci de vérifier si votre saisie est correcte. Si l\'erreur persiste, merci de contacter le service technique.';
        }
    }
} 