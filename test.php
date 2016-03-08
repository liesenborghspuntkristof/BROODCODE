<?php

use KristofL\PHPProject\Data\KlantDAO;
use KristofL\PHPProject\Data\WoonplaatsDAO;
use KristofL\PHPProject\Data\BestellingDAO;
use KristofL\PHPProject\Data\ProductDAO;
use KristofL\PHPProject\Data\BestellijnDAO;
use KristofL\PHPProject\Business\ProductService; 
use KristofL\PHPProject\Data\CategorieDAO; 
use KristofL\PHPProject\Business\BestellijnService; 

require_once 'bootstrap.php';
require_once 'validationFunctions.php';
require_once 'algemeneFuncties.php';


/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

////src/KristofL/PHPProject/Data/KlantDAO.php
//
//$klantDAO = new KlantDAO(); 
//$klantenlijst = $klantDAO->getAll(); 
//var_dump ($klantenlijst); 
//
//$klant = $klantDAO->getByEmailadres("liesenborghs.kristof@gmail.com"); 
//var_dump($klant); 
//
//
////src/KristofL/PHPProject/Data/WoonplaatsDAO.php
//
//$woonplaatsDAO = new WoonplaatsDAO(); 
//$woonplaatslijst = $woonplaatsDAO->getAll(); 
////var_dump($woonplaatslijst); 
//
//$woonplaats = $woonplaatsDAO->getByZipcode("3600"); 
//var_dump($woonplaats); 
//
//
////src/KristofL/PHPProject/Data/BestellingDAO.php
//
//$bestellingDAO = new BestellingDAO(); 
//$bestellinglijst = $bestellingDAO->getAll(); 
//var_dump($bestellinglijst); 
//
//$bestelling = $bestellingDAO->getById("1"); 
//var_dump($bestelling); 
//
//$bestellingVanKlant = $bestellingDAO->getByKlant($klant); 
//var_dump($bestellingVanKlant); 
//
////src/KristofL/PHPProject/Data/ProductDAO.php
//
//$productDAO = new ProductDAO(); 
//$productlijst = $productDAO->getAll(); 
//var_dump($productlijst); 
//
//$product = $productDAO->getByProductNaam("sandwiches"); 
//var_dump($product); 
//
////src/KristofL/PHPProject/Data/BestellijnDAO.php
//
//$bestellijnDAO = new BestellijnDAO(); 
//$bestellijnenVanBestelling = $bestellijnDAO->getByBestellingId("1"); 
//var_dump($bestellijnenVanBestelling); 



//$adres = "Weg Messelbroek 100";
//echo str_replace(" ", "", $adres);
//echo "<br>";
//$emailadres = "liesenborghs@kristof @gmail.com";
//$wachtwoord = "D00fstom";
//var_dump(check_password($wachtwoord));
//echo "<br>";
//echo filter_var($emailadres, FILTER_VALIDATE_EMAIL);
//$emailadres = filter_var($emailadres, FILTER_SANITIZE_EMAIL);
//echo filter_var($emailadres, FILTER_VALIDATE_EMAIL);
//echo "<br>";
//$msg = "dit is een test, pompoenzaadjes zijn lekker";
//$secret = base64_encode($msg);
//echo $secret . "</br>";
//$desecret = base64_decode($secret);
//echo $desecret . "</br>";
//
//$test = "       ";
//var_dump($test);
//var_dump(noSpace($test));
//
//$check = array();
//array_push($check, TRUE);
//array_push($check, TRUE);
//array_push($check, TRUE);
//array_push($check, TRUE);
//$strict = TRUE;
//var_dump(array_search(FALSE, $check, $strict));
//
//var_dump($check);

