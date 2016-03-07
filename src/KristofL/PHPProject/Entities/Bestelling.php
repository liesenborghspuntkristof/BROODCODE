<?php
//src\KristofL\PHPProject\Entities\Bestelling.php

namespace KristofL\PHPProject\Entities; 

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Bestelling
 *
 * @author kristof.liesenborghs
 */
class Bestelling {
    
    private static $idMap = array(); 
    
    private $bestellingId; 
    private $afhaaldatum; 
    private $klant; // = obj. Klant 
    private $afgehaald; 
    private $referentie;
    private $bevestigd; 
    
    private function __construct($bestellingId, $afhaaldatum, $klant, $afgehaald, $referentie, $bevestigd) {
        $this->bestellingId = $bestellingId;
        $this->afhaaldatum = $afhaaldatum;
        $this->klant = $klant;
        $this->afgehaald = $afgehaald;
        $this->referentie = $referentie; 
        $this->bevestigd = $bevestigd; 
    }
    
    public static function create($bestellingId, $afhaaldatum, $klant, $afgehaald, $referentie, $bevestigd) {
        if (!isset(self::$idMap[$bestellingId])) {
            self::$idMap[$bestellingId] = new Bestelling($bestellingId, $afhaaldatum, $klant, $afgehaald, $referentie, $bevestigd); 
        }
        return self::$idMap[$bestellingId];
    }

    function getBestellingId() {
        return $this->bestellingId;
    }

    function getAfhaaldatum() {
        return $this->afhaaldatum;
    }

    function getKlant() {
        return $this->klant;
    }

    function getAfgehaald() {
        return $this->afgehaald;
    }
    
    function getReferentie() {
        return $this->referentie; 
    }
    
    function getBevestigd() {
        return $this->bevestigd; 
    }

    function setAfhaaldatum($afhaaldatum) {
        $this->afhaaldatum = $afhaaldatum;
    }

    function setKlant($klant) {
        $this->klant = $klant;
    }

    function setAfgehaald($afgehaald) {
        $this->afgehaald = $afgehaald;
    }
    
    function setReferentie($referentie) {
        $this->referentie = $referentie; 
    }
    
    function setBevestigd($bevestigd) {
        $this->bevestigd = $bevestigd; 
    }


}
