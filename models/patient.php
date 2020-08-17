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
            $this->db = new PDO('mysql:host=localhost;dbname=hospitalE2N;charset=utf8', 'jess', 'jessplo60');
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
        $sth->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
        $sth->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
        $sth->bindValue(':birthdate', $this->birthdate, PDO::PARAM_STR);
        $sth->bindValue(':phone', $this->phone, PDO::PARAM_STR);
        $sth->bindValue(':mail', $this->mail, PDO::PARAM_STR);
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
        $addPatientSameQuery->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
        $addPatientSameQuery->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
        $addPatientSameQuery->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        $addPatientSameQuery->execute();
        $data = $addPatientSameQuery->fetch(PDO::FETCH_OBJ);
        return $data->isPatientExists;
    }

    public function getAllPatientsInfo(){
        $allPatientQuery = $this->db->query(
            'SELECT
                `id`
                , `lastname`
                , `firstname`
            FROM
                `patients`
            ORDER BY `lastname`
            ');
            return $allPatientQuery->fetchAll(PDO::FETCH_OBJ);
    }

    public function getPatientInfo() {
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
            `id` = :id
        ');
        $getPatientQuery->bindvalue(':id', $this->id, PDO::PARAM_STR);
        $getPatientQuery->execute();  
        return $getPatientQuery->fetch(PDO::FETCH_OBJ);
    }
    public function editPatientInfo(){
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
        $editPatientQuery->bindValue(':id', $this->id, PDO::PARAM_INT);
        $editPatientQuery->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
        $editPatientQuery->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
        $editPatientQuery->bindValue(':birthdate', $this->birthdate, PDO::PARAM_STR);
        $editPatientQuery->bindValue(':phone', $this->phone, PDO::PARAM_STR);
        $editPatientQuery->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        return $editPatientQuery->execute();   

    }
}