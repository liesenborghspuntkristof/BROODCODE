<?php
//src/KristofL/PHPProject/Presentation/mijnGegevens.php

namespace KristofL\PHPProject\Presentation;
?>

<table class="mijnAccount">
    <thead>
        <tr>
            <th>Wijzig uw gegevens</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <form action="mijnaccount.php?action=newgeg" method="post">
                    Voornaam: <input type="text" name="voornaam" placeholder="voornaam" required="" value="<?php echo $klant->getVoornaam(); ?>">
                    Voornaam: <input type="text" name="familienaam" placeholder="familienaam" required="" value="<?php echo $klant->getFamilienaam(); ?>">
                    Adres: <input type="text" name="adres" placeholder="straatnaam + huisnummer" required="" value="<?php echo $klant->getAdres(); ?>">
                    Woonplaats: <select name="postId">
                        <!--                        <option>woonplaats [zipcode]</option>-->
                        <?php
                        foreach ($woonplaatslijst as $woonplaats) {
                            ?>
                            <option value="<?php echo $woonplaats->getPostId(); ?>" 
                                    <?php if ($woonplaats->getPostId() == $klant->getWoonplaats()->getPostId()) {
                                        echo "selected=''";
                                    } ?> >
                            <?php echo $woonplaats->getNaam() . " [zipcode: " . $woonplaats->getZipcode() . "]"; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <a href="mijnaccount.php">annuleren</a><input type="submit" value="wijzig gegevens">
                </form>
            </td>
        </tr>
        <?php  if (isset($_GET["gegmsg"])) { ?>
        <tr>
            <td colspan="2" class="warning">
                <?php echo base64_decode($_GET["gegmsg"]); ?>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>
</div>