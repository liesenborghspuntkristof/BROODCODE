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
     
    private $bestelling; //obj. bestelling
    private $product; //obj. product
    private $hoeveelheid; 
    
    public function __construct($bestelling, $product, $hoeveelheid) {     
        $this->bestelling = $bestelling;
        $this->product = $product;
        $this->hoeveelheid = $hoeveelheid;
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
