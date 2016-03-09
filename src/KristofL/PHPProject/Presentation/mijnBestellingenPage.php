<?php
//src/KristofL/PHPProject/Presentation/mijnBestellingenPage.php

namespace KristofL\PHPProject\Presentation;
?>
<table class="mijnAccount">
    <thead>
        <tr>
            <th colspan="2">mijn Bestellingen</th>
        </tr>
    </thead> 
    <tbody>
        <?php foreach ($bestellinglijst as $key => $bestelling) { ?>
            <tr>
                <td>
                    <?php
                    echo "Bestelling van " . $bestelling->getAfhaaldatum() . "</br>";
//                    if ($bestelling->getReferentie() !== null) {
//                        echo "Referentie: " . $bestelling->getReferentie();  
//                    }
                    ?>
                </td>
                <td rowspan="2">
                    <form action="mijnbestellingen.php?action=herbestelling&key=<?php echo $key; ?>&id=<?php echo $bestelling->getBestellingId(); ?>" method="post">
                        <select name="herbestellingsdatum">
                            <option>Beschikbare herbestelling datum</option>                  
                            <?php if ($winkelwagen->getBestellingMorgen()->getBestellingId() == null) { ?>
                                <option value="<?php echo strtotime("+1 day"); ?>">Morgen [<?php echo date(("Y-m-d"), strtotime("+1 day")); ?>]</option>
                            <?php } ?>
                            <?php if ($winkelwagen->getBestellingOvermorgen()->getBestellingId() == null) { ?>
                                <option value="<?php echo strtotime("+2 days"); ?>">Overmorgen [<?php echo date(("Y-m-d"), strtotime("+2 days")); ?>]</option>
                            <?php } ?>
                            <?php if ($winkelwagen->getBestellingOverovermorgen()->getBestellingId() == null) { ?>
                                <option value="<?php echo strtotime("+3 days"); ?>">Overovermorgen [<?php echo date(("Y-m-d"), strtotime("+3 days")); ?>]</option>
                            <?php } ?>                          
                        </select>
                        <input type="submit" value="bevestig besteldatum">
                    </form>
                </td>
            </tr>
            <tr>
                <td>
                    <form action="mijnbestellingen.php?action=referentie&key=<?php echo $key; ?>&date=<?php echo date("U", strtotime($bestelling->getAfhaaldatum())); ?>" method="post">
                        Referentie: <input type="text" name="referentie" value="<?php echo $bestelling->getReferentie(); ?>" placeholder="geef deze bestelling een referentie">
                        <input type="submit" value="<?php if ($bestelling->getReferentie() == null) { ?> bevestig <?php } else { ?> wijzig <?php } ?> referentie">
                    </form>
                </td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>