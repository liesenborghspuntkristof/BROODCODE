<?php

require_once 'bootstrap.php';



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
        switch ($winkelwagen) {
            case $value:


                break;

            default:
                break;
        }
    }
    
 

    include_once 'src/KristofL/PHPProject/Presentation/header_logedin.php';
    include_once 'src/KristofL/PHPProject/Presentation/broodcodePage.php';
    include_once 'src/KristofL/PHPProject/Presentation/footer.php';
    

}