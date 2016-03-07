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
            <td <?php if ($winkelwagen->getAfhalingVandaag()->getBestellingId() !== null) {
    echo 'rowspan="2"';
} ?>>
                Afhaling, vandaag [<?php echo date("Y-m-d"); ?>]
                <a href="winkelwagen.php?action=expand&date=vandaag"><i class="fa fa-caret-square-o-down"></i></a>
            </td>
                <?php if ($winkelwagen->getAfhalingVandaag()->getBestellingId() !== null) { ?>
                <td>
                    <?php if ($winkelwagen->getAfhalingVandaag()->getAfgehaald() == 0) { ?>
                        U heeft een bestelling om vandaag af te halen
                    <?php } else { ?>
                        uw bestelling van vandaag is al afgehaald
    <?php } ?>
                </td>
            </tr>
            <tr>
                <td><a href="broodcode.php?action=broodcode&date=vandaag">Krijg BroodCode</a></td>
            </tr>
    <?php } else { ?>
        <td>Geen afhaling</td>
<?php } ?>
</tr>
<tr>
    <td <?php if ($winkelwagen->getBestellingMorgen()->getBestellingId() !== null) {
    echo 'rowspan="2"';
} ?>>
        Bestelling voor morgen [<?php echo date(("Y-m-d"), strtotime("+1 day")); ?>]
    </td>
<?php if ($winkelwagen->getBestellingMorgen()->getBestellingId() !== null) { ?>
        <td><a href="broodcode.php?action=broodcode&date=morgen">Krijg BroodCode</a></td>
    </tr>
    <tr>
        <td><a href="winkelen.php?action=wijzig&date=morgen">Wijzig bestelling</a></td>
    </tr>
<?php } else { ?>
    <td><a href="winkelen.php?action=winkelen&date=morgen">Plaats bestelling</a></td>
<?php } ?>
</tr>
<tr>
    <td <?php if ($winkelwagen->getBestellingOvermorgen()->getBestellingId() !== null) {
    echo 'rowspan="2"';
} ?>>
        Bestelling voor overmorgen [<?php echo date(("Y-m-d"), strtotime("+2 days")); ?>]
    </td>
<?php if ($winkelwagen->getBestellingOvermorgen()->getBestellingId() !== null) { ?>
        <td><a href="broodcode.php?action=broodcode&date=overmorgen">Krijg BroodCode</a></td>
    </tr>
    <tr>
        <td><a href="winkelen.php?action=wijzig&date=overmorgen">Wijzig bestelling</a></td>
    </tr>
<?php } else { ?>
    <td><a href="winkelen.php?action=winkelen&date=overmorgen">Plaats bestelling</a></td>
    <?php } ?>
</tr>
<tr>
    <td <?php if ($winkelwagen->getBestellingOverovermorgen()->getBestellingId() !== null) {
        echo 'rowspan="2"';
    } ?>>
        Bestelling voor overovermorgen [<?php echo date(("Y-m-d"), strtotime("+1 day")); ?>]
    </td>
<?php if ($winkelwagen->getBestellingOverovermorgen()->getBestellingId() !== null) { ?>
        <td><a href="broodcode.php?action=broodcode&date=overovermorgen">Krijg BroodCode</a></td>
    </tr>
    <tr>
        <td><a href="winkelen.php?action=wijzig&date=overovermorgen">Wijzig bestelling</a></td>
    </tr>
<?php } else { ?>
    <td><a href="winkelen.php?action=winkelen&date=overovermorgen">Plaats bestelling</a></td>
<?php } ?>
</tr>
</tbody>
</table>
<?php
// put your code here
?>

