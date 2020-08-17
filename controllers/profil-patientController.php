<?php
$patient = new patient();
$idArray = array();

foreach ($patient->getAllPatientsInfo() as $idPatient) {
    array_push($idArray, $idPatient->id);
}

if(isset($_GET['id'])) {
    if(in_array($_GET['id'], $idArray)) {
        $showPatientInfo = $patient->getPatientInfo(htmlspecialchars($_GET['id']));
    }else {
    header ('Location: index.php?content=liste-patients');
    }
}