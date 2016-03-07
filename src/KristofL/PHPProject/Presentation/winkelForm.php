<?php
//src/KristofL/PHPProject/Presentation/winkelForm.php

namespace KristofL\PHPProject\Presentation;
?>


<div class="centerBox">
    <form action="winkelen.php?action=herbestelling" method="post">
        <div class="boxRij">
            <span class="vet">Herbestelling</span>
        </div>
        <div class="boxRij">
            <span class="product">Selecteer een vorige bestelling:</span>
            <select class="hoeveelheid" name="bestellingId">
                <?php foreach ($bestellinglijst as $bestelling) { ?>
                    <option value="<?php echo $bestelling->getBestellingId(); ?>">[<?php echo $bestelling->getAfhaaldatum(); ?>] Ref.: <?php echo $bestelling->getReferentie(); ?></option>
                <?php } ?>
            </select>
            <input type="submit" value="Herbestel">
        </div>
    </form>
    <div class="boxRij">
    <span class="product">De referentie van vorige bestellingen kunnen bij <a href="mijnBestellingen.php">mijn bestellingen</a> aangepast worden</span>
    </div>
</div>


    <div class="centerBox">
        <form action="winkelen.php?action=bestelling" method="post">
        <?php foreach ($productenlijstByCategorie as $lijstNaam => $lijstValue) { ?>
            <div class="boxRij">
                <?php echo "<span class='vet'>" . $lijstNaam . "</span>"; ?>
            </div>
            <?php foreach ($lijstValue as $product) { ?>
                <div class="boxRij">
                    <span class="product" title="<?php echo $product->getProductOmschrijving(); ?>"><?php echo $product->getProductNaam(); ?></span>
                    <span class="prijs"><?php echo number_format($product->getProductPrijs(), 2) . " euro/st"; ?></span>
                    <select class="hoeveelheid" name="<?php echo $product->getProductId(); ?>">
                        <?php for ($t = 0; $t < 21; $t++) { ?>
                            <option value="<?php echo $t; ?>"><?php echo $t; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <?php
            }
            ?>
            <?php
        }
        ?>
            <div class="boxRij">
        <input type="submit" value="Plaats bestelling">
            </div>
        </form>
    </div>
