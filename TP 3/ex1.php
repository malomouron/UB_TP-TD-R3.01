<form method="post" action="ex1.php">
    <p>Choisir un bouton :</p>
    <input name="btn" type="submit" value="Btn1">
    <input name="btn" type="submit" value="Btn2">
    <input name="btn" type="submit" value="Btn3">
</form>
<?php

if (isset($_POST['btn'])) {
    echo "Le bouton ".$_POST['btn']." a été cliqué";
}else{
    echo "Aucun bouton n'a été cliqué";
}

?>

