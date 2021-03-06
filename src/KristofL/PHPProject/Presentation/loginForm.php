<?php
//src/KristofL/PHPProject/Presentation/loginForm.php

namespace KristofL\PHPProject\Presentation;
?>
<div class="centerfold clearFix breadground">
    <div class="rij">
        <div class="kol-md-7">
        <img id="vitrine" class="md_on lg_on xl_on xxl_on" src="src/KristofL/PHPProject/Presentation/img/vitrine.jpg"/>
        </div>
        <div class="kol-md-5">
            <form id="nieuw" method="post" action="login.php?action=new">
                <h1 class="redpetrol">Maak een account aan</h1>
                <input type="email" placeholder="emailadres" required="" name="emailadres" <?php
                if (isset($_GET["Regmsg"])) {
                    echo "value='" . $emailadres . "'";
                }
                ?>/>
                <input type="text" placeholder="voornaam" name="voornaam" required="" <?php
                if (isset($_GET["Regmsg"])) {
                    echo "value='" . $voornaam . "'";
                }
                ?>>
                <input type="text" placeholder="familienaam" name="familienaam" required="" <?php
                       if (isset($_GET["Regmsg"])) {
                           echo "value='" . $familienaam . "'";
                       }
                       ?>>
                <input type="text" placeholder="straatnaam + huisnummer" name="adres" required="" <?php
                    if (isset($_GET["Regmsg"])) {
                        echo "value='" . $adres . "'";
                    }
                    ?>>
                <select name="postId">
                    <option>woonplaats [zipcode]</option>
                            <?php
                            foreach ($woonplaatslijst as $woonplaats) {
                                ?>
                        <option value="<?php echo $woonplaats->getPostId(); ?>" <?php
                            if (isset($_GET["Regmsg"])) {
                                if ($woonplaats->getPostId() == $postId) {
                                    echo "selected=''";
                                }
                            }
                                ?> ><?php echo $woonplaats->getNaam() . " [zipcode: " . $woonplaats->getZipcode() . "]"; ?></option>
    <?php
}
?>
                </select>
                <input type="submit" value="registreren">
            </form>

            <div id="Regmsg">
<?php echo $Regmsg; ?>
            </div>
        </div>
    </div>
</div>
