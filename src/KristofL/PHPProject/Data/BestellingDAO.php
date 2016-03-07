<?php

//src\KristofL\PHPProject\Data\BestellingDAO.php

namespace KristofL\PHPProject\Data;

use KristofL\PHPProject\Entities\Bestelling;
use KristofL\PHPProject\Entities\Klant;
use KristofL\PHPProject\Data\DBConfig;
use KristofL\PHPProject\Data\KlantDAO;
use PDO;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BestellingDAO
 *
 * @author kristof.liesenborghs
 */
class BestellingDAO {

    public function getAll() {
        $sql = "SELECT bestellingID, afhaaldatum, emailadres, afgehaald, referentie, bevestigd FROM bestellingen";

        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $resultSet = $dbh->query($sql);
        $lijst = array();
        $klantDAO = new KlantDAO();
        foreach ($resultSet as $rij) {
            $klant = $klantDAO->getByEmailadres($rij["emailadres"]);
            $bestelling = Bestelling::create($rij["bestellingID"], $rij["afhaaldatum"], $klant, $rij["afgehaald"], $rij["referentie"], $rij["bevestigd"]);
            array_push($lijst, $bestelling);
        }
        $dbh = null;
        return $lijst;
    }

    public function getById($bestellingId) {
        $sql = "SELECT bestellingID, afhaaldatum, emailadres, afgehaald, referentie, bevestigd FROM bestellingen WHERE bestellingID = :bestellingID";

        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':bestellingID' => $bestellingId));
        $rij = $stmt->fetch(PDO::FETCH_ASSOC);
        $klantDAO = new KlantDAO();
        $klant = $klantDAO->getByEmailadres($rij["emailadres"]);
        $bestelling = Bestelling::create($rij["bestellingID"], $rij["afhaaldatum"], $klant, $rij["afgehaald"], $rij["referentie"], $rij["bevestigd"]);
        $dbh = null;
        return $bestelling;
    }

    public function getByKlant($klant) { // = obj. Klant
        $sql = "SELECT bestellingID, afhaaldatum, emailadres, afgehaald, referentie, bevestigd FROM bestellingen WHERE emailadres = :emailadres";

        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':emailadres' => $klant->getEmailadres()));
        $resultSet = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $lijst = array();
        foreach ($resultSet as $rij) {
            $bestelling = Bestelling::create($rij["bestellingID"], $rij["afhaaldatum"], $klant, $rij["afgehaald"], $rij["referentie"], $rij["bevestigd"]);
            array_push($lijst, $bestelling);
        }
        $dbh = null;
        return $lijst;
    }

    public function getByDateFromId($emailadres, $datum) {
        $sql = "SELECT bestellingID, afhaaldatum, emailadres, afgehaald, referentie, bevestigd FROM bestellingen WHERE emailadres = :emailadres AND afhaaldatum = :datum";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':emailadres' => $emailadres, ':datum' => $datum));
        $rij = $stmt->fetch(PDO::FETCH_ASSOC);
        $klantDAO = new KlantDAO();
        $klant = $klantDAO->getByEmailadres($emailadres);
        $bestelling = Bestelling::create($rij["bestellingID"], $datum, $klant, $rij["afgehaald"], $rij["referentie"], $rij["bevestigd"]);
        $dbh = null;
        return $bestelling;
    }

    public function setTempBestelling($afhaaldatum, $emailadres) {
        $sql = "INSERT INTO bestellingen (afhaaldatum, emailadres) VALUES (:afhaaldatum, :emailadres)";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':afhaaldatum' => $afhaaldatum, ':emailadres' => $emailadres));
        $dbh = null;
    }

    public function confirmBestelling($bestellingId) {
        $sql = "UPDATE bestellingen SET bevestigd = TRUE WHERE bestellingID = :bestellingID";
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':bestellingID' => $bestellingId));
        $dbh = null;
    }

}
