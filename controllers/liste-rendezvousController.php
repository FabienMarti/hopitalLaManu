<?php

$appointment = new appointment();
$showAppointments = $appointment->getAllAppointmentsAndPatient();

if(isset($_POST['deleteProfil'])){
    $appointment->id = htmlspecialchars($_POST['recipient-name']);
    $appointment->deleteAppointmentById();
}