<?php 
//src/KristofL/PHPProject/Presentation/bestelbonForm.php

namespace KristofL\PHPProject\Presentation; 

?>

<div>
    <a class="button" href="winkelen.php?action=annuleer&date=<?php echo filter_input(INPUT_GET, "date", FILTER_SANITIZE_FULL_SPECIAL_CHARS); ?>">Annuleren bestelling</a>
    <a class="button" href="winkelen.php?action=wijzig&date=<?php echo filter_input(INPUT_GET, "date", FILTER_SANITIZE_FULL_SPECIAL_CHARS); ?>">Wijzig bestelling</a>
    <form action="winkelen.php?action=bevestig&button=bevestig&date=<?php echo filter_input(INPUT_GET, "date", FILTER_SANITIZE_FULL_SPECIAL_CHARS); ?>" method="post">
        <input type="text" name="referentie" placeholder="Geef deze bestelling een referentie om ze in de toekomst gemakkelijk te herbestellen">
        <input type="submit" value="bevestig bestelling">
    </form>
</div>
