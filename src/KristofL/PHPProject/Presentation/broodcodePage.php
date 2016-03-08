<?php
//src/KristofL/PHPProject/Presentation/broodcode.php

namespace KristofL\PHPProject\Presentation; 

?>

<center>
    <img src='http://barcode.tec-it.com/barcode.ashx?data=<?php echo $bestelling->getBestellingId() . date(("Ymd"), strtotime($bestelling->getAfhaaldatum())); ?>&code=Code128&dpi=96' alt='Barcode Generator TEC-IT'/>
</center>