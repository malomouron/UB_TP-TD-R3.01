<?php
session_start();

/**
 * Vérifie si l'utilisateur a demandé une déconnexion.
 * Si oui, réinitialise la session et redirige vers la page d'accueil.
 */
if (isset($_GET['deco'])) {
    $_SESSION['perso'] = null;
    header('Location: index.php');
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mini jeu de Combat</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <form method="post" action="gestion-perso.php">
        <h1>Mini jeu de Combat</h1>
        <p>Sélectionne ton personnage</p>
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required>
        <div class="button-container">
            <input type="submit" name="btn" value="Créer ce personnage" class="btn create">
            <input type="submit" name="btn" value="Utiliser ce personnage" class="btn use">
        </div>
    </form>
</div>
</body>
</html>
