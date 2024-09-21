<?php


if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['select']) && isset($_POST['radio']) && isset($_POST['hidden'])){
    echo "Bonjour ".$_POST['nom']." ".$_POST['prenom'];
    echo "<br>";
    echo "Vous avez choisi la formation ".$_POST['select'];
    echo "<br>";
    echo "Vous avez choisi le sexe ".$_POST['radio'];
    echo "<br>";
    echo "Vous avez choisi le niveau ".$_POST['hidden'];
    echo "<br>";
}
else{
    echo "Erreur";
    if (!isset($_POST['nom'])) {
        echo "nom";
    }
    if (!isset($_POST['prenom'])) {
        echo "prenom";
    }
    if (!isset($_POST['select'])) {
        echo "select";
    }
    if (!isset($_POST['radio'])) {
        echo "radio";
    }
    if (!isset($_POST['hidden'])) {
        echo "hidden";
    }
}


?>