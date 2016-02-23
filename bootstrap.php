<?php
//bootstrap.php

use Doctrine\Common\ClassLoader;
require_once("Doctrine/Common/ClassLoader.php"); 
session_start(); 

$classLoader = new ClassLoader("KristofL", "src");
$classLoader->register();

//meer Doctrine-specifieke code


