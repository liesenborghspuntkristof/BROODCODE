<?php

//src/KristofL/PHPProject/Data/KlantDAO.php

namespace KristofL\PHPProject\Data;

use KristofL\PHPProject\Data\DBConfig; 
use KristofL\PHPProject\Entities\Klant;
use KristofL\PHPProject\Entities\Woonplaats;
use PDO;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of KlantDAO
 *
 * @author kristof.liesenborghs
 */
class KlantDAO {

    public function getAll() {
        $sql = "SELECT emailadres, wachtwoord, voornaam, familienaam, adres, klanten.postID as woonplaatsID, zipcode, naam, geblokkeerd FROM klanten, woonplaatsen WHERE klanten.postID = woonplaatsen.postID";
//        var_dump($sql); 
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $resultSet = $dbh->query($sql); 
//        var_dump($resultSet); 
        $lijst = array(); 
        foreach ($resultSet as $rij) {
            $woonplaats = Woonplaats::create($rij["woonplaatsID"], $rij["zipcode"], $rij["naam"]); 
            $klant = Klant::create($rij["emailadres"], $rij["wachtwoord"], $rij["voornaam"], $rij["familienaam"], $rij["adres"], $woonplaats, $rij["geblokkeerd"]); 
            array_push($lijst, $klant); 
        }
        $dhb = null; 
        return $lijst; 
    }
    
    public function getByEmailadres($emailadres) {
        $sql = "SELECT emailadres, wachtwoord, voornaam, familienaam, adres, klanten.postID as woonplaatsID, zipcode, naam, geblokkeerd FROM klanten, woonplaatsen WHERE klanten.postID = woonplaatsen.postID AND emailadres = :emailadres";
//        var_dump($sql); 
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql); 
        $stmt->execute(array(':emailadres' => $emailadres)); 
        $rij = $stmt->fetch(PDO::FETCH_ASSOC); 
        $woonplaats = Woonplaats::create($rij["woonplaatsID"], $rij["zipcode"], $rij["naam"]); 
        $klant = Klant::create($rij["emailadres"], $rij["wachtwoord"], $rij["voornaam"], $rij["familienaam"], $rij["adres"], $woonplaats, $rij["geblokkeerd"]); 
        $dbh = null; 
        return $klant; 
    }

}
