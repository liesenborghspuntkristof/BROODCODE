<?php

require_once 'bootstrap.php';
require_once 'algemeneFuncties.php';

use KristofL\PHPProject\Business\BestellingService;
use KristofL\PHPProject\Business\BestellijnService; 




/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!isset($_SESSION["login"]) || $_SESSION["login"] !== "valid login" || !isset($_SESSION["klant"])) {
    header('location: login.php');
    exit(0);
} else {
    $_SESSION["annuleer"] = 1; 
    $klant = unserialize($_SESSION["klant"]); 
    $bestellijnSvc = new BestellijnService();
    $bestellingSvc = new BestellingService();
    $bestellingSvc->autoClear(); 
    $winkelwagen = $bestellingSvc->createWinkelwagen($klant->getEmailadres()); 
    $_SESSION["winkelwagen"] = serialize($winkelwagen); 
 

    include_once 'src/KristofL/PHPProject/Presentation/header_logedin.php';
    include_once 'src/KristofL/PHPProject/Presentation/winkelwagenPage.php';
    if (isset($_GET["msg"])) { echo base64_decode($_GET["msg"]); }
//    if (isset($_SESSION["msg"])) { echo "</br>" . $_SESSION["msg"]; }
    include_once 'src/KristofL/PHPProject/Presentation/footer.php';
    
//        var_dump ($winkelwagen);
}