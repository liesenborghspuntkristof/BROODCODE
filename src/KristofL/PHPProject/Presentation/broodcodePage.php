<?php
//src/KristofL/PHPProject/Presentation/broodcode.php

namespace KristofL\PHPProject\Presentation; 

?>

<center>
    <img src='http://barcode.tec-it.com/barcode.ashx?data=<?php echo $bestelbon[0]->getBestelling()->getBestellingId() . date(("Ymd"), strtotime($bestelbon[0]->getBestelling()->getAfhaaldatum())); ?>&code=Code128&dpi=96' alt='Barcode Generator TEC-IT'/>
</center>