<?php
//src/KristofL/PHPProject/Presentation/loginForm.php

namespace KristofL\PHPProject\Presentation;
?>
<img id="vitrine" src="src/KristofL/PHPProject/Presentation/img/vitrine.jpg"/>
<form id="nieuw" method="post" action="login.php?action=new">
    <h1 class="redpetrol">Maak een account aan</h1>
    <input type="email" placeholder="emailadres" required="" name="emailadres">
    <input type="text" placeholder="voornaam" name="voornaam" required="">
    <input type="text" placeholder="familienaam" name="familienaam" required="">
    <input type="text" placeholder="straatnaam + huisnummer" name="adres" required="">
    <select name="woonplaats">
        <?php
        foreach ($woonplaatslijst as $woonplaats) {
            ?>
        <option name="<?php echo $woonplaats->getPostId(); ?>"><?php echo $woonplaats->getNaam() . " [zipcode: " . $woonplaats->getZipcode() . "]"; ?></option>
        <?php
        }
        ?>
    </select>
    <input type="submit" value="registreren">
</form>
