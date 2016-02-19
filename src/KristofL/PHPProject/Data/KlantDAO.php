<?php

//src/KristofL/PHPProject/Data/KlantDAO.php

namespace KristofL\PHPProject\Data;

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
        $sql = "SELECT e-mailadres, wachtwoord, voornaam, familienaam, adres, klanten.postID as woonplaats, zipcode, naam, geblokkeerd FROM klanten, woonplaatsen WHERE klanten.postID = woonplaatsen.postID";
        var_dump($sql); 
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $resultSet = $dbh->query($sql); 
        var_dump($resultSet); 
        $lijst = array(); 
        foreach ($resultSet as $rij) {
            $woonplaats = Woonplaats::create($rij["woonplaats"], $rij["zipcode"], $rij["naam"]); 
            $klant = Klant::create($rij["emailadres"], $rij["wachtwoord"], $rij["voornaam"], $rij["familienaam"], $rij["adres"], $woonplaats, $rij["geblokkeerd"]); 
            array_push($lijst, $klant); 
        }
        $dhb = null; 
        return $lijst; 
    }

}
