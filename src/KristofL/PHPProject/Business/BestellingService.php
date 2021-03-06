<?php
//src/KristofL/PHPProject/Business/BestellingService.php

namespace KristofL\PHPProject\Business; 

use KristofL\PHPProject\Data\BestellingDAO; 
use KristofL\PHPProject\Entities\Winkelwagen;
use KristofL\PHPProject\Business\BestellijnService; 
use KristofL\PHPProject\Exceptions\BestellingException; 


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
        $afhalingVandaag = $bestellingDAO->getByDateFromId($emailadres, date("Y-m-d"));
        $bestellingMorgen = $bestellingDAO->getByDateFromId($emailadres, date(("Y-m-d"), strtotime('+1 day')));
        $bestellingOvermorgen = $bestellingDAO->getByDateFromId($emailadres, date(("Y-m-d"), strtotime('+2 days')));
        $bestellingOverovermorgen = $bestellingDAO->getByDateFromId($emailadres, date(("Y-m-d"), strtotime('+3 days')));
        $winkelwagen = new Winkelwagen (winkelwagenId($emailadres), $afhalingVandaag, $bestellingMorgen, $bestellingOvermorgen, $bestellingOverovermorgen);
        return $winkelwagen; 
    }
    
    public function getBestellingenByKlant ($klant) { //Bestelling == Bevestigde bestellingen
        $bestellingDAO = new BestellingDAO(); 
        $bestellinglijst = $bestellingDAO->getByKlant($klant); 
        return $bestellinglijst; 
    }
    
    public function getBestellingByKlantByDatum ($klant, $datum) { 
        $bestellingDAO = new BestellingDAO(); 
        $bestelling = $bestellingDAO->getByDateFromId($klant->getEmailadres(), $datum);  
        return $bestelling; 
    }
    
    public function getBestellingByklantAndId ($klant, $bestellingId) {
        $value_exist = FALSE; 
        $bestellingDAO = new BestellingDAO(); 
        $bestellijst = $bestellingDAO->getByKlant($klant); 
        foreach ($bestellijst as $bestelling) {
            switch ($bestelling->getBestellingId()) {
                case $bestellingId:
                    $value_exist = TRUE; 
                    break;
            }
        }
        if ($value_exist) {
            $herbestelling = $bestellingDAO->getById($bestellingId); 
            return $herbestelling;
        } else {
            throw new BestellingException("Er komt geen bestelling overeen met dit Id");
        }       
    }
    
    public function setTempBestelling($klant, $afhaaldatum, $tempBestellijnen) {
        $bestellingDAO = new BestellingDAO();
        $checklist = $bestellingDAO->getByKlant($klant); 
        foreach ($checklist as $check) {
            if ($check->getAfhaaldatum() == $afhaaldatum && $check->getBevestigd()) {
                throw new BestellingException ("Op deze datum is reeds een bestelling genoteerd"); 
            }
        }
        $bestellingDAO->setTempBestelling($afhaaldatum, $klant->getEmailadres()); 
        $bestelling = $bestellingDAO->getByDateFromId($klant->getEmailadres(), $afhaaldatum); 
        $bestellijnSvc = new BestellijnService();
        $bestellijnSvc->setBestellijnen($bestelling, $tempBestellijnen); 
    }
    
    public function updateBestelling($bestelling, $tempBestellijnen) {
        $bestellingDAO = new BestellingDAO();
        $bestellingDAO->resetConfirmation($bestelling->getBestellingId()); // bij update moet opnieuw de bestelling bevestigd worden
        $bestellijnSvc = new BestellijnService();
        $bestellijnSvc->deleteBestellijnen($bestelling); 
        $bestellijnSvc->setBestellijnen($bestelling, $tempBestellijnen); 
    } 
    
    public function confirmBestelbon ($bestelbon) { //array v. Obj. Bestellijn
        $bestellingDAO = new BestellingDAO();
        $bestellingDAO->confirmBestelling(current($bestelbon)->getBestelling()->getBestellingId()); 
    }
    
    public function updateReferentie($bestelling) { //obj. van Bestelling met setReferentie
        $bestellingDAO = new BestellingDAO(); 
        $bestellingDAO->updateBestellingReferentie($bestelling->getBestellingId(), $bestelling->getReferentie()); 
    }
    
    public function clearReferentie($bestelling) {
        $bestellingDAO = new BestellingDAO(); 
        $bestellingDAO->clearBestellingReferentie($bestelling->getBestellingId()); 
    }
   
    public function annuleerBestelling($bestelling) {
        $bestellingDAO = new BestellingDAO();
        $bestellingDAO->deleteBestellingById($bestelling->getBestellingId()); 
    }
    
    public function autoClear() {
        $bestellingDAO = new BestellingDAO();
        $bestellingDAO->deleteOldTemporary();  
    }
}
