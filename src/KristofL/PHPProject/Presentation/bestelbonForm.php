<?php 
//src/KristofL/PHPProject/Presentation/bestelbonForm.php

namespace KristofL\PHPProject\Presentation; 

?>

<div>
    <a class="button" href="winkelen.php?button=annuleren">Annuleren bestelling</a>
    <a class="button" href="winkelen.php?button=wijzigen">Wijzig bestelling</a>
    <form action="winkelen.php?button=bevestigen" method="post">
        <input type="text" name="referentie" placeholder="Geef deze bestelling een referentie om ze in de toekomst gemakkelijk te herbestellen">
        <input type="submit" value="bevestig bestelling">
    </form>
</div>
