<?php 
//src/KristofL/PHPProject/Presentation/mijnAccountForm.php

namespace KristofL\PHPProject\Presentation; 
?>
<table class="mijnAccount">
    <thead>
        <tr>
            <th>Kies een nieuw wachtwoord</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <form action="mijnaccount.php?action=newpwd" method="post">
                    Nieuw wachtwoord: <input type="password" name="wachtwoord" placeholder="min. 8, max. 40 karakters lang / min. 1 hoofdletter / min. 1 cijfer / geen speciale tekens buiten @ . # - _" required="" autofocus="">
                    Bevestig wachtwoord: <input type="password" name="wachtwoordConf" placeholder="Bevestig je nieuw wachtwoord door het te herhalen" required="">
                    <a href="mijnaccount.php">annuleren</a><input type="submit" value="wijzig wachtwoord">
                </form>
            </td>
        </tr>
    </tbody>
</table>

   