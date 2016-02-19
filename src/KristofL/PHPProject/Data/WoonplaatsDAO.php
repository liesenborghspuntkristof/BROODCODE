<?php
//src\KristofL\PHPProject\Data\WoonplaatsDAO.php

namespace KristofL\PHPProject\Data; 

use KristofL\PHPProject\Data\DBConfig;
use KristofL\PHPProject\Entities\Woonplaats; 
use PDO; 

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of WoonplaatsDAO
 *
 * @author kristof.liesenborghs
 */
class WoonplaatsDAO {
    
    public function getAll() {
        $sql = "SELECT postID, zipcode, naam FROM woonplaatsen";
        
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $resultSet = $dbh->query($sql); 
        $lijst = array(); 
        foreach($resultSet as $rij) {
            $woonplaats = Woonplaats::create($rij["postID"], $rij["zipcode"], $rij["naam"]); 
            array_push($lijst, $woonplaats); 
        }
        $dbh = null;
        return  $lijst; 
    }
    
    public function getByPostId($postId) {
        $sql = "SELECT postID, zipcode, naam FROM woonplaatsen WHERE postID = :postID";
        
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql); 
        $stmt->execute(array(':postID' => $postId)); 
        $rij = $stmt->fetch(PDO::FETCH_ASSOC); 
        $woonplaats = Woonplaats::create($rij["postID"], $rij["zipcode"], $rij["naam"]); 
        $dbh = null; 
        return $woonplaats;
    }
    
    public function getByZipcode($zipcode) {
        $sql = "SELECT postID, zipcode, naam FROM woonplaatsen WHERE zipcode = :zipcode";
        
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql); 
        $stmt->execute(array(':zipcode' => $zipcode)); 
        $rij = $stmt->fetch(PDO::FETCH_ASSOC); 
        $woonplaats = Woonplaats::create($rij["postID"], $rij["zipcode"], $rij["naam"]); 
        $dbh = null; 
        return $woonplaats;
    }
}
