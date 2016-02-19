<?php 

use KristofL\PHPProject\Data\KlantDAO; 
use KristofL\PHPProject\Data\WoonplaatsDAO; 
use KristofL\PHPProject\Data\BestellingDAO; 
use KristofL\PHPProject\Data\ProductDAO; 
use KristofL\PHPProject\Data\BestellijnDAO; 
require_once 'bootstrap.php';


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//src/KristofL/PHPProject/Data/KlantDAO.php

$klantDAO = new KlantDAO(); 
$klantenlijst = $klantDAO->getAll(); 
var_dump ($klantenlijst); 

$klant = $klantDAO->getByEmailadres("liesenborghs.kristof@gmail.com"); 
var_dump($klant); 


//src/KristofL/PHPProject/Data/WoonplaatsDAO.php

$woonplaatsDAO = new WoonplaatsDAO(); 
$woonplaatslijst = $woonplaatsDAO->getAll(); 
//var_dump($woonplaatslijst); 

$woonplaats = $woonplaatsDAO->getByZipcode("3600"); 
var_dump($woonplaats); 


//src/KristofL/PHPProject/Data/BestellingDAO.php

$bestellingDAO = new BestellingDAO(); 
$bestellinglijst = $bestellingDAO->getAll(); 
var_dump($bestellinglijst); 

$bestelling = $bestellingDAO->getById("1"); 
var_dump($bestelling); 

$bestellingVanKlant = $bestellingDAO->getByKlant($klant); 
var_dump($bestellingVanKlant); 

//src/KristofL/PHPProject/Data/ProductDAO.php

$productDAO = new ProductDAO(); 
$productlijst = $productDAO->getAll(); 
var_dump($productlijst); 

$product = $productDAO->getByProductNaam("sandwiches"); 
var_dump($product); 

//src/KristofL/PHPProject/Data/BestellijnDAO.php

$bestellijnDAO = new BestellijnDAO(); 
$bestellijnenVanBestelling = $bestellijnDAO->getByBestellingId("1"); 
var_dump($bestellijnenVanBestelling); 