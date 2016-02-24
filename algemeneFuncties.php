<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function noSpace($string) {
    $spaceless = str_replace(" ", "", $string);
    return $spaceless;
}


function passwordEncrypt($username, $password) {
    if (defined("CRYPT_BLOWFISH") && CRYPT_BLOWFISH) {
        $salt = strtoupper(strrev($username));
        $data = crypt($password, $salt);
        $hashedValue = hash('sha256', $data);
        return $hashedValue;
    } else {
        throw new NewException("No blowfish for sale, try again or contact support");
    }
}

function passwordGenerator () {
    $randomPassword = ""; 
    $rand = rand(1,3); 
    $password = array(); 
    for ($t=0; $t<$rand; $t++) {
        array_push($password, chr(rand(65,90)));                
    }
    for ($t=0; $t<(6-$rand); $t++) {
        array_push($password, rand(0,9));                
    }
    shuffle($password); 
    foreach ($password as $char) {
        $randomPassword = $randomPassword . $char; 
    }
    return $randomPassword; 
}
