<?php
session_start();
if (isset($_GET['deco'])) {
    $_SESSION['perso'] = null;
    header('Location: index.php');
}

?>
<form method="post" action="gestion-perso.php">
    <h1>Mini jeu de Combat - Sélectionne ton personnage</h1>
    <label for="nom">Nom :</label>
    <input type="text" id="nom" name="nom" required>
    <input type="submit" name="btn" value="Créer ce personnage">
    <input type="submit" name="btn" value="Utiliser ce personnage">
</form>
