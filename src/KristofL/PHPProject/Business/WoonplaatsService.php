<?php
//src\KristofL\PHPProject\Business\WoonplaatsService.php

namespace KristofL\PHPProject\Business; 
use KristofL\PHPProject\Data\WoonplaatsDAO; 

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of WoonplaatsService
 *
 * @author kristof.liesenborghs
 */
class WoonplaatsService {
    
    public function getSelectLijst() {
        $woonplaatsDAO = new WoonplaatsDAO(); 
        $woonplaatslijst = $woonplaatsDAO->getAll(); 
        return $woonplaatslijst;
    }
}
