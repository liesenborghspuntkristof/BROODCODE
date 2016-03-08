<?php

require_once 'bootstrap.php';
require_once 'algemeneFuncties.php';

use KristofL\PHPProject\Business\ProductService;
use KristofL\PHPProject\Business\BestellingService;
use KristofL\PHPProject\Exceptions\FunctionException;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!isset($_SESSION["login"]) || $_SESSION["login"] !== "valid login" || !isset($_SESSION["klant"])) {
    header('location: login.php');
    exit(0);
} elseif (!isset($_SESSION["winkelwagen"])) {
    header('location: winkelwagen.php');
    exit(0);
} elseif (!isset($_GET["date"]) && !isset($_SESSION["date"])) {
    $location = "location: winkelwagen.php?msg=" . base64_encode("kies een mogelijke afhaaldatum in 'mijn winkelwagen' of 'mijn bestellingen'");
    header($location);
    exit(0);
} else {
    if (isset($_GET["date"])) {
        try {
            $time = interpreteerDate($_GET["date"]);
            $_SESSION["date"] = date(("Y-m-d"), $time);
        } catch (FunctionException $ex) {
            $location = "location: winkelwagen.php?msg=" . base64_encode($ex->getMessage());
            header($location);
            exit(0);
        }
    }
    $klant = unserialize($_SESSION["klant"]);
    $productSvc = new ProductService();
    $productenlijstByCategorie = $productSvc->getProductListByCategorieList();
    $bestellingSvc = new BestellingService();
    $bestellinglijst = $bestellingSvc->getBestellingenByKlant($klant);

    if (isset($_GET["action"]) && $_GET["action"] == "bestelling" && isset($_GET["date"])) {
        $productlijst = $productSvc->getProductList();
        $tempBestellijnen = array();
        foreach ($productlijst as $product) {
            if ($_POST[$product->getProductId()] >= 0 && $_POST[$product->getProductId()] <= 20) {
                if ($_POST[$product->getProductId()] > 0) {
                    $tempBestellijn = array($product->getProductId() => $_POST[$product->getProductId()]);
                    $tempBestellijnen = array_merge($tempBestellijnen, $tempBestellijn);
                }
            } else {
                $location = "location: winkelen.php?msg=" . base64_encode("foutieve invoer, gelieve de waarde niet te manipuleren");
                header($location);
                exit(0);
            }
        }
        $tempBestelbon = $bestellingSvc->setTempBestelling($klant, $_SESSION["date"], $tempBestellijnen);
        $_SESSION["bestelbon"] = serialize($tempBestelbon);
        header("location: winkelen.php?action=bevestig&date=");
        exit(0);
    }




    include_once 'src/KristofL/PHPProject/Presentation/header_logedin.php';
    if (isset($_GET["action"]) && $_GET["action"] == "bevestig" && isset($_SESSION["bestelbon"])) {
        $bestelbon = unserialize($_SESSION["bestelbon"]);
        include_once 'src/KristofL/PHPProject/Presentation/bestelbonPage.php';
        include_once 'src/KristofL/PHPProject/Presentation/bestelbonForm.php';
    } else {
        if (isset($_GET["msg"])) {
            echo base64_decode($_GET["msg"]);
        }
        include_once 'src/KristofL/PHPProject/Presentation/winkelForm.php';
    }
    include_once 'src/KristofL/PHPProject/Presentation/footer.php';

//        var_dump ($winkelwagen);
}