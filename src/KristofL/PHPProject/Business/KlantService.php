<?php

//src\KristofL\PHPProject\Business\KlantService.php

namespace KristofL\PHPProject\Business;

use KristofL\PHPProject\Data\KlantDAO;
use KristofL\PHPProject\Exceptions\loginException;
use KristofL\PHPProject\Exceptions\NewRegistryException; 

//require_once 'algemeneFuncties.php';

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of KlantService
 *
 * @author kristof.liesenborghs
 */
class KlantService {

    public function checkLoginByInput($emailadres, $wachtwoord) {
        $access = null;
        $klantDAO = new KlantDAO();
        $klant = $klantDAO->getByEmailadres($emailadres);
        if ($klant->getEmailadres() == null) {
            unset($_SESSION["emailadres"]);
            throw new loginException("emailadres staat niet geregistreerd");
        } 
        switch (TRUE) {
    case strlen($klant->getWachtwoord()) == 64:
        if (passwordEncrypt($klant->getEmailadres(), $wachtwoord) === $klant->getWachtwoord()) {
            $access = "granted";
        }
        break;
    case strlen($klant->getWachtwoord()) !== 64:
        if ($wachtwoord === $klant->getWachtwoord()) {
            $access = "granted"; 
        }
        break; 
    default:
        throw new loginException("wachtwoord is niet correct");
}       
//        elseif (strlen($klant->getWachtwoord()) == 64) {
//            if ($wachtwoord === $klant->getWachtwoord()) {
//            $access = "granted";
//        } else {
//            throw new loginException("wachtwoord is niet correct");
//        }
        return $access;
    }

    public function checkEnStoreNieuweGebruiker($emailadres, $voornaam, $familienaam, $adres, $postId) {
        $klantDAO = new KlantDAO();
        $klantencheck = $klantDAO->getByEmailadres($emailadres);
        if ($klantencheck->getEmailadres() !== null) {
            unset($_SESSION["emailadres"]);
            throw new NewRegistryException("Er is al een gebruiker met dit emailadres");
        } else {
            $wachtwoord = passwordGenerator(); 
            $klantDAO->registerNieuweKlant($emailadres, $wachtwoord, $voornaam, $familienaam, $adres, $postId); 
        }
    }
    
    public function getklantgegevens($emailadres) {
        $klantDAO = new KlantDAO(); 
        $klant = $klantDAO->getByEmailadres($emailadres); 
        return $klant; 
    }
    
    public function encryptEnSetNieuwWachtwoord ($klant, $nieuwWachtwoord) {
        $encryptedWachtwoord = passwordEncrypt($klant->getEmailadres(), $nieuwWachtwoord); 
        $klantDAO = new KlantDAO(); 
        $klantDAO->setNieuwWachtwoord($klant->getEmailadres(), $encryptedWachtwoord); 
    }
    
    public function updateGegevens ($klant) {
        $klantDAO = new KlantDAO(); 
        $klantDAO->updateKlantengegevens($klant); 
    }
}
    