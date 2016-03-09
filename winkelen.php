<?php

require_once 'bootstrap.php';
require_once 'algemeneFuncties.php';
require_once 'validationFunctions.php'; 

use KristofL\PHPProject\Business\ProductService;
use KristofL\PHPProject\Business\BestellingService;
use KristofL\PHPProject\Business\BestellijnService; 
use KristofL\PHPProject\Exceptions\FunctionException;
use KristofL\PHPProject\Exceptions\BestellingException; 

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!isset($_SESSION["login"]) || $_SESSION["login"] !== "valid login" || !isset($_SESSION["klant"])) {
    header('location: login.php');
    exit(0);
}

if (isset($_SESSION["winkelwagen"]) && isset($_GET["date"]) && isset($_GET["action"])) { //$_SESSION["winkelwagen"] == dubbel check dat gebruiker langs winkelwagen.php is gepasseerd

    try {
        $time = interpreteerGETDate($_GET["date"]);
        $date = date(("Y-m-d"), $time);
    } catch (FunctionException $ex) {
        $location = "location: winkelwagen.php?msg=" . base64_encode($ex->getMessage());
        header($location);
        exit(0);
    }
    
    try {
        $GETtime = DatumNaarWoord($date);
    } catch (FunctionException $ex) {
        $location = "location: winkelwagen.php?msg=" . base64_encode($ex->getMessage());
        header($location);
        exit(0);
    }

    $klant = unserialize($_SESSION["klant"]);
    $productSvc = new ProductService(); //voor productlijst
    $bestellingSvc = new BestellingService(); //voor winkelwagen
    $bestellijnSvc = new BestellijnService(); //voor bestelbon
    $winkelwagen = $bestellingSvc->createWinkelwagen($klant->getEmailadres()); //update winkelwagen
    $_SESSION["winkelwagen"] = serialize($winkelwagen); //update winkelwagen
    
    switch ($date) {
        case $winkelwagen->getAfhalingVandaag()->getAfhaaldatum():
            $bestelling = $winkelwagen->getAfhalingVandaag(); //obj. bestelling datum van vandaag;
            break;
        case $winkelwagen->getBestellingMorgen()->getAfhaaldatum():
            $bestelling = $winkelwagen->getBestellingMorgen(); //obj. bestelling datum van morgen;
            break;
        case $winkelwagen->getBestellingOvermorgen()->getAfhaaldatum():
            $bestelling = $winkelwagen->getBestellingOvermorgen(); //obj. bestelling datum van overmorgen;
            break;
        case $winkelwagen->getBestellingOverovermorgen()->getAfhaaldatum():
            $bestelling = $winkelwagen->getBestellingOverovermorgen(); //obj. bestelling datum van overovermorgen;
            break;
        default:
            $location = "location: winkelwagen.php?msg=" . base64_encode("kies een mogelijke afhaaldatum in 'mijn winkelwagen' of 'mijn bestellingen'");
            header($location);
            exit(0);
    }
    
    include_once 'src/KristofL/PHPProject/Presentation/header_logedin.php';

    switch ($_GET["action"]) {
        case "winkelen":
            $bestellinglijst = $bestellingSvc->getBestellingenByKlant($klant);
            $productenlijstByCategorie = $productSvc->getProductListByCategorieList();                    
            if (isset($_GET["msg"])) { echo base64_decode($_GET["msg"]); }
            include_once 'src/KristofL/PHPProject/Presentation/winkelForm.php';          
            break;
            
        case "bestelling":
            if (isset($_POST)) {
                $productlijst = $productSvc->getProductList();
                $tempBestellijnen = array();
                foreach ($productlijst as $product) {
                    if ($_POST[$product->getProductId()] >= 0 && $_POST[$product->getProductId()] <= 20) {
                        if ($_POST[$product->getProductId()] > 0) {
                            $tempBestellijn = array($product->getProductId() => $_POST[$product->getProductId()]);
                            $tempBestellijnen = array_replace($tempBestellijnen, $tempBestellijn);
                        }
                    } else {
                        $location = "location: winkelen.php?msg=" . base64_encode("foutieve invoer, gelieve de waarde niet te manipuleren");
                        header($location);
                        exit(0);
                    }
                }
                if ($bestelling->getBestellingId() == NULL) {
                    $bestellingSvc->setTempBestelling($klant, $date, $tempBestellijnen);
                } else {
                    $bestellingSvc->updateBestelling($bestelling, $tempBestellijnen); 
                }        
                $location = "location: winkelen.php?action=bevestig&date=" . $GETtime;
                header($location);
                exit(0);           
            }
            break; 
            
        case "bevestig":
            if (isset($_GET["button"]) && $_GET["button"] == "bevestig" && $bestelling->getBevestigd() == FALSE && $_GET["date"] !== "vandaag") {
                if (check_valid_input(noSpace(latin_to_ascii($_POST["referentie"])), 0, 160)) {
                    $bestelling->setReferentie($_POST["referentie"]); 
                    $bestellingSvc->updateReferentie($bestelling); 
                }
                $bestelbon = $bestellijnSvc->getBestelbon($bestelling);
                $bestellingSvc->confirmBestelbon($bestelbon);
                header("location: winkelwagen.php");
                exit(0);
            } elseif ($bestelling->getBestellingId() !== NULL && $bestelling->getBevestigd() == FALSE && $_GET["date"] !== "vandaag") {
                $bestelbon = $bestellijnSvc->getBestelbon($bestelling); 
                include_once 'src/KristofL/PHPProject/Presentation/bestelbonPage.php';
                include_once 'src/KristofL/PHPProject/Presentation/bestelbonForm.php';
            } else {
                header("location: winkelwagen.php");
                exit(0);
            }
            break;
            
        case "herbestelling":
            if (isset($_POST["bestellingId"]) && check_only_numbers($_POST["bestellingId"])) {
                try {
                    $herbestelling = $bestellingSvc->getBestellingByklantAndId($klant, $_POST["bestellingId"]);                 
                } catch (BestellingException $ex) {
                    $location = "location: winkelen.php?action=winkelen&date=" . $GETtime . "&msg=" . base64_encode("foutieve invoer, gelieve de waarde niet te manipuleren") . base64_encode("</br>" . $ex->getMessage());
                    header($location);
                    exit(0);
                }
                if ($herbestelling->getBevestigd()) {
                    $tempBestellijnen = $bestellijnSvc->getTempBestellijnen($herbestelling);
                    $bestellingSvc->setTempBestelling($klant, $GETtime, $tempBestellijnen);
                    $location = "location: winkelen.php?action=bevestig&date=" . $GETtime;
                    header($location);
                    exit(0);
                } else {
                    $location = "location: winkelen.php?action=winkelen&date=" . $GETtime . "&msg=" . base64_encode("foutieve invoer, kies een andere herbestelling");
                    header($location);
                    exit(0);
                }               
            }
            break;
            
        case "wijzig": 
            $bestelbon = $bestellijnSvc->getBestelbon($bestelling); 
            $idStack = array();
            $hoeveelheidStack = array(); 
            foreach ($bestelbon as $bestellijn) {
                array_push($idStack, $bestellijn->getProduct()->getProductId());  
                array_push($hoeveelheidStack, $bestellijn->getHoeveelheid()); 
            }
            $bestellinglijst = $bestellingSvc->getBestellingenByKlant($klant);
            $productenlijstByCategorie = $productSvc->getProductListByCategorieList();                    
            if (isset($_GET["msg"])) { echo base64_decode($_GET["msg"]); }
            include_once 'src/KristofL/PHPProject/Presentation/winkelForm.php';
            break;
            
        case "annuleer":
            if (isset($_GET["button"]) && $_GET["button"] == "annuleer" && $bestelling->getBestellingId() !== NULL && $GETtime !== "vandaag" && $_SESSION["annuleer"] == "2") {
                $bestellingSvc->annuleerBestelling($bestelling); 
                header("location: winkelwagen.php");
                exit(0);
            } elseif ($bestelling->getBestellingId() !== NULL && $GETtime !== "vandaag") {
                $_SESSION["annuleer"]++; 
                $bestelbon = $bestellijnSvc->getBestelbon($bestelling); 
                echo "<p style='margin-top: 8em;'>Klik nogmaals op 'Annuleer bestelling' om onderstaande bestelling te verwijderen</p>"; 
                echo "<center><a href='winkelen.php?action=annuleer&date=" . $GETtime . "&button=annuleer'>Annuleer bestelling</a></center>"; 
                include_once 'src/KristofL/PHPProject/Presentation/bestelbonPage.php';
            }
            
            break; 
               

        default:
            header("location: winkelwagen.php");
            exit(0);
    }
    
    include_once 'src/KristofL/PHPProject/Presentation/footer.php';
    
} else {
    $location = "location: winkelwagen.php?msg=" . base64_encode("kies een mogelijke afhaaldatum in 'mijn winkelwagen' of 'mijn bestellingen'");
    header($location);
    exit(0);
}


