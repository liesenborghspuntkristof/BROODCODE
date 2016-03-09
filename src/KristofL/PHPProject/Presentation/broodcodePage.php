<?php
//src/KristofL/PHPProject/Presentation/broodcode.php

namespace KristofL\PHPProject\Presentation; 

?>

<center style="margin-top: 8em;">
    <p>Hou deze code voor de scanner aan onze broodlift en volg de betaalinstructies op het scherm</p>
    <img src='http://barcode.tec-it.com/barcode.ashx?data=<?php echo $bestelling->getBestellingId() . date(("Ymd"), strtotime($bestelling->getAfhaaldatum())); ?>&code=Code128&dpi=96' alt='Barcode Generator TEC-IT'/>
</center>