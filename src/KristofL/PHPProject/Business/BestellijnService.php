<?php
//src/KristofL/PHPProject/Business/BestellijnService.php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace KristofL\PHPProject\Business;

use KristofL\PHPProject\Data\BestellijnDAO; 

/**
 * Description of BestellijnService
 *
 * @author kristof.liesenborghs
 */
class BestellijnService {
    
    public function getBestelbon($bestelling) { //lijst v. obj. v. bestellijn
        $bestellijnDAO = new BestellijnDAO(); 
        $bestelbon = $bestellijnDAO->getByBestellingId($bestelling->getBestellingId()); 
        return $bestelbon; 
    }
    
    public function getTempBestellijnen($bestelling) { //Array met Key == productId && value == hoeveelheid:int
        $bestellijnDAO = new BestellijnDAO(); 
        $tempBestelbon = $bestellijnDAO->getByBestellingId($bestelling->getBestellingId());
        $tempBestellijnen = array(); 
        foreach ($tempBestelbon as $tempBestellijn) {
        $tempBestellijnArray = array($tempBestellijn->getProduct()->getProductId() => $tempBestellijn->getHoeveelheid());
        $tempBestellijnen = array_replace($tempBestellijnen, $tempBestellijnArray);
    }
        return $tempBestellijnen; 
    }
    
    public function setBestellijnen($bestelling, $tempBestellijnen) {
        $bestellijnDAO = new BestellijnDAO();
        $bestellijnDAO->setBestellijnen($bestelling->getBestellingId(), $tempBestellijnen); 
    }
    
    public function deleteBestellijnen($bestelling) { //obj. v. bestelling
        $bestellijnDAO = new BestellijnDAO();
        $bestellijnDAO->deleteBestellijnen($bestelling->getBestellingId()); 
    }
    
    
}
