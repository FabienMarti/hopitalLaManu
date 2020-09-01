<?php

$patient = new patient();
$appointment = new appointment();
$search = array();

// $pageNumber = $patient->getNumberOfPages();

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
        $patient->deletePatientById();
        $messageSuccess = 'Le patient a bien été supprimé.';
    }else{
        $messageFail = 'Le patient sélectionné n\'exite pas.';
    }
}

if (isset($_GET['page'])){
    $page = $_GET['page'];
}else {
    $page = 1;
}
$limitArray = ['limit'=>5];
$limitArray['offset'] = ($page * $limitArray['limit']) - $limitArray['limit'];
//affiche le resultat de la recherche si le champs de recherche est activer , sinon toute la liste avec la pagination
if(isset($_POST['sendSearch'])) {
    if (!empty($_POST['searchPatientRequest'])){
        $search['lastname'] = htmlspecialchars($_POST['searchPatientRequest']) . '%';
        // $search['firstname'] = htmlspecialchars($_POST['searchPatientRequest']) . '%';
    }
    if (!empty($_POST['searchbydate']) ){
        $search['birthdate'] = htmlspecialchars($_POST['searchbydate']);
    }
    $list = $patient->getAllPatientsInfo($limitArray,$search);
    $pageNumber = ceil(count($patient->getAllPatientsInfo(array(),$search)) / $limitArray['limit']);
}else {
    $list = $patient->getAllPatientsInfo($limitArray);
    $pageNumber = ceil(count($patient->getAllPatientsInfo()) / $limitArray['limit']);
}

/*cas des INT dans recherche : on doit envoyer un tableau de tableaux ou tableau d'objet a la place d'un simple tableau
$tableau['champSQL'][type de données]   exemple ['type']ex: STR   || ['logical']ex: OR   ||  ['value']ex: 'toto' on utilise plus d'implode() */