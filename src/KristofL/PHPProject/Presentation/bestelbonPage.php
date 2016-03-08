<?php
//src/KristofL/PHPProject/Presentation/bestelbonPage.php

namespace KristofL\PHPProject\Presentation;

$btw = 21;
?>
<div>
    <p>BroodCode Inc.</p>
    <p>Ernest Claeslaan 42</p>
    <p>B-3271 Zichem</p>
</div>
<div>
    <em>Afhaaldatum: </em><?php echo current($bestelbon)->getBestelling()->getAfhaaldatum(); ?>
</div>
<table>
    <thead>
        <tr>
            <td>
                Aantal
            </td>
            <td>
                Omschrijving
            </td>
            <td>
                Euro per st.
            </td>
            <td>
                Totaal
            </td>
        </tr>
    </thead>
    <tfoot>
        <tr class="vet">
            <td colspan="3">
                Totaalprijs
            </td>
            <td>
                <?php
                $totaalprijs = 0;
                foreach ($bestelbon as $bestellijn) {
                    $totaalprijs = $totaalprijs + ($bestellijn->getProduct()->getProductPrijs() * $bestellijn->getHoeveelheid());
                }
                echo "€ " . number_format($totaalprijs, 2);
                ?>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                BTW
            </td>
            <td>
<?php echo $btw . " %"; ?>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                Subtotaal
            </td>
            <td>
                <?php
                $subtotaal = $totaalprijs - ($totaalprijs * $btw / 100);
                echo "€ " . number_format($subtotaal, 2);
                ?>
            </td>
        </tr>
        <?php
        if ($bestelbon[0]->getBestelling()->getBevestigd()) {
            ?>
            <tr>
                <td colspan="4">
                <img src='http://barcode.tec-it.com/barcode.ashx?data=<?php echo $bestelbon[0]->getBestelling()->getBestellingId() . date(("Ymd"), strtotime($bestelbon[0]->getBestelling()->getAfhaaldatum())); ?>&code=Code128&dpi=96' alt='Barcode Generator TEC-IT'/>
                </td>
            </tr>
            <?php
        }
        ?>
    </tfoot>
    <tbody>
<?php foreach ($bestelbon as $bestellijn) { ?>
            <tr>
                <td>
    <?php echo $bestellijn->getHoeveelheid() . "x"; ?>
                </td>
                <td>
    <?php echo $bestellijn->getProduct()->getProductNaam(); ?>
                </td>
                <td>
    <?php echo number_format($bestellijn->getProduct()->getProductPrijs(), 2); ?>
                </td>
                <td>
    <?php echo "€ " . number_format($bestellijn->getProduct()->getProductPrijs() * $bestellijn->getHoeveelheid(), 2); ?>
                </td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>

