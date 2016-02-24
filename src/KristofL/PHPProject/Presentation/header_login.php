<?php
//src/KristofL/PHPProject/Presentation/header_login.php

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
            <a href="index.php" id="logo"><span class="redyellow">BroodCode</span></a>
            <div id="orderButton">
                <div>
                    <form id="login" method="post" action="login.php?action=login">
                        <input type="email" placeholder="emailadres" required="" name="emailadres" value="<?php echo $emailadres; ?>">
                        <input type="password" placeholder="wachtwoord" required="" autofocus="" name="wachtwoord">
                        <input type="submit" value="aanmelden">
                    </form>
                    <span id="loginmsg"><?php echo $loginmsg; ?></span>
                </div>
            </div>

        </header>
        <div id="topPijl"></div>
