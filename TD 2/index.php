<?php
declare(strict_types=1);

require_once 'Personnage.php';
require_once 'PersonnagesManager.php';

try {

    $db = new PDO('mysql:host=localhost;dbname=grp-594_s3_progweb;charset=utf8', 'grp-594', 'JqZPsXsr');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    $manager = new PersonnagesManager($db);


    $newPersonnage = new Personnage('John Doe', 50, 0);


    $manager->add($newPersonnage);
    $retrievedPersonnage = $manager->get('John Doe');

    if ($retrievedPersonnage !== null) {
        echo 'Personnage : ' . $retrievedPersonnage->getNom() . '<br>';
        echo 'Force : ' . $retrievedPersonnage->getForcePerso() . '<br>';
        echo 'Degats : ' . $retrievedPersonnage->getDegats() . '<br>';
    } else {
        echo 'Personnage not found 404444444 error.';
    }
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
    //affiche la ligne de l'erreur
    echo '<br> Ligne : ' . $e->getLine();
    //affiche le fichier de l'erreur
    echo '<br> Fichier : ' . $e->getFile();
    //affiche le code de l'erreur
    echo '<br> Code : ' . $e->getCode();
}
?>