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
        } elseif ($wachtwoord === $klant->getWachtwoord()) {
            $access = "granted";
        } else {
            throw new loginException("wachtwoord is niet correct");
        }
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
}
    