<?php 
//src/KristofL/PHPProject/Presentation/mijnGegevensPage.php

namespace KristofL\PHPProject\Presentation; 
?>

<table class="mijnAccount">
    <thead>
        <tr>
            <th colspan="2">mijn Gegevens</th>
        </tr>
    </thead> 
    <tfoot>
        <tr>
            <td colspan="2"><a href="mijnaccount.php?action=gegevens">bewerken</a></td>
        </tr>
    </tfoot>
    <tbody>
        <tr>
            <td>Voornaam: </td>
            <td><?php echo $klant->getVoornaam(); ?></td>
        </tr>
        <tr>
            <td>Familienaam: </td>
            <td><?php echo $klant->getFamilienaam(); ?></td>
        </tr>
        <tr>
            <td>Straatnaam + huisnummer: </td>
            <td><?php echo $klant->getAdres(); ?></td>
        </tr>
        <tr>
            <td>Woonplaats [zipcode]: </td>
            <td><?php echo $klant->getWoonplaats()->getNaam() . " [" . $klant->getWoonplaats()->getZipcode() . "]"; ?></td>
        </tr>
    </tbody>
</table>
</div>

