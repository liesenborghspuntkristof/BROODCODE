<?php

require_once 'bootstrap.php';
require_once 'algemeneFuncties.php';

use KristofL\PHPProject\Business\BestellingService;


/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!isset($_SESSION["login"]) || $_SESSION["login"] !== "valid login" || !isset($_SESSION["klant"])) {
    header('location: login.php');
    exit(0);
} else {
    $klant = unserialize($_SESSION["klant"]);
    $bestellingSvc = new BestellingService();
    $bestellinglijst = $bestellingSvc->getBestellingenByKlant($klant);
    if (!isset($_SESSION["winkelwagen"])) { 
    $winkelwagen = $bestellingSvc->createWinkelwagen($klant->getEmailadres()); 
    $_SESSION["winkelwagen"] = serialize($winkelwagen); 
    } else {
        $winkelwagen = unserialize($_SESSION["winkelwagen"]); 
    }
 

    require_once 'src/KristofL/PHPProject/Presentation/header_logedin.php';
    require_once 'src/KristofL/PHPProject/Presentation/mijnBestellingenPage.php';
    require_once 'src/KristofL/PHPProject/Presentation/footer.php';
    
//        var_dump ($winkelwagen);
}