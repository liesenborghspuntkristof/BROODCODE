<?php

require_once 'bootstrap.php';
require_once 'algemeneFuncties.php';

use KristofL\PHPProject\Business\ProductService;
use KristofL\PHPProject\Business\BestellingService;

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
        switch (TRUE) {
            case $_GET["date"] == "morgen":
                $_SESSION["date"] = date(("Y-m-d"), strtotime("+1 day"));
                break;
            case $_GET["date"] == "overmorgen":
                $_SESSION["date"] = date(("Y-m-d"), strtotime("+2 days"));
                break;
            case $_GET["date"] == "overovermorgen":
                $_SESSION["date"] = date(("Y-m-d"), strtotime("+3 days"));
                break;
            default :
                $location = "location: winkelwagen.php?msg=" . base64_encode("kies een mogelijke afhaaldatum in 'mijn winkelwagen' of 'mijn bestellingen'");
                header($location);
                exit(0);
        }
    }
    $klant = unserialize($_SESSION["klant"]);
    $productSvc = new ProductService();
    $productenlijstByCategorie = $productSvc->getProductListByCategorieList();
    $bestellingSvc = new BestellingService();
    $bestellinglijst = $bestellingSvc->getBestellingenByKlant($klant);

    if (isset($_GET["action"]) && $_GET["action"] == "bestelling") {
        $productlijst = $productSvc->getProductList();
        $_SESSION[$_SESSION["date"]] = array(); 
        foreach ($productlijst as $product) {
            if ($_POST[$product->getProductId()] >= 0 && $_POST[$product->getProductId()] <= 20) {
                if ($_POST[$product->getProductId()] > 0) {
                $tempBestellijn = array($product->getProductId() => $_POST[$product->getProductId()]); 
                array_push($_SESSION[$_SESSION["date"]], $tempBestellijn);             
                }               
            } else {
                $location = "location: winkelen.php?msg=" . base64_encode("foutieve invoer, gelieve de waarde niet te manipuleren");
                header($location);
                exit(0);
            }
        }
        var_dump($_SESSION[$_SESSION["date"]]);
    }




    include_once 'src/KristofL/PHPProject/Presentation/header_logedin.php';
    if (isset($_GET["msg"])) {
        echo base64_decode($_GET["msg"]);
    }
    include_once 'src/KristofL/PHPProject/Presentation/winkelForm.php';
    include_once 'src/KristofL/PHPProject/Presentation/footer.php';

//        var_dump ($winkelwagen);
}