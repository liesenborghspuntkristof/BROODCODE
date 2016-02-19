<?php
//src/KristofL/PHPProject/Data/ProductDAO.php

namespace KristofL\PHPProject\Data; 

use KristofL\PHPProject\Entities\Product; 
use KristofL\PHPProject\Data\DBConfig; 
use PDO; 

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProductDAO
 *
 * @author kristof.liesenborghs
 */
class ProductDAO {
    
    public function getAll() {
        $sql = "SELECT productID, productNaam, productOmschrijving, productPrijs FROM producten"; 
        
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD); 
        $resultSet = $dbh->query($sql); 
        $lijst = array(); 
        foreach ($resultSet as $rij) {
            $product = Product::create($rij["productID"], $rij["productNaam"], $rij["productOmschrijving"], $rij["productPrijs"]); 
            array_push($lijst, $product); 
        }
        $dbh = null; 
        return $lijst;
    }
    
    public function getByProductNaam($productnaam) {
        $sql = "SELECT productID, productNaam, productOmschrijving, productPrijs FROM producten WHERE productNaam = :productNaam";
        
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql); 
        $stmt->execute(array(':productNaam' => $productnaam)); 
        $rij = $stmt->fetch(PDO::FETCH_ASSOC); 
        $product = Product::create($rij["productID"], $rij["productNaam"], $rij["productOmschrijving"], $rij["productPrijs"]); 
        $dbh = null; 
        return $product;         
    }
}
