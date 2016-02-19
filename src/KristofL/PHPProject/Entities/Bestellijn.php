<?php
//src\KristofL\PHPProject\Entities\Bestellijn.php

namespace KristofL\PHPProject\Entities; 

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Bestellijn
 *
 * @author kristof.liesenborghs
 */
class Bestellijn {
    
    private static $idMap = array(); 
    
    private $bestellijnId; 
    private $bestelling; // = obj. Bestelling 
    private $product; // = obj. Product
    private $hoeveelheid; 
    
    private function __construct($bestellijnId, $bestelling, $product, $hoeveelheid) {     
        $this->bestellijnId = $bestellijnId; 
        $this->bestelling = $bestelling;
        $this->product = $product;
        $this->hoeveelheid = $hoeveelheid;
    }
    
    public static function create($bestellijnId, $bestelling, $product, $hoeveelheid) {
        if (!isset(self::$idMap[$bestellijnId])) {
            self::$idMap[$bestellijnId] = new Bestellijn($bestellijnId, $bestelling, $product, $hoeveelheid);
        }
        return self::$idMap[$bestellijnId]; 
    }
    
    function getBestellijnId() {
        return $this->bestellijnId;
    }

    function getBestelling() {
        return $this->bestelling;
    }

    function getProduct() {
        return $this->product;
    }

    function getHoeveelheid() {
        return $this->hoeveelheid;
    }
    
    function setBestelling($bestelling) {
        $this->bestelling = $bestelling;
    }

    function setProduct($product) {
        $this->product = $product;
    }

    function setHoeveelheid($hoeveelheid) {
        $this->hoeveelheid = $hoeveelheid;
    }





    
}
