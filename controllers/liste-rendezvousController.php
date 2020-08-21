<?php

$appointment = new appointment();
$showAppointments = $appointment->getAllAppointmentsAndPatient();

if(isset($_POST['deleteProfil'])){
    $appointement->id = htmlspecialchars($_POST['recipient-name']);
    $appointment->deleteAppointmentById();
}