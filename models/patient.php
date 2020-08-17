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

    public function addPatient(){
        $sth = $this->db->prepare(
        'INSERT INTO `patients`(`lastname`, `firstname`, `birthdate`, `phone`, `mail`)
        VALUES(:lastname, :firstname, :birthdate, :phone, :mail)');
        $sth->bindvalue(':lastname', $this->lastname, PDO::PARAM_STR);
        $sth->bindvalue(':firstname', $this->firstname, PDO::PARAM_STR);
        $sth->bindvalue(':birthdate', $this->birthdate, PDO::PARAM_STR);
        $sth->bindvalue(':phone', $this->phone, PDO::PARAM_STR);
        $sth->bindvalue(':mail', $this->mail, PDO::PARAM_STR);
        return $sth->execute(); 
    }

    public function checkPatientExists(){
        $addPatientSameQuery = $this->db->prepare(
            'SELECT 
                COUNT(`id`) AS `ìsPatientExists`
            FROM 
                `patients` 
            WHERE
                `lastname`= :lastname
            AND
                `firstname`= :firstname
            AND
                `mail`= :mail
            ');
        $addPatientSameQuery->bindvalue(':lastname', $this->lastname, PDO::PARAM_STR);
        $addPatientSameQuery->bindvalue(':firstname', $this->firstname, PDO::PARAM_STR);
        $addPatientSameQuery->bindvalue(':mail', $this->mail, PDO::PARAM_STR);
        $addPatientSameQuery->execute();
        $data = $addPatientSameQuery->fetch(PDO::FETCH_OBJ);
        return $data->isPatientExists;
        var_dump($data->isPatientExists);
    }

    public function getAllPatientsInfo(){
        $allPatientQuery = $this->db->query(
            'SELECT
                `id`
                , `lastname`
                , `firstname`
            FROM
                `patients`
            ');
            return $allPatientQuery->fetchAll(PDO::FETCH_OBJ);
    }

    public function getPatientInfo($id) {
        $getPatientQuery = $this->db->query(
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
            `id` = '.$id
        );
        return $getPatientQuery->fetch(PDO::FETCH_OBJ);
    }

    public function editPatientInfo($id){
        $editPatientQuery = $this->db->prepare(
            'UPDATE
                `patients`
            SET
                `lastname` = :lastname
                ,`firstname` = :firstname
                ,`birthdate` = :birthdate
                ,`phone` = :phone
                ,`mail` = :mail
            WHERE `id`=' . $id
            );
        $editPatientQuery->bindvalue(':lastname', $this->lastname, PDO::PARAM_STR);
        $editPatientQuery->bindvalue(':firstname', $this->firstname, PDO::PARAM_STR);
        $editPatientQuery->bindvalue(':birthdate', $this->birthdate, PDO::PARAM_STR);
        $editPatientQuery->bindvalue(':phone', $this->phone, PDO::PARAM_STR);
        $editPatientQuery->bindvalue(':mail', $this->mail, PDO::PARAM_STR);
        return $editPatientQuery->execute();      
    }
}