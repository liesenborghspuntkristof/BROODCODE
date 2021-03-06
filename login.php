<?php

require_once 'bootstrap.php';
require_once 'validationFunctions.php';
require_once 'algemeneFuncties.php';

use KristofL\PHPProject\Business\WoonplaatsService;
use KristofL\PHPProject\Business\KlantService;
use KristofL\PHPProject\Exceptions\LoginException; 
use KristofL\PHPProject\Exceptions\NewRegistryException;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$woonplaatsSvc = new WoonplaatsService();
$woonplaatslijst = $woonplaatsSvc->getSelectLijst();
//var_dump($woonplaatslijst); 

if (isset($_SESSION["emailadres"])) {
    $emailadres = $_SESSION["emailadres"];
} elseif (isset($_COOKIE["emailadres"])) {
    $emailadres = $_COOKIE["emailadres"];
} else {
    $emailadres = "";
}
if (isset($_SESSION["voornaam"])) {
    $voornaam = $_SESSION["voornaam"]; 
} else {
    $voornaam = ""; 
}

if (isset($_SESSION["familienaam"])) {
    $familienaam = $_SESSION["familienaam"]; 
} else {
    $familienaam = ""; 
}

if (isset($_SESSION["adres"])) {
    $adres = $_SESSION["adres"]; 
} else {
    $adres = ""; 
}

if (isset($_SESSION["postId"])) {
    $postId = $_SESSION["postId"]; 
} else {
    $postId = ""; 
}

if (isset($_GET["action"]) && $_GET["action"] == "login" && isset($_POST["emailadres"])) {
    if (filter_var($_POST["emailadres"], FILTER_VALIDATE_EMAIL) && valid_length($_POST["emailadres"], 6, 100) && check_password($_POST["wachtwoord"])) {
        $_SESSION["emailadres"] = $_POST["emailadres"];
        try {
            $klantSvc = new KlantService();
            $access = $klantSvc->checkLoginByInput($_POST["emailadres"], $_POST["wachtwoord"]);
            if ($access === "granted") {
                $_SESSION["login"] = "valid login";
                $klant = $klantSvc->getklantgegevens($_SESSION["emailadres"]); 
                $_SESSION["klant"] = serialize($klant);  
                setcookie("emailadres", $_POST["emailadres"], time() + 43200); //vervalt na 12 uur
                header('location: winkelwagen.php');
                exit(0);
            }
        } catch (LoginException $ex) {
            $location = "location: login.php?loginmsg=" . base64_encode($ex->getMessage());
            header($location);
            exit(0);
        }
    } else {
        $loginmsg = "foutieve wachtwoord of emailadres input";
        $location = "location: login.php?loginmsg=" . base64_encode($loginmsg);
        header($location);
        exit(0);
    }
}

if (isset($_GET["action"]) && $_GET["action"] == "new" && isset($_POST["emailadres"])) {
    if (filter_var($_POST["emailadres"], FILTER_VALIDATE_EMAIL) && valid_length($_POST["emailadres"], 6, 100)) {
        $_SESSION["emailadres"] = $_POST["emailadres"];
        $valid["emailadres"] = TRUE;
    } else {
        $valid["emailadres"] = FALSE;
        unset($_SESSION["emailadres"]); 
    }
    if (check_valid_input(noSpace(latin_to_ascii($_POST["voornaam"])), 1, 100) && check_no_numbers($_POST["voornaam"])) {
        $_SESSION["voornaam"] = $_POST["voornaam"];
        $valid["voornaam"] = TRUE;
    } else {
        $valid["voornaam"] = FALSE;
        unset($_SESSION["voornaam"]); 
    }
    if (check_valid_input(noSpace(latin_to_ascii($_POST["familienaam"])), 1, 100) && check_no_numbers($_POST["familienaam"])) {
        $_SESSION["familienaam"] = $_POST["familienaam"];
        $valid["familienaam"] = TRUE;
    } else {
        $valid["familienaam"] = FALSE;
        unset($_SESSION["familienaam"]); 
    }
    if (check_valid_input(noSpace(latin_to_ascii($_POST["adres"])), 1, 100) && check_numbers($_POST["adres"])) {
        $_SESSION["adres"] = $_POST["adres"];
        $valid["adres"] = TRUE;
    } else {
        $valid["adres"] = FALSE;
        unset($_SESSION["adres"]); 
    }
    try {
        $woonplaats = $woonplaatsSvc->getById($_POST["postId"]);  
    } catch (Exception $ex) {
        $woonplaats == null; 
    }
    if (check_valid_input($_POST["postId"], 1, 11) && check_only_numbers($_POST["postId"]) && $woonplaats !== null) {
        $_SESSION["postId"] = $_POST["postId"];
        $valid["postId"] = TRUE;
    } else {
        $valid["postId"] = FALSE;
        unset($_SESSION["postId"]); 
    }
    $strict = TRUE;
    if (array_search(FALSE, $valid, $strict)) {
        $location = "location: login.php?Regmsg=" . base64_encode("foutieve invoer, pas de legen velden aan");
        header($location);
        exit(0);
    } else {
        try {
            $klantSvc = new KlantService();
            $klantSvc->checkEnStoreNieuweGebruiker($_POST["emailadres"], $_POST["voornaam"], $_POST["familienaam"], $_POST["adres"], $_POST["postId"]);
            $klant = $klantSvc->getklantgegevens($_POST["emailadres"]);
            $_SESSION["klant"] = serialize($klant); 
        } catch (NewRegistryException $ex) {
            $location = "location: login.php?Regmsg=" . base64_encode($ex->getMessage());
            header($location);
            exit(0);
        }
        $_SESSION["login"] = "valid login";
        setcookie("emailadres", $_SESSION["emailadres"], time() + 43200); //vervalt na 12 uur
        header("location: mijnaccount.php?action=newbie");
        exit(0);
    }
}


//    }
//    if ($validInput) {
//        if ($validLogin) {
//            $_SESSION["login"] = "valid login";
//            $_SESSION["oneTimer"] = TRUE;
//            header('location: winkelwagen.php?gebruiker=new');
//            exit(0);
//        }
//    }
//}

if (isset($_GET["loginmsg"])) {
    $loginmsg = base64_decode($_GET["loginmsg"]);
} else {
    $loginmsg = "";
}

if (isset($_GET["Regmsg"])) {
    $Regmsg = base64_decode($_GET["Regmsg"]);
} else {
    $Regmsg = "";
}

if (isset($_SESSION["emailadres"]) && isset($_SESSION["login"]) && $_SESSION["login"] === "valid login") {
    header('location:winkelwagen.php'); 
    exit(0); 
}
include 'src/KristofL/PHPProject/Presentation/header_login.php';
include 'src/KristofL/PHPProject/Presentation/loginForm.php';
include 'src/KristofL/PHPProject/Presentation/footer.php';
