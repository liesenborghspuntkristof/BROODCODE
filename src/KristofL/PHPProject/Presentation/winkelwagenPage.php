<?php
//src/KristofL/PHPProject/Presentation/winkelwagenPage.php

namespace KristofL\PHPProject\Presentation;
?>
<table class="mijnAccount">
    <thead>
        <tr>
            <th>Winkelwagen</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td <?php
            if ($winkelwagen->getAfhalingVandaag()->getBestellingId() !== null && $winkelwagen->getAfhalingVandaag()->getBevestigd()) {
                echo 'rowspan="2"';
            }
            ?>>
                Afhaling, vandaag [<?php echo date("Y-m-d"); ?>]
                <?php
                if ($winkelwagen->getAfhalingVandaag()->getBestellingId() !== null && $winkelwagen->getAfhalingVandaag()->getBevestigd() && isset($_GET["action"]) && $_GET["action"] == "expand" && isset($_GET["date"]) && $_GET["date"] == "vandaag") {
                    echo "<a href='winkelwagen.php?'><i class='fa fa-caret-square-o-up'></i></a>";
                } elseif ($winkelwagen->getAfhalingVandaag()->getBestellingId() !== null && $winkelwagen->getAfhalingVandaag()->getBevestigd()) {
                    ?>
                    <a href="winkelwagen.php?action=expand&date=vandaag"><i class="fa fa-caret-square-o-down"></i></a>
                    <?php
                }
                ?>
            </td>
            <?php if ($winkelwagen->getAfhalingVandaag()->getBestellingId() !== null && $winkelwagen->getAfhalingVandaag()->getBevestigd()) { ?>
                <td colspan="2">
                    <?php if ($winkelwagen->getAfhalingVandaag()->getAfgehaald() == 0) { ?>
                        U heeft een bestelling om vandaag af te halen
                    <?php } else { ?>
                        uw bestelling van vandaag is al afgehaald
                    <?php } ?>
                </td>
            </tr>
            <tr colspan="2">
                <td><a href="broodcode.php?action=broodcode&date=vandaag">Krijg BroodCode</a></td>         
            <?php } else { ?>
                <td colspan ="2">Geen afhaling</td>
            <?php } ?>
        </tr>
        <?php
        if ($winkelwagen->getAfhalingVandaag()->getBestellingId() !== null && $winkelwagen->getAfhalingVandaag()->getBevestigd() && isset($_GET["action"]) && $_GET["action"] == "expand" && isset($_GET["date"]) && $_GET["date"] == "vandaag") {
            $bestelbon = $bestellijnSvc->getBestelbon($winkelwagen->getAfhalingVandaag());
            echo "<tr><td colspan='3'>";
            include 'src/KristofL/PHPProject/Presentation/bestelbonPage.php';
            echo "</td></tr>";
        }
        ?>
        <tr>
            <td <?php
            if ($winkelwagen->getBestellingMorgen()->getBestellingId() !== null) {
                echo 'rowspan="2"';
            }
            ?>>
                Bestelling voor morgen [<?php echo date(("Y-m-d"), strtotime("+1 day")); ?>]
                <?php
                if ($winkelwagen->getBestellingMorgen()->getBestellingId() !== null && isset($_GET["action"]) && $_GET["action"] == "expand" && isset($_GET["date"]) && $_GET["date"] == "morgen") {
                    echo "<a href='winkelwagen.php?'><i class='fa fa-caret-square-o-up'></i></a>";
                } elseif ($winkelwagen->getBestellingMorgen()->getBestellingId() !== null) {
                    ?>
                    <a href="winkelwagen.php?action=expand&date=morgen"><i class="fa fa-caret-square-o-down"></i></a>
                <?php }
                ?>
            </td>
            <?php
            if ($winkelwagen->getBestellingMorgen()->getBestellingId() !== null) {
                if ($winkelwagen->getBestellingMorgen()->getBevestigd()) {
                    ?>
                    <td colspan="2"><a href="broodcode.php?action=broodcode&date=morgen">Krijg BroodCode</a></td>
                <?php } else { ?>
                    <td colspan="2"><a href="winkelen.php?action=bevestig&date=morgen">Bevestig bestelling</a></td>
                <?php } ?>
            </tr>
            <tr>
                <td><a href="winkelen.php?action=wijzig&date=morgen">Wijzig bestelling</a></td>
                <td><a href="winkelen.php?action=annuleer&date=morgen">Annuleer bestelling</a></td>
            <?php } else { ?>
                <td colspan="2"><a href="winkelen.php?action=winkelen&date=morgen">Plaats bestelling</a></td>
            <?php } ?>
        </tr>
        <?php
        if ($winkelwagen->getBestellingMorgen()->getBestellingId() !== null && isset($_GET["action"]) && $_GET["action"] == "expand" && isset($_GET["date"]) && $_GET["date"] == "morgen") {
            $bestelbon = $bestellijnSvc->getBestelbon($winkelwagen->getBestellingMorgen());
            echo "<tr><td colspan='3'>";
            include 'src/KristofL/PHPProject/Presentation/bestelbonPage.php';
            echo "</td></tr>";
        }
        ?>
        <tr>
            <td <?php
            if ($winkelwagen->getBestellingOvermorgen()->getBestellingId() !== null) {
                echo 'rowspan="2"';
            }
            ?>>
                Bestelling voor overmorgen [<?php echo date(("Y-m-d"), strtotime("+2 days")); ?>]
                <?php
                if ($winkelwagen->getBestellingOvermorgen()->getBestellingId() !== null && isset($_GET["action"]) && $_GET["action"] == "expand" && isset($_GET["date"]) && $_GET["date"] == "overmorgen") {
                    echo "<a href='winkelwagen.php?'><i class='fa fa-caret-square-o-up'></i></a>";
                } elseif ($winkelwagen->getBestellingOvermorgen()->getBestellingId() !== null) {
                    ?>
                    <a href="winkelwagen.php?action=expand&date=overmorgen"><i class="fa fa-caret-square-o-down"></i></a>
                <?php }
                ?>
            </td>
            <?php
            if ($winkelwagen->getBestellingOvermorgen()->getBestellingId() !== null) {
                if ($winkelwagen->getBestellingOvermorgen()->getBevestigd()) {
                    ?>
                    ?>
                    <td colspan="2"><a href="broodcode.php?action=broodcode&date=overmorgen">Krijg BroodCode</a></td>
                <?php } else { ?>
                    <td colspan="2"><a href="winkelen.php?action=bevestig&date=overmorgen">Bevestig bestelling</a></td>
                <?php } ?>
            </tr>
            <tr>
                <td><a href="winkelen.php?action=wijzig&date=overmorgen">Wijzig bestelling</a></td>
                <td><a href="winkelen.php?action=annuleer&date=overmorgen">Annuleer bestelling</a></td>
            <?php } else { ?>
                <td colspan="2"><a href="winkelen.php?action=winkelen&date=overmorgen">Plaats bestelling</a></td>
            <?php } ?>
        </tr>
        <?php
        if ($winkelwagen->getBestellingOvermorgen()->getBestellingId() !== null && isset($_GET["action"]) && $_GET["action"] == "expand" && isset($_GET["date"]) && $_GET["date"] == "overmorgen") {
            $bestelbon = $bestellijnSvc->getBestelbon($winkelwagen->getBestellingOvermorgen());
            echo "<tr><td colspan='3'>";
            include 'src/KristofL/PHPProject/Presentation/bestelbonPage.php';
            echo "</td></tr>";
        }
        ?>
        <tr>
            <td <?php
            if ($winkelwagen->getBestellingOverovermorgen()->getBestellingId() !== null) {
                echo 'rowspan="2"';
            }
            ?>>
                Bestelling voor overovermorgen [<?php echo date(("Y-m-d"), strtotime("+3 days")); ?>]
                <?php
                if ($winkelwagen->getBestellingOverovermorgen()->getBestellingId() !== null && isset($_GET["action"]) && $_GET["action"] == "expand" && isset($_GET["date"]) && $_GET["date"] == "overovermorgen") {
                    echo "<a href='winkelwagen.php?'><i class='fa fa-caret-square-o-up'></i></a>";
                } elseif ($winkelwagen->getBestellingOverovermorgen()->getBestellingId() !== null) {
                    ?>
                    <a href="winkelwagen.php?action=expand&date=overovermorgen"><i class="fa fa-caret-square-o-down"></i></a>
                    <?php }
                    ?>
            </td>
            <?php
            if ($winkelwagen->getBestellingOverovermorgen()->getBestellingId() !== null) {
                if ($winkelwagen->getBestellingOverovermorgen()->getBevestigd()) {
                    ?>
                    ?>
                    <td colspan="2"><a href="broodcode.php?action=broodcode&date=overovermorgen">Krijg BroodCode</a></td>
                <?php } else { ?>
                    <td colspan="2"><a href="winkelen.php?action=bevestig&date=overovermorgen">Bevestig bestelling</a></td>
                <?php } ?>
            </tr>
            <tr>
                <td><a href="winkelen.php?action=wijzig&date=overovermorgen">Wijzig bestelling</a></td>
                <td><a href="winkelen.php?action=annuleer&date=overovermorgen">Annuleer bestelling</a></td>
            <?php } else { ?>
                <td colspan="2"><a href="winkelen.php?action=winkelen&date=overovermorgen">Plaats bestelling</a></td>
            <?php } ?>
        </tr>
        <?php
        if ($winkelwagen->getBestellingOverovermorgen()->getBestellingId() !== null && isset($_GET["action"]) && $_GET["action"] == "expand" && isset($_GET["date"]) && $_GET["date"] == "overovermorgen") {
            $bestelbon = $bestellijnSvc->getBestelbon($winkelwagen->getBestellingOverovermorgen());
            echo "<tr><td colspan='3'>";
            include 'src/KristofL/PHPProject/Presentation/bestelbonPage.php';
            echo "</td></tr>";
        }
        ?>
    </tbody>
</table>

