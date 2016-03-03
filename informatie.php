<?php

require_once 'bootstrap.php';

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!isset($_SESSION["login"]) || $_SESSION["login"] !== "valid login" || !isset($_SESSION["klant"])) {
    include 'src/KristofL/PHPProject/Presentation/header_logedout.php'; 
} else {
    include 'src/KristofL/PHPProject/Presentation/header_logedin.php';
}
include 'src/KristofL/PHPProject/Presentation/about.php'; 
include 'src/KristofL/PHPProject/Presentation/footer.php'; 
