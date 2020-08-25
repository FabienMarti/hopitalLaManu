<?php

$patient = new patient();
$appointment = new appointment();

/* Grosse faille, si un utilisateur malveillant décide de tester des IDs dans la modale il peut supprimer
des utilisateurs à volonté .*/

if(isset($_POST['deleteProfil'])){

    //Stock l'id (INT) du patient, récupéré dans la modale de suppression
    $idPatient = htmlspecialchars($_POST['recipient-name']);
    //Assigne l'id du patient à l'attribut idPatients de l'objet (classe) appointment
    $appointment->idPatients = $idPatient;
    //Assigne l'id du patient à l'attribut id de l'objet (classe) patient
    $patient->id = $idPatient;
    
    //Si le patient existe
    if($patient->checkPatientExistById()){
        //Si le patient a des RDVs
        if($appointment->checkAppointmentExistsByIdPatient()){
            $appointment->deleteAppointmentByPatient();
        }
        $patient->deletePatientById();
        $messageSuccess = 'Le patient a bien été supprimé.';
    }else{
        $messageFail = 'Le patient sélectionné n\'exite pas.';
    }
}
$showPatientsInfo = $patient->getAllPatientsInfo();