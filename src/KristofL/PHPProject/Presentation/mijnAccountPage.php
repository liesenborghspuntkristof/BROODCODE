<?php 
//src/KristofL/PHPProject/Presentation/mijnAccountPage.php

namespace KristofL\PHPProject\Presentation; 
?>
<table class="mijnAccount">
    <thead>
        <tr>
            <th colspan="2">mijn Account</th>
        </tr>
    </thead> 
    <tfoot>
        <tr>
            <td colspan="2"><a href="mijnaccount.php?action=wachtwoord">wachtwoord wijzigen</a></td>
        </tr>
    </tfoot>
    <tbody>
        <tr>
            <td>Login: </td>
            <td><?php echo $klant->getEmailadres(); ?></td>
        </tr>
        <tr>
            <td>Wachtwoord: </td>
            <td><?php echo $wachtwoord ?></td>
        </tr>
    </tbody>
</table>
  