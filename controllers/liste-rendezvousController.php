<?php
// On créé une nouvelle instance de la classe dans la variable $appointment
$appointment = new appointment();
/* On stock le résultat de la méthode getAllAppointmentsAndPatient() de la classe $appointment (stockée dans une variable)
contenant un tableau d'objets dans $showAppointments */
$showAppointments = $appointment->getAllAppointmentsAndPatient();

if(isset($_POST['deleteProfil'])){
    $appointment->id = htmlspecialchars($_POST['recipient-name']);
    $appointment->deleteAppointmentById();
}