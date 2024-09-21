<?php
session_start();
require_once 'my_custom_autoloader.php';
spl_autoload_register('my_custom_autoloader');

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '^cGWtch*I!q7Q5**v');
    $gestionPerso = new PersonnageManager($bdd);
    if (isset($_POST['btn'])){
        if ($_POST['btn'] === 'Créer ce personnage'){
            $nom = $_POST['nom'];
            if ($nom && !ctype_digit($nom) && !empty($nom)) {
                $perso = new Personnage(["Nom" => $nom]);
                if (!$gestionPerso->exists($perso->getNom())) {
                    $gestionPerso->add($perso);
                    $_SESSION['perso'] = $perso;
                    header('Location: combat.php');
                    exit;
                } else {
                    echo 'Ce personnage existe déjà';
                    echo '<br>';
                    echo 'Veuillez choisir un autre nom';
                    echo '<br>';
                    echo '<a href="index.php">Retourner à l\'index</a>';
                }
            } else {
                echo 'Nom invalide';
                echo '<br>';
                echo '<a href="index.php">Retourner à l\'index</a>';
            }
        }
        if ($_POST['btn'] === 'Utiliser ce personnage'){
            $nom = $_POST['nom'];
            if ($nom && !is_int($nom) && !empty($nom)) {
                if ($gestionPerso->exists($nom)) {
                    $_SESSION['perso'] = $gestionPerso->get($nom);
                    $conn = $_SESSION['perso']->checkConnexion();
                    $gestionPerso->update($_SESSION['perso']);
                    switch ($conn) {
                        case Personnage::PERSONNAGE_TUE:
                            echo 'Ce personnage est mort';
                            echo '<br>';
                            echo 'Veuillez choisir un autre nom';
                            echo '<br>';
                            echo '<a href="index.php">Retourner à l\'index</a>';
                            $gestionPerso->delete($_SESSION['perso']);
                            break;
                        case Personnage::PERSONNAGE_CONNEXION_OK:
                            header('Location: combat.php?couldownday=1');
                            break;
                        case Personnage::PERSONNAGE_CONNEXION_NEW_DAY:
                            $_SESSION['perso']->setCoupsPortes(0);
                            $gestionPerso->update($_SESSION['perso']);
                            header('Location: combat.php');
                            break;
                    }

                } else {
                    echo 'Ce personnage n\'existe pas';
                    echo '<br>';
                    echo 'Veuillez choisir un autre nom';
                    echo '<br>';
                    echo '<a href="index.php">Retourner à l\'index</a>';
                }
            } else {
                echo 'Nom invalide';
                echo '<br>';
                echo '<a href="index.php">Retourner à l\'index</a>';
            }
        }
    }
}