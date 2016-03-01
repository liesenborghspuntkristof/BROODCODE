<?php

require_once 'bootstrap.php';
require_once 'validationFunctions.php';
require_once 'algemeneFuncties.php'; 

use KristofL\PHPProject\Business\WoonplaatsService;
use KristofL\PHPProject\Business\KlantService;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!isset($_SESSION["login"]) || $_SESSION["login"] !== "valid login") {
    header('location: index.php');
    exit(0);
} else {

    $klantSvc = new KlantService();
    $klant = $klantSvc->getklantgegevens($_SESSION["emailadres"]);

    if (strlen($klant->getWachtwoord()) !== 64) {
        $wachtwoord = $klant->getWachtwoord() . "<span class='warning'>  --wachtwoord is niet beveiligd, wijzig je wachtwoord</span>";
    } else {
        $wachtwoord = "**********";
    }

    if (isset($_GET["action"]) && $_GET["action"] == "newbie") {
        require_once 'src/KristofL/PHPProject/Presentation/header_logedin.php';
        require_once 'src/KristofL/PHPProject/Presentation/mijnAccountPage.php';
        require_once 'src/KristofL/PHPProject/Presentation/mijnGegevensPage.php';
        require_once 'src/KristofL/PHPProject/Presentation/footer.php';
    } elseif (isset($_GET["action"]) && $_GET["action"] == "wachtwoord") {
        require_once 'src/KristofL/PHPProject/Presentation/header_logedin.php';
        require_once 'src/KristofL/PHPProject/Presentation/mijnAccountForm.php';
        require_once 'src/KristofL/PHPProject/Presentation/mijnGegevensPage.php';
        require_once 'src/KristofL/PHPProject/Presentation/footer.php';
    } elseif (isset($_GET["action"]) && $_GET["action"] == "gegevens") {
        require_once 'src/KristofL/PHPProject/Presentation/header_logedin.php';
        require_once 'src/KristofL/PHPProject/Presentation/mijnAccountPage.php';
        require_once 'src/KristofL/PHPProject/Presentation/mijnGegevensForm.php';
        require_once 'src/KristofL/PHPProject/Presentation/footer.php';
    } else {
    require_once 'src/KristofL/PHPProject/Presentation/header_logedin.php';
    require_once 'src/KristofL/PHPProject/Presentation/mijnAccountPage.php';
    require_once 'src/KristofL/PHPProject/Presentation/mijnGegevensPage.php';
    require_once 'src/KristofL/PHPProject/Presentation/footer.php';
    }
}
    
