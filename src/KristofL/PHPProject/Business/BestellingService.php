<?php
//src/KristofL/PHPProject/Business/BestellingService.php

namespace KristofL\PHPProject\Business; 

use KristofL\PHPProject\Data\BestellingDAO; 
use KristofL\PHPProject\Entities\Winkelwagen; 

require_once 'algemeneFuncties.php';

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BestellingService
 *
 * @author kristof.liesenborghs
 */
class BestellingService {
    
    public function createWinkelwagen ($emailadres) {
        date_default_timezone_set("Europe/Brussels"); 
        $bestellingDAO = new BestellingDAO(); 
        $bestellingMorgen = $bestellingDAO->getByDateFromId($emailadres, date("Y-m-d")); 
        $bestellingOvermorgen = $bestellingDAO->getByDateFromId($emailadres, date("Y-m-d", strtotime('+1 day')));
        $bestellingOverovermorgen = $bestellingDAO->getByDateFromId($emailadres, date("Y-m-d", strtotime('+2 days')));
        $winkelwagen = new Winkelwagen (winkelwagenId($_SESSION["emailadres"]), $bestellingMorgen, $bestellingOvermorgen, $bestellingOverovermorgen);
        return $winkelwagen; 
    }
   
}
