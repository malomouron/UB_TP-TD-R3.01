<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Exercice 1</title>
</head>
<body>
    <form method="post" action="ex1.php">
        <p>Choisir un bouton :</p>
        <input name="btn" type="submit" value="Btn1">
        <input name="btn" type="submit" value="Btn2">
        <input name="btn" type="submit" value="Btn3">
    </form>
</body>
</html>
<?php

// Vérifie si un bouton a été cliqué
if (isset($_POST['btn'])) {
    // Affiche le bouton cliqué
    echo "Le bouton ".$_POST['btn']." a été cliqué";
} else {
    // Affiche un message si aucun bouton n'a été cliqué
    echo "Aucun bouton n'a été cliqué";
}

?>