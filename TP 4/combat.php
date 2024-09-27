<?php
require_once 'my_custom_autoloader.php';
spl_autoload_register('my_custom_autoloader');
session_start();

/**
 * Vérifie si une session de personnage est active.
 */
if (isset($_SESSION['perso']))
{
    // Connexion à la base de données
    $bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '^cGWtch*I!q7Q5**v');
    $gestionPerso = new PersonnageManager($bdd);

    /**
     * Gère les actions du formulaire POST.
     */
    if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        // Vérifie si une cible a été sélectionnée
        if (isset($_POST['cible']) && !empty($_POST['cible']))
        {
            // Vérifie si la cible existe
            if ($gestionPerso->exists($_POST['cible']))
            {
                $perso = $gestionPerso->get($_POST['cible']);
                $degaprec = $perso->getDegats();
                $act = $_SESSION['perso']->frapper($perso);

                // Gère les différents cas d'action
                switch ($act)
                {
                    case Personnage::CEST_MOI:
                        $mess = 'Vous ne pouvez pas vous frapper vous-même';
                        break;
                    case Personnage::PERSONNAGE_FRAPPE:
                        $mess = 'Le personnage a bien été frappé'.'<br>'.'Degats : ' . ($perso->getDegats() - $degaprec);
                        $gestionPerso->update($perso);
                        $gestionPerso->update($_SESSION['perso']);
                        break;
                    case Personnage::PERSONNAGE_TUE:
                        $mess = 'Le personnage a bien été tué'.'<br>'.'Degats : ' . ($perso->getDegats() - $degaprec);
                        $gestionPerso->delete($perso);
                        $gestionPerso->update($_SESSION['perso']);
                        break;
                    case Personnage::COUPS_MAX:
                        $mess = 'Vous avez atteint le nombre maximum de coups portés';
                        break;
                }
            }
            else
            {
                $mess = 'Ce personnage n\'existe pas';
            }
        }
    }
}

echo '
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Combat</title>
    <link rel="stylesheet" href="style.css"> 
</head>
<body>
<div class="container">
    <fieldset>
        <legend>Mes informations</legend>
        <p>Nom : ' . $_SESSION['perso']->getNom() . '</p>
        <p>Dégâts : ' . $_SESSION['perso']->getDegats() . '</p>
        <p>Niveau : ' . $_SESSION['perso']->getNiveau() . '</p>
        <p>Expérience : ' . $_SESSION['perso']->getExperience() . '</p>
        <p>Force : ' . $_SESSION['perso']->getForce() . '</p>
        <p>Coups portés : ' . $_SESSION['perso']->getCoupsPortes()  . '</p>
        <p>Date dernier coup : ';

        /**
         * Affiche la date du dernier coup porté.
         */
        if ($_SESSION['perso']->getDateDernierCoup() === null)
        {
            echo 'Aucun coup porté';
        }
        else {
            echo $_SESSION['perso']->getDateDernierCoup()->format('Y-m-d H:i:s');
        }
        echo
        '</p>
        <p>Date dernière connexion : ' . $_SESSION['perso']->getDateDerniereConnexion()->format('Y-m-d H:i:s') . '</p>

    </fieldset>
    <form action="combat.php" method="post">
        <label for="cible">Cible :</label>
        <select name="cible" id="cible">';
            $persos = $gestionPerso->getList();
            foreach ($persos as $perso){
                if ($perso->getNom() !== $_SESSION['perso']->getNom()){
                    echo '<option value="'.$perso->getNom().'">'.$perso->getNom().'</option>';
                }
            }
            echo '
        </select>
        <input type="submit" name="btn" value="Frapper">
    </form>
    <p>';
    if (isset($mess)){
        echo $mess.'<br>';
    }
    if (isset($_GET['couldownday']))
    {
        if ($_GET['couldownday'] === '1')
        {
            $_GET['couldownday'] = '0';
            echo "Nombre de connexions maximum atteint pour aujourd'hui + 10 dégâts";
        }
    }

    echo
    '</p>
    <p>Il reste '.  $gestionPerso->count()  .' personnages</p>
    <a href="index.php?deco=1">Annuler et retourner à l\'index</a>
</div>
</body>
</html>';
?>