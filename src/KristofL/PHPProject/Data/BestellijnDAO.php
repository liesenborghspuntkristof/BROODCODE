<?php
//src\KristofL\PHPProject\Data\BestellijnDAO.php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace KristofL\PHPProject\Data;

use KristofL\PHPProject\Entities\Bestellijn; 
use KristofL\PHPProject\Data\BestellingDAO; 
use KristofL\PHPProject\Data\ProductDAO; 
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
        $bestellingDAO = new BestellingDAO(); 
        $bestelling = $bestellingDAO->getById($bestellingId);
        $productDAO = new ProductDAO();
        foreach ($resultSet as $rij) {         
            $product = $productDAO->getByProductId($rij["productID"]) ; 
            $bestellijn = new Bestellijn($bestelling, $product, $rij["hoeveelheid"]); 
            array_push($lijst, $bestellijn); 
        }
        $dbh = null; 
        return $lijst;
    }
    
    public function setBestellijnen ($bestellingId, $tempBestellijnen ) {
        $sql = "INSERT INTO bestellijnen (bestellingID, productID, hoeveelheid) VALUES (:bestellingID, :productID, :hoeveelheid)";  
        
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $dbh->beginTransaction();
        $stmt = $dbh->prepare($sql); 
        foreach ($tempBestellijnen as $productId => $hoeveelheid) {
            $stmt->execute(array(':bestellingID' => $bestellingId, ':productID' => $productId, ':hoeveelheid' => $hoeveelheid)); 
        }
        $dbh->commit(); 
        // nog een exeption of rollback tussen zetten
        $dbh = null; 
    }
}
