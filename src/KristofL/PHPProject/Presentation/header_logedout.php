<?php
//src/KristofL/PHPProject/Presentation/header_logedout.php

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
            <div id="orderButtonLogedout">
                <div>
                    <a  href="index.php?GO=login"><span class="redyellow">Plaats een order</span></a>
                </div>
            </div>
        </header>
        <div id="topPijl"></div>


