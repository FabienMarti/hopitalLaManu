<?php
$regexDate = '%^[0-9]{4}-[0-9]{2}-[0-9]{2}$%';
$regexHour = '%^(09|1([0-7])):(00|15|30|45)$%';

// Création d'un tableau d'erreur
$formErrors = array();
// On créé une nouvelle instance de la classe dans la variable $patient qui devient un objet
$patient = new patient();
// On stock le résultat de la méthode getAllPatientsInfo() de l'objet patient dans $patientList qui devient un tableau d'objets
$patientList = $patient->getAllPatientsInfo();

// Si le formulaire est envoyé
if(isset($_POST['addAppointment'])){
    // On créé une nouvelle instance de la classe dans la variable $appointment qui devient un objet
    $appointment = new appointment();
    // Si 'date' contient une valeur
    if(!empty($_POST['date'])){
        // Et que la valeur correspond à la regex
        if(preg_match($regexDate,$_POST['date'])){
            // On stock le résultat de la fonction explode dans $dateExplode 
            // explode créé un tableau à partir d'une chaine de caractères et les séparent à chaque délimiteur, ex : '-'
            $dateExplode = explode('-', $_POST['date']);
            // Si la date est erronée 
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

    // Si le tableau d'erreur est vide
    if(empty($formErrors)){
        /* On stock la concaténation de l'heure et de la date pour la faire correspondre en format SQL
        dans l'attribut dateHour de l'objet $appointment (qui contient l'instance de la classe appointment) */
        $appointment->dateHour = $_POST['date'] . ' ' . $_POST['hour'];
        // Si le rendez-vous est ajouté avec succès avec la méthode addAppointment() de l'objet $appointment
        if($appointment->addAppointment()){
            $messageSuccess = 'Le rendez-vous a bien été ajouté.';
        }else{
            $messageFail = 'Le rendez-vous n\'a pas été ajouté.'; 
        }
    }
}