<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

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


