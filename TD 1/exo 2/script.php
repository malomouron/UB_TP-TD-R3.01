<?php
error_reporting(0);
if (isset($_POST['number'])) {
    $mdp = $_POST['mdp'];
    $number = intval($_POST['number']);
    if ($mdp == $number) {
        echo "Bravo vous avez trouvé le chiffre ".$number;
        echo "<br>";
        echo "Vous pouvez rejouer";
        $mdp = mt_rand(0, 100);
        $_POST['histo'] = "";
    }else{
        if ($mdp > $number) {
            echo "C'est plus que ".$number;
            $number = $number." +";
        }else{
            echo "C'est moins que ".$number;
            $number = $number." -";
        }
    }
    $listHisto = explode('$', $_POST['histo']);
    array_push($listHisto, $number);

    echo '<fieldset><legend>Historique</legend>';
    foreach ($listHisto as $value) {
        echo $value."<br>";
    }
    echo '</fieldset>';
}else {
    $mdp = mt_rand(0, 100);
}

echo
"<br><br><form action='script.php' method='post'>
    <label for='number'>Entrer un chiffre entre 0 et 100</label><br>
    <input type='number' min='0' max='100' name='number' id='number'>
    <input type='hidden' name='mdp' value='".$mdp."'>
    
    <input type='hidden' name='histo' value='".implode('$', $listHisto)."'>
    <input type='submit' value='Valider'>
</form>";

?>