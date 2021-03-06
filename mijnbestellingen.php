<?php

require_once 'bootstrap.php';
require_once 'algemeneFuncties.php';
require_once 'validationFunctions.php';

use KristofL\PHPProject\Exceptions\BestellingException;
use KristofL\PHPProject\Exceptions\FunctionException; 
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
    $klant = unserialize($_SESSION["klant"]);
    $bestellingSvc = new BestellingService();
    $bestellinglijst = $bestellingSvc->getBestellingenByKlant($klant); 
    $winkelwagen = $bestellingSvc->createWinkelwagen($klant->getEmailadres());
    if ($bestellinglijst !== null) {
        $bestellijnSvc = new BestellijnService(); 
    }

    if (isset($_GET["action"]) && $_GET["action"] == "referentie" && isset($_GET["date"]) && isset($_GET["key"])) {
        if ($_POST["referentie"] == "" && $bestellinglijst[$_GET["key"]]->getAfhaaldatum() == date("Y-m-d", $_GET["date"])) {
            $bestellingSvc->clearReferentie($bestellinglijst[$_GET["key"]]);
            header("location:mijnbestellingen.php");
            exit(0);
        } elseif (check_valid_input(noSpace(latin_to_ascii($_POST["referentie"])), 0, 160) && $bestellinglijst[$_GET["key"]]->getAfhaaldatum() == date("Y-m-d", $_GET["date"])) {
            try {
                $bestellinglijst[$_GET["key"]]->setReferentie($_POST["referentie"]);
                $bestellingSvc->updateReferentie($bestellinglijst[$_GET["key"]]);
                header("location:mijnbestellingen.php");
                exit(0);
            } catch (BestellingException $ex) {
                $location = "location: mijnbestellingen.php?msg=" . base64_encode($ex->getMessage());
                header($location);
                exit(0);
            }
        } else {
            $location = "location: mijnbestellingen.php?msg=" . base64_encode("Invalid 'Referentie' -input: gebruik geen speciale tekens, max. lengte = 160 karakters");
            header($location);
            exit(0);
        }
    }
    
    if (isset($_GET["action"]) && $_GET["action"] == "herbestelling" && isset($_GET["key"]) && isset($_GET["id"]) && isset($_POST["herbestellingsdatum"])) {
        unset($_SESSION["herbestellingId"]); 
        $date = date("Y-m-d", $_POST["herbestellingsdatum"]); 
        try {
            $GETtime = DatumNaarWoord($date); 
        } catch (FunctionException $ex) {
            $location = "location: mijnbestellingen.php?msg=" . base64_encode($ex->getMessage()) ;
            header($location);
            exit(0);
        }
        var_dump($bestellinglijst[$_GET["key"]]); 
        if ($bestellinglijst[$_GET["key"]]->getBestellingId() == $_GET["id"] ) {
           $_SESSION["herbestellingId"] = $_GET["id"]; 
           $location = "location: winkelen.php?action=herbestelling&date=" . $GETtime;
           header($location);
           exit(0); 
        }
    }

    include_once 'src/KristofL/PHPProject/Presentation/header_logedin.php';
    include_once 'src/KristofL/PHPProject/Presentation/mijnBestellingenPage.php';
    if (isset($_GET["msg"])) {
        echo base64_decode($_GET["msg"]);
    }
    include_once 'src/KristofL/PHPProject/Presentation/footer.php';

//        var_dump ($winkelwagen);
}