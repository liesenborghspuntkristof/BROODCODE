<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace KristofL\PHPProject\Data;

use KristofL\PHPProject\Entities\Categorie; 
use KristofL\PHPProject\Data\DBConfig; 
use PDO; 
/**
 * Description of CategorieDAO
 *
 * @author kristof
 */
class CategorieDAO {
    
    public function getAll() {
        $sql = "SELECT categorieID, categorieNaam FROM categorieen ORDER BY categorieID ASC";
        
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $resultSet = $dbh->query($sql); 
        $lijst = array(); 
        foreach($resultSet as $rij) {
            $categorie = Categorie::create($rij["categorieID"], $rij["categorieNaam"]); 
            array_push($lijst, $categorie); 
        }
        $dbh = null;
        return  $lijst; 
    }
    
    public function getByCategorieId($categorieId) {
        $sql = "SELECT categorieID, categorieNaam FROM categorieen WHERE categorieID = :categorieID";
        
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql); 
        $stmt->execute(array(':categorieID' => $categorieId)); 
        $rij = $stmt->fetch(PDO::FETCH_ASSOC); 
        $categorie = Categorie::create($rij["categorieID"], $rij["categorieNaam"]); 
        $dbh = null; 
        return $categorie;
    }
}
