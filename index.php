<?php
require_once 'bootstrap.php';

if (isset($_GET["GO"]) && $_GET["GO"] == "login") {
    header('location: login.php'); 
    exit(0); 
}

if (isset($_GET["GO"]) && $_GET["GO"] == "info") {
    header('location: informatie.php'); 
    exit(0); 
}

if (isset($_GET["action"]) && $_GET["action"] == "logout") {
    session_destroy(); 
    header('location: index.php'); 
    exit(0); 
}

include 'src/KristofL/PHPProject/Presentation/landingPage.php'; 
