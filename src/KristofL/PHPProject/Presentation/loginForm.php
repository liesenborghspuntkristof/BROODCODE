<?php
//src/KristofL/PHPProject/Presentation/loginForm.php

namespace KristofL\PHPProject\Presentation;
?>


<form id="nieuw" method="post" action="login.php?action=new">
    <input type="email" placeholder="emailadres" required="" name="emailadres">
    <input type="text" placeholder="voornaam" name="voornaam" required="">
    <input type="text" placeholder="familienaam" name="familienaam" required="">
    <input type="text" placeholder="straatnaam + huisnummer" name="adres" required="">
    <select name="woonplaats">
        <option name="postID">naam overeenstemmend met postId</option>
    </select>
    <input type="submit" value="registreren">
</form>
