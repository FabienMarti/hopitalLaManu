<?php 
$regexDate = '%^[0-9]{4}-[0-9]{2}-[0-9]{2}$%';
$regexHour = '%^(09|1([0-7])):(00|15|30|45)$%';
$formErrors = array();

//créé une nouvelle instance temporaire qui se ré-initialise à l'actualisation de la page
$appointment = new appointment();


if(!empty($_GET['id'])) {
    //on stock la valeur de $_GET['id'] dans l'attribut id de l'objet patient 
    $appointment->id = htmlspecialchars($_GET['id']);
    //on vérifie avec la méthode checkAppointmentExistsById que notre rdv existe dans notre BDD.
    if($appointment->checkAppointmentExistsById() == '1') {
        //si le rdv existe, on execute la méthode getAllAppointmentsById. 
        $showAppointment = $appointment->getAllAppointmentsById();
        $datehourArray = explode(' ', $showAppointment->dateHour);
        $date = $datehourArray[0];
        $hour = date('H:i', strtotime($datehourArray[1]));
    }else{
        //redirige vers la page liste-patients
        header ('Location: liste-rendezvous.php');
        exit;
    }
}

if(isset($_POST['editRDV'])){        
    
    if(!empty($_POST)){

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

        if(empty($formErrors)){
            $appointment->dateHour = $_POST['date'] . ' ' . $_POST['hour'];
            if($appointment->editAppointmentById()){
                $messageSuccess = 'Le rendez-vous a bien été modifié.';
            }else{
                $messageFail = 'Le rendez-vous n\'a pas été modifié.'; 
            }
        }
    }
}