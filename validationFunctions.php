<?php

//validationFunctions.php


/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of validationFunctions
 *
 * @author kristof.liesenborghs
 */
function string_to_ascii($string) {
    $ascii = array();
    for ($i = 0; $i < strlen($string); $i++) {
        $char = ord($string[$i]);
        array_push($ascii, $char);
    }
    return($ascii);
}

function valid_length($string, $minLength, $maxLength) {
    $valid = False;
    if (strlen($string) >= $minLength && strlen($string) <= $maxLength) {
        $valid = TRUE;
    }
    return $valid;
}

function check_valid_input($string, $minLength, $maxLength) {
    $valid = FALSE;
    if (valid_length($string, $minLength, $maxLength)) {
        $asciiArray = string_to_ascii($string);
        foreach ($asciiArray as $ascii) {
            switch (TRUE) {
                case ($ascii >= 48 && $ascii <= 57):  //numbers
                    $valid = TRUE;
                    break;
                case ($ascii >= 64 && $ascii <= 90):  //@ + UpperCase letters
                    $valid = TRUE;
                    break;
                case ($ascii >= 97 && $ascii <= 122): //lowerCase letters
                    $valid = TRUE;
                    break;
                case $ascii == 35://#
                case $ascii == 46://.
                case $ascii == 45://-
                case $ascii == 95://_
                    $valid = TRUE;
                    break;
                default :
                    $valid = FALSE;
            }
            if ($valid === FALSE) {
                break;
            }
        }
    }
    return $valid;
}

function check_no_numbers($string) {
    $noNumbers = TRUE;
    $asciiArray = string_to_ascii($string);
    foreach ($asciiArray as $ascii) {
        if ($ascii >= 48 && $ascii <= 57) {
            $noNumbers = FALSE;
        }
        if ($noNumbers == FALSE) {
            break;
        }
    }
    return $noNumbers;
}

function check_numbers($string) {
    $Numbers = FALSE;
    $asciiArray = string_to_ascii($string);
    foreach ($asciiArray as $ascii) {
        if ($ascii >= 48 && $ascii <= 57) {
            $Numbers = TRUE;
        }
        if ($Numbers == TRUE) {
            break;
        }
    }
    return $Numbers;
}

function check_only_numbers($string) {
    $onlyNumbers = FALSE;
    $counter = 0;
    $asciiArray = string_to_ascii($string);
    foreach ($asciiArray as $ascii) {
        if ($ascii >= 48 && $ascii <= 57) {
            $counter++;
        }
    }
    if (strlen($string) == $counter) {
        $onlyNumbers = TRUE;
    }
    return $onlyNumbers;
}

function check_at($string) { //bool filter_var($string, FILTER_VALIDATE_EMAIL)
    $at = FALSE;
    $atCounter = 0;
    $asciiArray = string_to_ascii($string);
    foreach ($asciiArray as $ascii) {
        if ($ascii == 64) {
            $atCounter++;
        }
    }
    if ($atCounter == 1) {
        $at = TRUE;
    }
    return $at;
}

function check_space($string) { //remove space from string => str_replace(" ", "", $string); 
    $space = FALSE;
    $asciiArray = string_to_ascii($string);
    foreach ($asciiArray as $ascii) {
        if ($ascii == 32) {
            $space = TRUE;
        }
    }
    return $space;
}

function check_password($string) {
    $passwordCheck = FALSE;
    $numberCount = 0;
    $capitalCount = 0;
    if (check_valid_input($string, 6, 40)) {
        $asciiArray = string_to_ascii($string);
        foreach ($asciiArray as $ascii) {
            switch (TRUE) {
                case ($ascii >= 48 && $ascii <= 57):  //numbers
                    $numberCount ++;
                    break;
                case ($ascii >= 65 && $ascii <= 90):  //UpperCase letters
                    $capitalCount ++;
                    break;
            }
        }
        if ($numberCount > 0 && $capitalCount > 0) {
            $passwordCheck = TRUE;
        }
    }
    return $passwordCheck;
}


