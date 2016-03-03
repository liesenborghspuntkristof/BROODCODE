<?php

require_once 'bootstrap.php';
require_once 'validationFunctions.php';
require_once 'algemeneFuncties.php';

use KristofL\PHPProject\Business\WoonplaatsService;
use KristofL\PHPProject\Business\KlantService;
use KristofL\PHPProject\Exceptions\AccountException;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!isset($_SESSION["login"]) || $_SESSION["login"] !== "valid login" || !isset($_SESSION["klant"])) {
    header('location: login.php');
    exit(0);
} else {
    $klantSvc = new KlantService();
//    if (!isset($_SESSION["klant"])) {     
//        $klant = $klantSvc->getklantgegevens($_SESSION["emailadres"]);         
//    } else {
        $klant = unserialize($_SESSION["klant"]); 
//    }

    if (strlen($klant->getWachtwoord()) !== 64) {
        $wachtwoord = $klant->getWachtwoord() . "<span class='warning'>  --wachtwoord is niet beveiligd, wijzig je wachtwoord</span>";
    } else {
        $wachtwoord = "**********";
    }


    if (isset($_GET["action"]) && $_GET["action"] == "wachtwoord") {
        require_once 'src/KristofL/PHPProject/Presentation/header_logedin.php';
        require_once 'src/KristofL/PHPProject/Presentation/mijnAccountForm.php';
        require_once 'src/KristofL/PHPProject/Presentation/mijnGegevensPage.php';
        require_once 'src/KristofL/PHPProject/Presentation/footer.php';
    } elseif (isset($_GET["action"]) && $_GET["action"] == "gegevens") {
        $woonplaatsSvc = new WoonplaatsService();
        $woonplaatslijst = $woonplaatsSvc->getSelectLijst();
        require_once 'src/KristofL/PHPProject/Presentation/header_logedin.php';
        require_once 'src/KristofL/PHPProject/Presentation/mijnAccountPage.php';
        require_once 'src/KristofL/PHPProject/Presentation/mijnGegevensForm.php';
        require_once 'src/KristofL/PHPProject/Presentation/footer.php';
    } elseif (isset($_GET["action"]) && $_GET["action"] == "newpwd" && isset($_POST["wachtwoord"]) && isset($_POST["wachtwoordConf"])) {
        if (check_password($_POST["wachtwoord"]) == FALSE) {
            $location = "location: mijnaccount.php?action=wachtwoord&pwdmsg=" . base64_encode("foutief wachtwoord. Een wachtwoord moet zijn;  min. 8, max. 40 karakters lang / min. 1 hoofdletter / min. 1 cijfer / geen speciale tekens buiten @ . # - _");
            header($location);
            exit(0);
        } elseif ($_POST["wachtwoord"] !== $_POST["wachtwoordConf"]) {
            $location = "location: mijnaccount.php?action=wachtwoord&pwdmsg=" . base64_encode("Wachtwoord niet 2x hetzelfde, geef het opnieuw in");
            header($location);
            exit(0);
        } else {
            $klantsvc = new KlantService();
            $klantsvc->encryptEnSetNieuwWachtwoord($klant, $_POST["wachtwoord"]);
            header('location: mijnaccount.php');
            exit(0);
        }
    } elseif (isset($_GET["action"]) && $_GET["action"] == "newgeg" && isset($_POST["voornaam"]) && isset($_POST["familienaam"]) && isset($_POST["adres"]) && isset($_POST["postId"])) {
        if (check_valid_input(noSpace(latin_to_ascii($_POST["voornaam"])), 1, 100) && check_no_numbers($_POST["voornaam"])) {
            $valid["voornaam"] = TRUE;
            $klant->setVoornaam($_POST["voornaam"]);
            $_SESSION["klant"] = serialize($klant); 
        } else {
            $valid["voornaam"] = FALSE;
        }
        if (check_valid_input(noSpace(latin_to_ascii($_POST["familienaam"])), 1, 100) && check_no_numbers($_POST["familienaam"])) {
            $valid["familienaam"] = TRUE;
            $klant->setFamilienaam($_POST["familienaam"]);
            $_SESSION["klant"] = serialize($klant);
        } else {
            $valid["familienaam"] = FALSE;
        }
        if (check_valid_input(noSpace(latin_to_ascii($_POST["adres"])), 1, 100) && check_numbers($_POST["adres"])) {
            $valid["adres"] = TRUE;
            $klant->setAdres($_POST["adres"]);
            $_SESSION["klant"] = serialize($klant);
        } else {
            $valid["adres"] = FALSE;
        }
        if (check_valid_input($_POST["postId"], 1, 11) && check_only_numbers($_POST["postId"])) {
            $valid["postId"] = TRUE;
            try {
                $woonplaatsSvc = new WoonplaatsService(); 
                $woonplaats = $woonplaatsSvc->getById($_POST["postId"]);
                $klant->setWoonplaats($woonplaats);
                $_SESSION["klant"] = serialize($klant);
            } catch (AccountException $ex) {
                $location = "location: mijnaccount.php?action=gegevens&gegmsg=" . base64_encode("foutieve invoer, gebruik van ongeldige tekens") . base64_encode("</br>" . $ex->getMessage());
                header($location);
                exit(0);
            }
        }
        $strict = TRUE;
        if (array_search(FALSE, $valid, $strict)) {
            $location = "location: mijnaccount.php?action=gegevens&gegmsg=" . base64_encode("foutieve invoer, gebruik van ongeldige tekens");
            header($location);
            exit(0);
        } else {
            $klantSvc->updateGegevens($klant); 
            header ('location: mijnaccount.php'); 
            exit(0); 
        }
    } else {
        require_once 'src/KristofL/PHPProject/Presentation/header_logedin.php';
        require_once 'src/KristofL/PHPProject/Presentation/mijnAccountPage.php';
        require_once 'src/KristofL/PHPProject/Presentation/mijnGegevensPage.php';
        require_once 'src/KristofL/PHPProject/Presentation/footer.php';
    }
    if (isset($_GET["action"]) && $_GET["action"] == "newbie" && strlen($klant->getWachtwoord()) !== 64) {
        $msg = "Uw willekeurig gegenereerd wachtwoord: " . $klant->getWachtwoord() . "\\nDit wachtwoord is niet beveiligd, gelieve het onmiddellijk te wijzigen";
        echo "<script type='text/javascript'>alert('" . $msg . "');</script>";
    }
}

    