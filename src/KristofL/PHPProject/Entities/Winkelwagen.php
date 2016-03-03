<?php
//src/KristofL/PHPProject/Entities/Winkelwagen.php

namespace KristofL\PHPProject\Entities; 

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Winkelwagen
 *
 * @author kristof.liesenborghs
 */
class Winkelwagen {
    
    private $gebruiker; // = geëncrypteerd emailadres
    private $afhalingVandaag; // = obj. bestelling
    private $bestellingMorgen; // = obj. bestelling
    private $bestellingOvermorgen; // = obj. bestelling
    private $bestellingOverovermorgen; // = obj. bestelling
    
    function __construct($gebruiker, $afhalingVandaag, $bestellingMorgen, $bestellingOvermorgen, $bestellingOverovermorgen) {
        $this->gebruiker = $gebruiker;
        $this->afhalingVandaag = $afhalingVandaag; 
        $this->bestellingMorgen = $bestellingMorgen;
        $this->bestellingOvermorgen = $bestellingOvermorgen;
        $this->bestellingOverovermorgen = $bestellingOverovermorgen;
    }

    function getGebruiker() {
        return $this->gebruiker;
    }
    
    function getAfhalingVandaag() {
        return $this->afhalingVandaag; 
    }

    function getBestellingMorgen() {
        return $this->bestellingMorgen;
    }

    function getBestellingOvermorgen() {
        return $this->bestellingOvermorgen;
    }

    function getBestellingOverovermorgen() {
        return $this->bestellingOverovermorgen;
    }

    function setBestellingMorgen($bestellingMorgen) {
        $this->bestellingMorgen = $bestellingMorgen;
    }

    function setBestellingOvermorgen($bestellingOvermorgen) {
        $this->bestellingOvermorgen = $bestellingOvermorgen;
    }

    function setBestellingOverovermorgen($bestellingOverovermorgen) {
        $this->bestellingOverovermorgen = $bestellingOverovermorgen;
    }


}
