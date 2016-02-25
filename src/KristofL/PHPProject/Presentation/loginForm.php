<?php
//src/KristofL/PHPProject/Presentation/loginForm.php

namespace KristofL\PHPProject\Presentation;
?>
<img id="vitrine" src="src/KristofL/PHPProject/Presentation/img/vitrine.jpg"/>
<form id="nieuw" method="post" action="login.php?action=new">
    <h1 class="redpetrol">Maak een account aan</h1>
    <input type="email" placeholder="emailadres" required="" name="emailadres" <?php if(isset($_GET["Regmsg"])){ echo "value='" . $emailadres . "'"; } ?>/>
    <input type="text" placeholder="voornaam" name="voornaam" required="" <?php if(isset($_GET["Regmsg"])){ echo "value='" . $voornaam . "'"; } ?>>
    <input type="text" placeholder="familienaam" name="familienaam" required="" <?php if(isset($_GET["Regmsg"])){ echo "value='" . $familienaam . "'"; } ?>>
    <input type="text" placeholder="straatnaam + huisnummer" name="adres" required="" <?php if(isset($_GET["Regmsg"])){ echo "value='" . $adres . "'"; } ?>>
    <select name="postId">
        <option>woonplaats [zipcode]</option>
        <?php
        foreach ($woonplaatslijst as $woonplaats) {
            ?>
        <option value="<?php echo $woonplaats->getPostId(); ?>" <?php if(isset($_GET["Regmsg"])){ if($woonplaats->getPostId() == $postId){echo "selected=''";} } ?> ><?php echo $woonplaats->getNaam() . " [zipcode: " . $woonplaats->getZipcode() . "]"; ?></option>
        <?php
        }
        ?>
    </select>
    <input type="submit" value="registreren">
</form>

<div id="Regmsg">
    <?php echo $Regmsg; ?>
</div>
