<?php
$patient = new patient();
$appointment = new appointment();

$showPatientsInfo = $patient->getAllPatientsInfo();

if(isset($_POST['Supprimer'])){

    $idPatient = htmlspecialchars($_POST['recipient-name']);

    $appointment->idPatients = $idPatient;
    $appointment->deleteAppointmentByPatient();
    $patient->id = $idPatient;
    $patient->deletePatientById();


    var_dump($idPatient);















}