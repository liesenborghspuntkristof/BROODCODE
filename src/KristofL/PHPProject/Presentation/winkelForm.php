<?php
//src/KristofL/PHPProject/Presentation/winkelForm.php

namespace KristofL\PHPProject\Presentation;
?>


<form action="winkelen.php?action=bestelling" method="post">
    <div class="centerBox">
        <?php foreach ($productLijst as $product) { ?>
            <div class="boxRij">
                <span class="product" title="<?php echo $product->getProductOmschrijving(); ?>"><?php echo $product->getProductNaam(); ?></span>
                <span class="prijs"><?php echo number_format($product->getProductPrijs(), 2) . " euro/st"; ?></span>
                <select class="hoeveelheid" name="hoeveelheid">
                    <?php for ($t = 0; $t < 20; $t++) { ?>
                        <option value="<?php echo $t; ?>"><?php echo $t; ?></option>
                    <?php } ?>
                </select>
            </div>
            <?php
        }
        ?>
        <input type="submit" value="Plaats bestelling">
    </div>
</form>