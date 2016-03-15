<?php
//src/KristofL/PHPProject/Presentation/header_logedin.php

namespace KristofL\PHPProject\Presentation;
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <link href="src/KristofL/PHPProject/Presentation/css/main.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <meta charset="UTF-8">
        <title>BroodCode</title>
    </head>
    <body>
        <header>
            <a href="index.php" id="logo"><i class="xs_on sm_on fa fa-barcode fa-3x redyellow"></i><span class="md_on lg_on xl_on xxl_on redyellow">BroodCode</span></a>
            <div id="orderButtonLogedin">
                <span class="xs_on sm_on md_on lg_on xl_on xxl_on geel">Welkom <?php echo unserialize($_SESSION["klant"])->getVoornaam() . " " . unserialize($_SESSION["klant"])->getFamilienaam(); ?></span>
                <a href="mijnaccount.php"><i class="fa fa-user fa-lg redpetrol"></i></a>
                <a href="winkelwagen.php"><i class="fa fa-shopping-cart fa-lg redpetrol"></i></a>
                <a href="mijnbestellingen.php"><i class="fa fa-history fa-lg redpetrol"></i></a>
                <div>
                    <form id="logout" method="post" action="index.php?action=logout">                      
                        <input type="submit" value="afmelden">
                    </form>
<!--                    <span id="loginmsg"><?php echo $loginmsg; ?></span>-->
                </div>
            </div>

        </header>
        <div id="topPijl"></div>

