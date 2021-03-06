<?php

use KristofL\PHPProject\Exceptions\FunctionException;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function noSpace($string) {
    $spaceless = str_replace(" ", "", $string);
    return $spaceless;
}

function latin_to_ascii($string) {
    $latinchars = array(
        'ë' => "e",
        'ê' => "e",
        'é' => "e",
        'è' => "e",
        'Ê' => "E",
        'Ë' => "E",
        'É' => "E",
        'È' => "E",
        'ç' => "c",
        'Ç' => "C",
        'â' => "a",
        'ä' => "a",
        'á' => "a",
        'à' => "a",
        'ã' => "a",
        'å' => "a",
        'Â' => "A",
        'Ä' => "A",
        'Á' => "A",
        'À' => "A",
        'Ã' => "A",
        'ô' => "o",
        'ö' => "o",
        'ó' => "o",
        'ò' => "o",
        'õ' => "o",
        'Ô' => "O",
        'Ö' => "O",
        'Ó' => "O",
        'Ò' => "O",
        'Õ' => "O",
        'ñ' => "n",
        'Ñ' => "N",
        'ÿ' => "y",
        'ý' => "y",
        'Ý' => "Y",
        'î' => "i",
        'ï' => "i",
        'í' => "i",
        'ì' => "i",
        'Î' => "I",
        'Ï' => "I",
        'Í' => "I",
        'Ì' => "I",
        'û' => "u",
        'ü' => "u",
        'ú' => "u",
        'ù' => "u",
        'Ü' => "U",
        'Û' => "U",
        'Ú' => "U",
        'Ù' => "U",
        'Æ' => "AE",
        'æ' => "ae",
        'ß' => "ss",
    );

    $convert = strtr($string, $latinchars);
    return $convert;
}

function passwordEncrypt($username, $password) {
    if (defined("CRYPT_BLOWFISH") && CRYPT_BLOWFISH) {
        $salt = strtoupper(strrev($username));
        $data = crypt($password, $salt);
        $hashedValue = hash('sha256', $data);
        return $hashedValue; //length == 64; 
    } else {
        throw new LoginException("No blowfish for sale, try again or contact support");
    }
}

function passwordGenerator() {
    $randomPassword = "";
    $rand = rand(1, 3);
    $password = array();
    for ($t = 0; $t < $rand; $t++) {
        array_push($password, chr(rand(65, 90)));
    }
    for ($t = 0; $t < (6 - $rand); $t++) {
        array_push($password, rand(0, 9));
    }
    shuffle($password);
    foreach ($password as $char) {
        $randomPassword = $randomPassword . $char;
    }
    return $randomPassword;
}

function winkelwagenId($login) {
    $winkelwagenId = abs(crc32("De winkelwagen van login: " . $login));
    return $winkelwagenId;
}

function interpreteerGETDate($date) {
    switch ($date) {
        case "vandaag":
            $time = date("U", strtotime("today"));
            break;
        case "morgen":
            $time = date("U", strtotime("+1 day"));
            break;
        case "overmorgen":
            $time = date("U", strtotime("+2 days"));
            break;
        case "overovermorgen":
            $time = date("U", strtotime("+3 days"));
            break;
        default:
            throw new FunctionException("time error: wrong universe or limited dimension");
    }
    return $time; //timestamp of day
}

function DatumNaarWoord($datum) { //Y-m-d datumnotatie
    switch ($datum) {
        case date("Y-m-d", strtotime("today")):
            $woordDatum = "vandaag";
            break;
        case date("Y-m-d", strtotime("+1 day")):
            $woordDatum = "morgen";
            break;
        case date("Y-m-d", strtotime("+2 days")):
            $woordDatum = "overmorgen";
            break;
        case date("Y-m-d", strtotime("+3 days")):
            $woordDatum = "overovermorgen";
            break;
        default:
            throw new FunctionException("time error: wrong universe or limited dimension");
    }
    return $woordDatum; //timestamp of day
}
