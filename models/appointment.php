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
    public function __construct()
    {
        try {
            $this->db = new PDO('mysql:host=localhost;dbname=hospitalE2N;charset=utf8', 'jess', 'jessplo60');
        } catch (Exception $error) {
            die($error->getMessage());
        }
    }
    //Verif Appointments Exist
    public function checkPatientByAppointment(){
        $query = 'SELECT COUNT(id) AS isAppointmentExist
        FROM appointments
        WHERE id = :id';
          $queryPrepare = $this->db->prepare($query);
          $queryPrepare->bindvalue(':id', $this->id, PDO::PARAM_INT);
          $queryPrepare->execute();
          $data = $queryPrepare->fetch(PDO::FETCH_OBJ);
          return $data->isAppointmentExist;
      }
    //Add Appointment
      public function addAppointment()
    {
        $addAppointmentQuery = $this->db->prepare(
            'INSERT INTO appointments (dateHour,idPatients)
        VALUES(:dateHour, :idPatients)'
        );
        $addAppointmentQuery->bindvalue(':dateHour', $this->dateHour, PDO::PARAM_STR);
        $addAppointmentQuery->bindvalue(':idPatients', $this->idPatients, PDO::PARAM_STR);
        return $addAppointmentQuery->execute();
    }
}

/******************* CRUD -> C (create) -- CREATION D'UN RDV *******************/
    /* Création d'une méthode permettant de préparer une requête pour ajouter un rendez-vous dans la bdd.
    On utilise prepare dans le cas où on utilise des Marqueurs Nominatifs (':dateHour') pour éviter les failles de sécurité,
    qui est toujours accompagné d'un bindValue permettant de lier une valeur au M.N. que l'on récupère dans la classe avec
    $this->nom de la variable (objet de la classe), + la sécurité. 
    Pour finir, on exécute avec return et le nom de la variable de la requête. 
    ->mot() c'est une méthode et ->mot c'est un attribut */