// ---------------------------------------------------------------------------------------------------------------------------------------------------------- //


//
//if (!isset($_SESSION["login"]) || $_SESSION["login"] !== "valid login" || !isset($_SESSION["klant"])) {
//    header('location: login.php');
//    exit(0);
//} elseif (!isset($_SESSION["winkelwagen"])) {
//    header('location: winkelwagen.php');
//    exit(0);
//} elseif (!isset($_GET["date"]) && !isset($_SESSION["date"])) {
//    $location = "location: winkelwagen.php?msg=" . base64_encode("kies een mogelijke afhaaldatum in 'mijn winkelwagen' of 'mijn bestellingen'");
//    header($location);
//    exit(0);
//} else {
//    if (isset($_GET["date"])) {
//        try {
//            $time = interpreteerDate($_GET["date"]);
//            $_SESSION["date"] = date(("Y-m-d"), $time);
//        } catch (FunctionException $ex) {
//            $location = "location: winkelwagen.php?msg=" . base64_encode($ex->getMessage());
//            header($location);
//            exit(0);
//        }
//    }
//    $klant = unserialize($_SESSION["klant"]);
//    $productSvc = new ProductService();
//    $productenlijstByCategorie = $productSvc->getProductListByCategorieList();
//    $bestellingSvc = new BestellingService();
//    $bestellinglijst = $bestellingSvc->getBestellingenByKlant($klant);
//
//    if (isset($_GET["action"]) && $_GET["action"] == "bestelling" && isset($_GET["date"])) {
//        $productlijst = $productSvc->getProductList();
//        $tempBestellijnen = array();
//        foreach ($productlijst as $product) {
//            if ($_POST[$product->getProductId()] >= 0 && $_POST[$product->getProductId()] <= 20) {
//                if ($_POST[$product->getProductId()] > 0) {
//                    $tempBestellijn = array($product->getProductId() => $_POST[$product->getProductId()]);
//                    $tempBestellijnen = array_merge($tempBestellijnen, $tempBestellijn);
//                }
//            } else {
//                $location = "location: winkelen.php?msg=" . base64_encode("foutieve invoer, gelieve de waarde niet te manipuleren");
//                header($location);
//                exit(0);
//            }
//        }
//        $tempBestelbon = $bestellingSvc->setTempBestelling($klant, $_SESSION["date"], $tempBestellijnen);
//        $_SESSION["bestelbon"] = serialize($tempBestelbon);
//        header("location: winkelen.php?action=bevestig&date=");
//        exit(0);
//    }
//
//
//
//
//    include_once 'src/KristofL/PHPProject/Presentation/header_logedin.php';
//    if (isset($_GET["action"]) && $_GET["action"] == "bevestig" && isset($_SESSION["bestelbon"])) {
//        $bestelbon = unserialize($_SESSION["bestelbon"]);
//        include_once 'src/KristofL/PHPProject/Presentation/bestelbonPage.php';
//        include_once 'src/KristofL/PHPProject/Presentation/bestelbonForm.php';
//    } else {
//        if (isset($_GET["msg"])) {
//            echo base64_decode($_GET["msg"]);
//        }
//        include_once 'src/KristofL/PHPProject/Presentation/winkelForm.php';
//    }
//    include_once 'src/KristofL/PHPProject/Presentation/footer.php';
//
////        var_dump ($winkelwagen);
//}