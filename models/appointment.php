<?php
// la class est la définition de l'objet.
// private: accessible uniquement dans la class.
// protected: accessible dans la class et les enfants.
// public: dispo dans class, enfant et dans les instances.
class appointment
{
    public $id = 0;
    public $dateHour = '0000-00-00 00:00';
    public $idPatients = 0;
    private $db = NULL;

    public function __construct(){
        try {
            $this->db = new PDO('mysql:host=localhost;dbname=hospitalE2N;charset=utf8', 'fmarti', 'nekrose12');
        } catch (Exception $error) {
            die($error->getMessage());
        }
    }
    //Verif Appointments Exist
    public function checkAppointmentExistsById(){
        $queryPrepare = $this->db->prepare( 
            'SELECT 
                COUNT(`id`) AS isAppointmentExist
            FROM 
                `appointments`
            WHERE 
                `id` = :id
        ');
          $queryPrepare->bindvalue(':id', $this->id, PDO::PARAM_INT);
          $queryPrepare->execute();
          $data = $queryPrepare->fetch(PDO::FETCH_OBJ);
          return $data->isAppointmentExist;
      }
    /******************* CRUD -> C (create) -- CREATION D'UN RDV *******************/
    /* Création d'une méthode permettant de préparer une requête pour ajouter un rendez-vous dans la bdd.
    On utilise prepare dans le cas où on utilise des Marqueurs Nominatifs (':dateHour') pour éviter les failles de sécurité,
    qui est toujours accompagné d'un bindValue permettant de lier une valeur au M.N. que l'on récupère dans la classe avec
    $this->nom de la variable (objet de la classe), + la sécurité. 
    Pour finir, on exécute avec return et le nom de la variable de la requête. 
    ->mot() c'est une méthode et ->mot c'est un attribut */
      public function addAppointment(){
        $addAppointmentQuery = $this->db->prepare(
            'INSERT INTO appointments (dateHour,idPatients)
        VALUES(:dateHour, :idPatients)'
        );
        $addAppointmentQuery->bindvalue(':dateHour', $this->dateHour, PDO::PARAM_STR);
        $addAppointmentQuery->bindvalue(':idPatients', $this->idPatients, PDO::PARAM_STR);
        return $addAppointmentQuery->execute();
    }

    public function getAllAppointmentsAndPatient(){
        $getAllAppointmentsAndPatientQuery = $this->db->query(
            'SELECT 
                `apt`.`id` AS `aptId`
                ,`lastname`
                ,`firstname`
                ,`phone`
                ,`dateHour`
                ,`idPatients`
            FROM
                `appointments` AS `apt`
            INNER JOIN `patients` AS `pts` ON `idPatients` = `pts`.`id`
            ');
            return $getAllAppointmentsAndPatientQuery->fetchAll(PDO::FETCH_OBJ);
    }

    public function getAllAppointmentsById(){
        $getAllAppointmentsByIdQuery = $this->db->prepare(
            'SELECT
                `lastname`
                ,`firstname`
                , DATE_FORMAT (`birthdate`, \'%d/%m/%Y\') AS `birthdateFR`
                , `phone`
                , `mail`
                ,`dateHour`
                ,`idPatients`
            FROM
                `appointments` AS `apt`
            INNER JOIN `patients` AS `pts` ON `idPatients` = `pts`.`id`
            WHERE `apt`.`id` = :id
            ');
            $getAllAppointmentsByIdQuery->bindValue(':id', $this->id, PDO::PARAM_INT);
            $getAllAppointmentsByIdQuery->execute();
            return $getAllAppointmentsByIdQuery->fetch(PDO::FETCH_OBJ);
    }

    public function editAppointmentById(){
        $editAppointmentByIdQuery = $this->db->prepare(  
        'UPDATE 
            `appointments`
        SET
            `dateHour` = :dateHour
        WHERE
            `id` = :id
        ');
        $editAppointmentByIdQuery->bindValue('dateHour', $this->dateHour, PDO::PARAM_STR);
        $editAppointmentByIdQuery->bindValue('id', $this->id, PDO::PARAM_INT);
        return $editAppointmentByIdQuery->execute();
    }

    public function deleteAppointmentById(){
        $deleteAppointmentByIdQuery = $this->db->prepare(
            'DELETE FROM
                `appointments`
            WHERE 
                `id` = :id
            ');
            $deleteAppointmentByIdQuery->bindValue(':id', $this->id, PDO::PARAM_INT);
            return $deleteAppointmentByIdQuery->execute();
    }
}