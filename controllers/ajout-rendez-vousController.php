<?php
$regexDate = '%^[0-9]{4}-[0-9]{2}-[0-9]{2}$%';
$regexHour = '%^(09|1([0-7])):(00|15|30|45)$%';

$formErrors = array(); //création d'un tableau

$patient = new patient();
$patientList = $patient->getAllPatientsInfo();

if(isset($_POST['addAppointment'])){

    $appointment = new appointment();

    if(!empty($_POST['date'])){
        if(preg_match($regexDate,$_POST['date'])){
            $dateExplode = explode('-', $_POST['date']);
            if(!checkdate($dateExplode[1],$dateExplode[2],$dateExplode[0])){
                $formErrors['date'] = 'Veuillez renseigner une date valide.';
            }
        }else{
            $formErrors['date'] = 'Veuillez renseigner une date au format : jj/mm/aaaa.';
        }
    }else{
        $formErrors['date'] = 'Veuillez renseigner une date.';
    }
    
    if(!empty($_POST['hour'])){
        if(!preg_match($regexHour, $_POST['hour'])) {
            $formErrors['hour'] = 'Veuillez renseigner une heure valide.';
        }
    }else{
        $formErrors['hour'] = 'Veuillez renseigner une heure.';
    }

    if(!empty($_POST['idPatients'])){
        $patient->id = htmlspecialchars($_POST['idPatients']);
        if($patient->checkPatientExistById() == 1){
            $appointment->idPatients = $_POST['idPatients'];
        }else{
            $formErrors['idPatients'] = 'Le patient sélectionné n\'existe pas.';
        }
    }else{
        $formErrors['idPatients'] = 'Veuillez sélectionner un patient.';
    }

    if(empty($formErrors)){
        $appointment->dateHour = $_POST['date'] . ' ' . $_POST['hour'];
        if($appointment->addAppointment()){
            $messageSuccess = 'Le rendez-vous a bien été ajouté.';
        }else{
            $messageFail = 'Le rendez-vous n\'a pas été ajouté.'; 
        }
    }
}