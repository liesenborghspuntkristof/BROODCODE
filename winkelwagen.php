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
    $winkelwagen = $bestellingSvc->createWinkelwagen($klant->getEmailadres()); 
    $_SESSION["winkelwagen"] = serialize($winkelwagen); 
 

    include_once 'src/KristofL/PHPProject/Presentation/header_logedin.php';
    include_once 'src/KristofL/PHPProject/Presentation/winkelwagenPage.php';
    if (isset($_GET["msg"])) { echo base64_decode($_GET["msg"]); }
    include_once 'src/KristofL/PHPProject/Presentation/footer.php';
    
//        var_dump ($winkelwagen);
}