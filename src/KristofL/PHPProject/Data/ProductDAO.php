<?php
//src/KristofL/PHPProject/Data/ProductDAO.php

namespace KristofL\PHPProject\Data; 

use KristofL\PHPProject\Entities\Product; 
use KristofL\PHPProject\Entities\Categorie; 
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
        $sql = "SELECT productID, productNaam, productOmschrijving, productPrijs, producten.categorieID as categorieNR, categorieNaam FROM producten, categorieen WHERE producten.categorieID = categorieen.categorieID ORDER BY categorieNR ASC, productNaam ASC"; 
        
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD); 
        $resultSet = $dbh->query($sql); 
        $lijst = array(); 
        foreach ($resultSet as $rij) {
            $categorie = Categorie::create($rij["categorieNR"], $rij["categorieNaam"]); 
            $product = Product::create($rij["productID"], $rij["productNaam"], $rij["productOmschrijving"], $rij["productPrijs"], $categorie); 
            array_push($lijst, $product); 
        }
        $dbh = null; 
        return $lijst;
    }
    
    public function getByProductNaam($productnaam) {
        $sql = "SELECT productID, productNaam, productOmschrijving, productPrijs, producten.categorieID as categorieNR, categorieNaam  FROM producten, categorieen WHERE productNaam = :productNaam AND producten.categorieID = categorieen.categorieID";
        
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql); 
        $stmt->execute(array(':productNaam' => $productnaam)); 
        $rij = $stmt->fetch(PDO::FETCH_ASSOC); 
        $categorie = Categorie::create($rij["categorieNR"], $rij["categorieNaam"]); 
        $product = Product::create($rij["productID"], $rij["productNaam"], $rij["productOmschrijving"], $rij["productPrijs"], $categorie); 
        $dbh = null; 
        return $product;         
    }
    
    public function getByCategorie($categorie) { //obj. v. categorie
        $sql = "SELECT productID, productNaam, productOmschrijving, productPrijs, categorieID FROM producten WHERE categorieID = :categorieID";
        
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql); 
        $stmt->execute(array(':categorieID' => $categorie->getCategorieId())); 
        $resultSet = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $lijst = array(); 
        foreach ($resultSet as $rij) {
        $product = Product::create($rij["productID"], $rij["productNaam"], $rij["productOmschrijving"], $rij["productPrijs"], $categorie); 
        array_push($lijst, $product); 
        }
        $dbh = null; 
        return $lijst;         
    }
}
