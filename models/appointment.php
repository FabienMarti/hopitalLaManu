<?php

class appointment {
    public $id = 0;
    public $dateHour = '0000-00-00 00:00:00';

    private $db = NULL;

    public function __construct(){

        try
        {
            // Récupération de la db dans une variable
            $this->db = new PDO('mysql:host=localhost;dbname=hospitalE2N;charset=utf8', 'jess', 'jessplo60');
        }
        catch (Exception $e)
        {
            die('Erreur : ' . $e->getMessage());
        } 
    }

    /******************* CRUD -> C (create) -- CREATION D'UN RDV *******************/
    /* Création d'une méthode permettant de préparer une requête pour ajouter un rendez-vous dans la bdd.
    On utilise prepare dans le cas où on utilise des Marqueurs Nominatifs (':dateHour') pour éviter les failles de sécurité,
    qui est toujours accompagné d'un bindValue permettant de lier une valeur au M.N. que l'on récupère dans la classe avec
    $this->nom de la variable, + la sécurité. 
    Pour finir, on exécute avec return et le nom de la variable de la requête. */
    public function addAppointment() {
        $addAppointmentQuery = $this->db->prepare(
        'INSERT INTO 
            `appointments` (`dateHour`, `idPatients`) 
        VALUES 
            (:dateHour, :idPatients)');
    $addAppointmentQuery->bindValue(':dateHour', $this->dateHour, PDO::PARAM_STR);
    $addAppointmentQuery->bindValue(':idPatients', $this->idPatients, PDO::PARAM_INT);
    return $addAppointmentQuery->execute();
    }
}