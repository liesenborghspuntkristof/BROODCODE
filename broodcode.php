<?php

require_once 'bootstrap.php';
require_once 'algemeneFuncties.php';

use KristofL\PHPProject\Exceptions\FunctionException;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!isset($_SESSION["login"]) || $_SESSION["login"] !== "valid login" || !isset($_SESSION["klant"])) {
    header('location: login.php');
    exit(0);
} else {

    if (isset($_SESSION["winkelwagen"]) && isset($_GET["action"]) && $_GET["action"] == "broodcode" && isset($_GET["date"])) {
        $winkelwagen = unserialize($_SESSION["winkelwagen"]);
        try {
            $time = interpreteerDate($_GET["date"]);         
        } catch (FunctionException $ex) {
            $location = "location: winkelwagen.php?msg=" . base64_encode("time error: foutieve 'date' variabel");
            header($location);
            exit(0);
        }
        switch (date("Y-m-d", $time)) {
            case $winkelwagen->getAfhalingVandaag()->getAfhaaldatum():
                $bestelling = $winkelwagen->getAfhalingVandaag();
                break;
            case $winkelwagen->getBestellingMorgen()->getAfhaaldatum():
                $bestelling = $winkelwagen->getBestellingMorgen();
                break;
            case $winkelwagen->getBestellingOvermorgen()->getAfhaaldatum():
                $bestelling = $winkelwagen->getBestellingOvermorgen();
                break;
            case $winkelwagen->getBestellingOverovermorgen()->getAfhaaldatum():
                $bestelling = $winkelwagen->getBestellingOverovermorgen();
                break;
            default:
                $location = "location: winkelwagen.php?msg=" . base64_encode("Object error: BroodCode -datum komt niet overeen met winkelwagendata");
                header($location);
                exit(0);
                break;
        }
        include_once 'src/KristofL/PHPProject/Presentation/header_logedin.php';
        include_once 'src/KristofL/PHPProject/Presentation/broodcodePage.php';
        include_once 'src/KristofL/PHPProject/Presentation/footer.php';
    } else {
        header('location: winkelwagen.php');
        exit(0);
    }
}