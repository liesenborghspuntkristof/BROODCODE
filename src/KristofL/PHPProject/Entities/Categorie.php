<?php
//src/KristofL/PHPProject/Entities/Categorie.php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace KristofL\PHPProject\Entities;

/**
 * Description of Categorie
 *
 * @author kristof
 */
class Categorie {
    
    private static $idMap = array(); 
    
    private $categorieId; 
    private $categorieNaam; 
    
    private function __construct($categorieId, $categorieNaam) {
        $this->categorieId = $categorieId;
        $this->categorieNaam = $categorieNaam;
    }
    
    public static function create($categorieId, $categorieNaam) {
        if (!isset(self::$idMap[$categorieId])) {
            self::$idMap[$categorieId] = new Categorie($categorieId, $categorieNaam); 
        }
        return self::$idMap[$categorieId]; 
    }
    
    function getCategorieId() {
        return $this->categorieId;
    }

    function getCategorieNaam() {
        return $this->categorieNaam;
    }

    function setCategorieNaam($categorieNaam) {
        $this->categorieNaam = $categorieNaam;
    }



}
