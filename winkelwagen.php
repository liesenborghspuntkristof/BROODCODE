<?php

require_once 'bootstrap.php';
require_once 'algemeneFuncties.php';

use KristofL\PHPProject\Business\BestellingService;
use KristofL\PHPProject\Entities\Winkelwagen;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!isset($_SESSION["login"]) || $_SESSION["login"] !== "valid login") {
    header('location: login.php');
    exit(0);
} else {
    $bestellingSvc = new BestellingService();
    $winkelwagen = $bestellingSvc->createWinkelwagen($_SESSION["emailadres"]);
//    var_dump ($winkelwagen); 

    require_once 'src/KristofL/PHPProject/Presentation/header_logedin.php';
    
    require_once 'src/KristofL/PHPProject/Presentation/footer.php';
}