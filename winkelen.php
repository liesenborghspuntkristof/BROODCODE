<?php

require_once 'bootstrap.php';
require_once 'algemeneFuncties.php';

use KristofL\PHPProject\Business\ProductService;


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
} else {
    $productSvc = new ProductService(); 
    $productlijst = $productSvc->getProductList(); 
    $categorienaam = $productlijst[0]->getCategorie()->getCategorieNaam(); 
//    $klant = unserialize($_SESSION["klant"]);
//    $winkelwagen = unserialize($_SESSION["winkelwagen"]); 
//    $bestellingSvc = new BestellingService();
     
 

    require_once 'src/KristofL/PHPProject/Presentation/header_logedin.php';
    require_once 'src/KristofL/PHPProject/Presentation/winkelForm.php';
    require_once 'src/KristofL/PHPProject/Presentation/footer.php';
    
//        var_dump ($winkelwagen);
}