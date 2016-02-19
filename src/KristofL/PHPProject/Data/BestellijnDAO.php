<?php
//src\KristofL\PHPProject\Data\BestellijnDAO.php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace KristofL\PHPProject\Data;

use KristofL\PHPProject\Entities\Bestellijn;  
use KristofL\PHPProject\Data\DBConfig; 
use PDO; 

/**
 * Description of BestellijnDAO
 *
 * @author kristof.liesenborghs
 */
class BestellijnDAO {
    
    public function getByBestellingId ($bestellingId) {
        $sql = "SELECT bestellingID, productID, hoeveelheid FROM bestellijnen WHERE bestellingID = :bestellingID"; 
        
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD); 
        $stmt = $dbh->prepare($sql); 
        $stmt->execute(array(':bestellingID' => $bestellingId)); 
        $resultSet = $stmt->fetchAll(PDO::FETCH_ASSOC); 
        $lijst = array(); 
        foreach ($resultSet as $rij) {
            $bestellijn = new Bestellijn($rij["bestellingID"], $rij["productID"], $rij["hoeveelheid"]); 
            array_push($lijst, $bestellijn); 
        }
        $dbh = null; 
        return $lijst;
    }
}
