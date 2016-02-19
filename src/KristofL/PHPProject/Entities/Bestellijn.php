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
     
    private $bestellingId;  
    private $productId; 
    private $hoeveelheid; 
    
    public function __construct($bestellingId, $productId, $hoeveelheid) {     
        $this->bestellingId = $bestellingId;
        $this->productId = $productId;
        $this->hoeveelheid = $hoeveelheid;
    }
    
    
    function getBestellingId() {
        return $this->bestellingId;
    }

    function getProductId() {
        return $this->productId;
    }

    function getHoeveelheid() {
        return $this->hoeveelheid;
    }
    
    function setBestellingId($bestellingId) {
        $this->bestellingId = $bestellingId;
    }

    function setProductId($productId) {
        $this->productId = $productId;
    }

    function setHoeveelheid($hoeveelheid) {
        $this->hoeveelheid = $hoeveelheid;
    }





    
}
