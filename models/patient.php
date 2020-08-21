<?php
class patient{

    public $id = 0;
    public $firstname = '';
    public $lastname = '';
    public $birthdate = '0000-00-00';
    public $phone = '';
    public $mail = '';
    private $db = NULL;

    public function __construct(){

        try
        {
            //récupération de la db dans une variable
            $this->db = new PDO('mysql:host=localhost;dbname=hospitalE2N;charset=utf8', 'fmarti', 'nekrose12');
        }
        catch (Exception $e)
        {
            die('Erreur : ' . $e->getMessage());
        } 
    }
/******************* CRUD -> C (create) -- CREATION D'UN PATIENT *******************/
    public function addPatient(){    
        //On sépare la requête en deux parties
        //On prépare la requête sans utiliser de variables extérieures, en utilisant des marqueurs nominatifs
        //$this permet de sélectionner les éléments de la classe du fichier
        $sth = $this->db->prepare(
        'INSERT INTO `patients`(`lastname`, `firstname`, `birthdate`, `phone`, `mail`)
        VALUES(:lastname, :firstname, :birthdate, :phone, :mail)');

        //On définie la valeur de nos marqueurs nominatifs
        $sth->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
        $sth->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
        $sth->bindValue(':birthdate', $this->birthdate, PDO::PARAM_STR);
        $sth->bindValue(':phone', $this->phone, PDO::PARAM_STR);
        $sth->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        //On retourne le resultat de la méthode executée
        return $sth->execute(); 
    }
/******************* VERIFICATION DE DOUBLONS *******************/
public function checkPatientExists(){
        //On prépare la méthode
        $addPatientSameQuery = $this->db->prepare(
            'SELECT 
                COUNT(`id`) AS `isPatientExists`
            FROM 
                `patients` 
            WHERE
                `lastname`= :lastname
            AND
                `firstname`= :firstname
            AND
                `mail`= :mail
            ');
        //On définie la valeur de nos marqueurs nominatifs
        $addPatientSameQuery->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
        $addPatientSameQuery->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
        $addPatientSameQuery->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        $addPatientSameQuery->execute();
        $data = $addPatientSameQuery->fetch(PDO::FETCH_OBJ);
        //On retourne isPatientExists sous la forme d'un booleen
        /* Count retourne un 0 ou un 1, on cherche dans la table 'patients' notre saisie, 
        avec son nom, prénom et mail. Si une correspondance est trouvée, l'id sera dupliquée et le COUNT retournera 1 */
        return $data->isPatientExists;
    }

/******************* CRUD -> R (read) -- LECTURE TOUTE LA TABLE PATIENTS *******************/
//Query quand l'utilisateur n'envoie pas lui même de données, Prepare -- bindValue -- execute quand l'utilisateur envoie des données
//pour passer par la sécurité PARAM et des marqueurs nominatifs.
public function getAllPatientsInfo(){
        $allPatientQuery = $this->db->query(
            'SELECT
                `id`
                , `lastname`
                , `firstname`
                , `mail`
                , DATE_FORMAT (`birthdate`, \'%d/%m/%Y\') AS `birthdateFR`
            FROM
                `patients`
            ORDER BY `lastname`
            ');
            return $allPatientQuery->fetchAll(PDO::FETCH_OBJ);
    }
/******************* CRUD -> R (read) -- VERIFIER EXISTENCE ID *******************/
    public function checkPatientExistById() {
        $checkPatientIdQuery = $this->db->prepare(
            'SELECT COUNT(`id`) AS `isPatientIdExist`
            FROM
                `patients`
            WHERE
                `id` = :id
        ');
        $checkPatientIdQuery->bindValue(':id', $this->id, PDO::PARAM_INT); // INT pour les nombres entiers
        $checkPatientIdQuery->execute();  
        $data = $checkPatientIdQuery->fetch(PDO::FETCH_OBJ);
        return $data->isPatientIdExist;
    }
/******************* CRUD -> R (read) -- LECTURE DE 1 PATIENT *******************/
    public function getPatientInfo() {
        $getPatientQuery = $this->db->prepare(
        'SELECT 
            `id`
            , `lastname`
            , `firstname`
            , DATE_FORMAT (`birthdate`, \'%d/%m/%Y\') AS `birthdateFR`
            , `phone`
            , `mail`
        FROM 
            `patients`
        WHERE 
            `id` = :id
        ');
        $getPatientQuery->bindValue(':id', $this->id, PDO::PARAM_INT); // INT pour les nombres entiers
        $getPatientQuery->execute();  
        return $getPatientQuery->fetch(PDO::FETCH_OBJ);
    }

/******************* CRUD -> U (update) -- EDITION D'UN PATIENT *******************/
    public function editPatientInfo(){
        //On sépare la requete en deux
        $editPatientQuery = $this->db->prepare(
            'UPDATE
                `patients`
            SET 
                `lastname` = :lastname
                ,`firstname` = :firstname
                ,`birthdate` = :birthdate
                ,`phone` = :phone
                ,`mail` = :mail
            WHERE `id`= :id 
            ');
            //On choisi les colonnes que l'on souhaite modifier avec SET, on leur attribue un marqueur nominatif ':  ' 
            // avec un bindValue on donne des valeurs à nos marqueurs nominatifs puis on execute();
        $editPatientQuery->bindValue(':id', $this->id, PDO::PARAM_INT);
        $editPatientQuery->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
        $editPatientQuery->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
        $editPatientQuery->bindValue(':birthdate', $this->birthdate, PDO::PARAM_STR);
        $editPatientQuery->bindValue(':phone', $this->phone, PDO::PARAM_STR);
        $editPatientQuery->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        return $editPatientQuery->execute();   
    }

    public function getPatientByName(){
        $getPatient = $this->db->prepare(
            'SELECT
                `id`
            FROM
                `patients`
            WHERE 
                `lastname` = :lastname
                AND `firstname` = :firstname
                AND `mail` = :mail
        ');
        $getPatient->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
        $getPatient->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
        $getPatient->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        $getPatient->execute();
        $data =  $getPatient->fetch(PDO::FETCH_OBJ);
        //hydratation, on verifie que $data contient un objet puis on redefini notre id dans la classe avec l'id récupéré
        if(is_object($data)){
            $this->id = $data->id;
            return true;
        }else{
            return false;
        }
    }

    public function getPatientAppointments(){
        $getPatientAppointmentsQuery = $this->db->prepare(
            'SELECT 
                `pts`.`id`
                , DATE_FORMAT(`dateHour`, \'%d/%m/%Y\') AS `date`
                , DATE_FORMAT(`dateHour`, \'%H:%i\') AS `hour`
            FROM
                `patients` AS `pts`
            INNER JOIN `appointments` AS `apt` ON `pts`.`id` = `apt`.`idPatients`
            WHERE `pts`.`id` = :id
            ORDER BY `date` ASC
            ');
        $getPatientAppointmentsQuery->bindValue(':id', $this->id, PDO::PARAM_INT);
        $getPatientAppointmentsQuery->execute();
        return $getPatientAppointmentsQuery->fetchAll(PDO::FETCH_OBJ);
    } 
}