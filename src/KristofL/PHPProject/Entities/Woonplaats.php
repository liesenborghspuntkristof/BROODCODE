<?php
//src/KristofL/PHPProject/Entities/Woonplaats.php

namespace KristofL\PHPProject\Entities; 

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Woonplaats
 *
 * @author kristof.liesenborghs
 */
class Woonplaats {
    
    private static $idMap = array(); 
    
    private $postId; 
    private $zipcode; 
    private $naam; 
    
    private function __construct($postId, $zipcode, $naam) {
        $this->postId = $postId;
        $this->zipcode = $zipcode;
        $this->naam = $naam;
    }
    
    public static function create($postId, $zipcode, $naam) {
        if (!isset(self::$idMap[$postId])) {
            self::$idMap[$postId] = new Woonplaats($postId, $zipcode, $naam); 
        }
        return self::$idMap[$postId]; 
    }
    
    function getPostId() {
        return $this->postId;
    }

    function getZipcode() {
        return $this->zipcode;
    }

    function getNaam() {
        return $this->naam;
    }

    function setZipcode($zipcode) {
        $this->zipcode = $zipcode;
    }

    function setNaam($naam) {
        $this->naam = $naam;
    }



}
