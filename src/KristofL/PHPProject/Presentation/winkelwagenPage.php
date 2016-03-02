<?php

//src/KristofL/PHPProject/Presentation/winkelwagenPage.php

namespace KristofL\PHPProject\Presentation;
?>
<table class="mijnAccount">
    <thead>
        <tr>
            <th>Winkelwagen</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Afhaling, vandaag [<?php date("d-m-Y"); ?>]</td>
            <td><?php echo $msgToday; ?></td>
        </tr>
        <tr>
            <td <?php if ($winkelwagen->getBestellingMorgen()->getBestellingId() !== 0) {echo 'rowspan="2"';} ?>>
                Bestelling voor morgen [<?php date("d-m-Y"); ?>]
            </td>
            <td><?php echo $msgTomorrow; ?></td>
            <?php if ($winkelwagen->getBestellingMorgen()->getBestellingId() !== 0) {echo 'rowspan="2"';} ?>>
        </tr>     
    </tbody>
</table>
<?php

// put your code here
?>

