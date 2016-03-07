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
        <?php foreach ($bestellinglijst as $bestelling) { ?>
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
                    <form action="winkelwagen.php?action=herbestelling" method="post">
                        <select name="herbestellingsdatum">
                            <option>Herbestelling datum</option>                  
                            <?php if ($winkelwagen->getBestellingMorgen()->getBestellingId() == null) { ?>
                                <option value="<?php echo strtotime("+1 day"); ?>">Morgen [<?php echo date(("Y-m-d"), strtotime("+1 day")); ?>]</option>
                            <?php } ?>
                            <?php if ($winkelwagen->getBestellingOvermorgen()->getBestellingId() == null) { ?>
                                <option value="<?php echo strtotime("+2 days"); ?>">Overmorgen [<?php echo date(("Y-m-d"), strtotime("+2 days")); ?>]</option>
                            <?php } ?>
                            <?php if ($winkelwagen->getBestellingOverovermorgen()->getBestellingId() == null) { ?>
                                <option value="<?php echo strtotime("+3 days"); ?>">Morgen [<?php echo date(("Y-m-d"), strtotime("+3 days")); ?>]</option>
                            <?php } ?>                          
                        </select>
                        <input type="submit" value="bevestig datum">
                    </form>
                </td>
            </tr>
            <tr>
                <td>
                    <form action="mijnbestellingen.php?action=ref" method="post">
                        Referentie: <input type="text" name="referentie" value="<?php echo $bestelling->getReferentie(); ?>" placeholder="geef deze bestelling een referentie" required="">
                        <input type="submit" value="bevestig">
                    </form>
                </td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>