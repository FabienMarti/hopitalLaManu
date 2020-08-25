<?php
$patternGroup = '%^([A-Z]{1}[a-zÀ-ÖØ-öø-ÿ]+)([\-\ ]{1}[A-Z]{1}[a-zÀ-ÖØ-öø-ÿ]+)*$%'; // Regex pour plusieurs champs
$patternMail = '%^[a-zA-Z0-9\._\-]+@[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,10}$%';
$patternPhone = '%^(?:0|\(?\+33\)?\s?|0033\s?)[1-79](?:[\.\-\s]?\d\d){4}$%';
$regexbirthdate = '%^\d{1,2}\/\d{1,2}\/\d{4}$%';
$formErrors = array();

// Si le formulaire est envoyé
if(isset($_POST['addPatient'])) {
    // On créé une nouvelle instance de la classe dans la variable $patient
    $patient = new patient();
    // Si 'lastname' contient une valeur
    if (!empty($_POST['lastname'])) {
        // Et que la valeur correspond à la regex
        if (preg_match($patternGroup, $_POST['lastname'])) {
            // On stock la valeur de 'lastname' dans l'attribut de $patient
            $patient->lastname = htmlspecialchars($_POST['lastname']);
        }else {
            $formErrors['lastname'] = 'Votre nom de famille est incorrect, exemple : Dupont, De-Sousa';
        }
    }else {
    $formErrors['lastname'] = 'Veuillez renseigner votre nom de famille';
    }
    // Prénom
    if (!empty($_POST['firstname'])) {
        if (preg_match($patternGroup, $_POST['firstname'])) {
            $patient->firstname = htmlspecialchars($_POST['firstname']);
        }else {
            $formErrors['firstname'] = 'Votre prénom est incorrect, exemple : Jean, Marie-Anne';
        }
    }else {
    $formErrors['firstname'] = 'Veuillez renseigner votre prénom';
    }
    // Adresse mail
    if (!empty($_POST['mail'])) {
        if (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
            $patient->mail = htmlspecialchars($_POST['mail']);
        }else {
            $formErrors['mail'] = 'Votre adresse mail est incorrect, exemple : jean-dupont@gmail.com';
        }
    }else {
    $formErrors['mail'] = 'Veuillez renseigner votre adresse mail';
    }

    // Numéro de téléphone 
    if (!empty($_POST['phone'])) {
        if (preg_match($patternPhone, $_POST['phone'])) {
            $patient->phone = htmlspecialchars($_POST['phone']);
        }else {
            $formErrors['phone'] = 'Votre numéro de téléphone est incorrect, exemple : 0606060606.';
        }
    }else {
    $formErrors['phone'] = 'Veuillez renseigner votre numéro de téléphone';
    }

    if (!empty($_POST['birthDate'])) {
        $patient->birthdate = date('Y-d-m', strtotime(htmlspecialchars($_POST['birthDate'])));
    } else {
        $formErrors['birthDate'] = 'Merci de renseigner votre date de naissance';
    }
    
    // Si le tableau d'erreur est vide
    if(empty($formErrors)){
        // Exécute la méthode checkPatientExists qui retourne 1 si le patient existe déjà ou 0 s'il n'existe pas
        // Si aucun patient identique n'existe
        if(!$patient->checkPatientExists()) {
            // On exécute la méthode addPatient dans $patient (se trouvant dans le model patient)
            if($patient->addPatient()){
            $addPatientMessage = 'Le patient a bien été enregistré.';
            }else {
                $addPatientMessage = 'Une erreur est survenue pendant l\'enregistrement. Veuillez contacter le service informatique.';
            }
        } else {
            $addPatientMessage = 'Le patient a déjà été ajouté.';
        }
    }
}