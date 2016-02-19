<?php

//src/KristoL/PHPProject/Entities/Klant.php

namespace KristofL\PHPProject\Entities;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Klant
 *
 * @author kristof.liesenborghs
 */
class Klant {

    private static $idMap = array();
    private $emailadres;
    private $wachtwoord;
    private $voornaam;
    private $familienaam;
    private $adres;
    private $woonplaats; // = obj. Woonplaats
    private $geblokkeerd; 

    private function __construct($emailadres, $wachtwoord, $voornaam, $familienaam, $adres, $woonplaats, $geblokkeerd) {
        $this->emailadres = $emailadres;
        $this->wachtwoord = $wachtwoord;
        $this->voornaam = $voornaam;
        $this->familienaam = $familienaam;
        $this->adres = $adres;
        $this->woonplaats = $woonplaats;
        $this->geblokkeerd = $geblokkeerd;
    }

        public static function create($emailadres, $wachtwoord, $voornaam, $familienaam, $adres, $woonplaats, $geblokkeerd) {
        if (!isset(self::$idMap[$emailadres])) {
            self::$idMap[$emailadres] = new Klant($emailadres, $wachtwoord, $voornaam, $familienaam, $adres, $woonplaats, $geblokkeerd);
        }
        return self::$idMap[$emailadres];
    }


    function getEmailadres() {
        return $this->emailadres;
    }

    function getWachtwoord() {
        return $this->wachtwoord;
    }

    function getVoornaam() {
        return $this->voornaam;
    }

    function getFamilienaam() {
        return $this->familienaam;
    }

    function getAdres() {
        return $this->adres;
    }

    function getWoonplaats() {
        return $this->woonplaats;
    }

    function getGeblokkeerd() {
        return $this->geblokkeerd;
    }

    function setWachtwoord($wachtwoord) {
        $this->wachtwoord = $wachtwoord;
    }

    function setVoornaam($voornaam) {
        $this->voornaam = $voornaam;
    }

    function setFamilienaam($familienaam) {
        $this->familienaam = $familienaam;
    }

    function setAdres($adres) {
        $this->adres = $adres;
    }

    function setWoonplaats($woonplaats) {
        $this->woonplaats = $woonplaats;
    }


    
}