//echo "<pre>" . passwordGenerator() . "</pre>";
//
//$woord = "çéèàëäüöïÄËÜÖÿêîôûâÊÂÛÔÎñÑàáúùúóòíìÉÈÆ"; 
//$latinchar = array (
//    'ë' => "e",
//    'ê' => "e", 
//    'é' => "e", 
//    'è' => "e", 
//    'Ê' => "E", 
//    'Ë' => "E", 
//    'É' => "E", 
//    'È' => "E", 
//    'ç' => "c",
//    'Ç' => "C",
//    'â' => "a", 
//    'ä' => "a", 
//    'á' => "a", 
//    'à' => "a",
//    'ã' => "a",
//    'å' => "a", 
//    'Â' => "A",
//    'Ä' => "A", 
//    'Á' => "A", 
//    'À' => "A",
//    'Ã' => "A", 
//    'ô' => "o", 
//    'ö' => "o", 
//    'ó' => "o", 
//    'ò' => "o", 
//    'õ' => "o", 
//    'Ô' => "O", 
//    'Ö' => "O", 
//    'Ó' => "O", 
//    'Ò' => "O", 
//    'Õ' => "O", 
//    'ñ' => "n", 
//    'Ñ' => "N", 
//    'ÿ' => "y", 
//    'ý' => "y", 
//    'Ý' => "Y",
//    'î' => "i", 
//    'ï' => "i", 
//    'í' => "i", 
//    'ì' => "i",
//    'Î' => "I", 
//    'Ï' => "I", 
//    'Í' => "I", 
//    'Ì' => "I",
//    'û' => "u", 
//    'ü' => "u", 
//    'ú' => "u", 
//    'ù' => "u",
//    'Ü' => "U", 
//    'Û' => "U", 
//    'Ú' => "U", 
//    'Ù' => "U", 
//    'Æ' => "AE", 
//    'æ' => "ae",
//    'ß' => "ss",  
//    ); 
//
//$replacetest = strtr($woord, $latinchar); 
//var_dump($woord, $replacetest); 
//$convert = string_to_ascii($replacetest);
//var_dump($convert);
//var_dump(check_valid_input("manuêl", 1, 100));

//function uniord($u) { 
//    $k = mb_convert_encoding($u, 'UCS-2LE', 'UTF-8'); 
//    $k1 = ord(substr($k, 0, 1)); 
//    $k2 = ord(substr($k, 1, 1)); 
//    return $k2 * 256 + $k1; 
//}
//
//function string_to_uniord($string) {
//    $uniord = array();
//    for ($i = 0; $i < strlen($string); $i++) {
//        $char = uniord($string[$i]);
//        array_push($uniord, $char);
//    }
//    return($uniord);
//}
//
//$uniordtest = string_to_uniord("manuël"); 
//var_dump($uniordtest); 

//$word = 'çéèàëäüöïÄËÜÖÿêîôûâÊÂÛÔÎñÑàáúùúóòíìÉÈ';      //'CP850' <- also supported but not listed in php docs
//$wordLatin = mb_convert_encoding($word, 'ISO-8859-1', 'UTF-8');
//$latinchars = array(); 
//for ($i = 0; $i < strlen($wordLatin); $i++) {   
////    echo $word[$i] . ": " . $wordLatin[$i] . ": " . ord($wordLatin[$i]) . ' ';
//    $char = $word[$i] . ": " . ord($wordLatin[$i]); 
//    array_push($latinchars, $char); 
//}
//asort($latinchars); 
//var_dump($latinchars); 
//echo date_default_timezone_get() . "</br>"; 
//date_default_timezone_set("Europe/Brussels"); 
//echo date("Y-m-d", strtotime("today")) . "</br>"; 
//echo date("Y-m-d", strtotime('+1 day')) . "</br>"; 
//echo date("Y-m-d", strtotime('+2 days')) . "</br>"; 
//echo winkelwagenId("liesenborghs.kristof@gmail.com") . "</br>"; 
//$time = strtotime("tomorrow"); 
//echo $time . "</br>";
//echo date("Y-m-d", $time); 


//$productSvc = new ProductService(); 
//$productenByCategorie = $productSvc->getProductListByCategorieList(); 
//var_dump($productenByCategorie); 
//foreach ($productenByCategorie as $lijstNaam => $lijstValue) {
//    echo $lijstNaam . "</br>"; 
////    var_dump($lijstValue);
//    foreach ($lijstValue as $product) {
//        echo $product->getProductNaam() . "</br>"; 
//    }
//} 


$time = date("U", strtotime("now")); 
echo $time . "</br>"; 
echo date("Y-m-d", $time); 

$bestellingDAO = new BestellingDAO();
$bestelling = $bestellingDAO->getById(1); 

$bestellijnSvc = new BestellijnService(); 
$bestelbon = $bestellijnSvc->getBestelbon($bestelling); 

var_dump (current($bestelbon)->getBestelling()->getBevestigd()); 

include_once 'src/KristofL/PHPProject/Presentation/bestelbonPage.php'; 