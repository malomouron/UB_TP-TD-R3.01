<?php
declare(strict_types=1);
require_once 'HTMLForm.php';
require_once 'HTMLInput.php';

// Initialize the form
$form = new HTMLForm("result.php");
$form->add(new HTMLInput("nom", "text", "", "Nom"));
$form->add(new HTMLInput("prenom", "text", "", "Prénom"));
$form->add(new HTMLInput("submit", "submit", "Envoyer", "Envoyer"));

// Hydrate the form with $_POST data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $form->hydrate($_POST);
}

// Output the form results
echo $form->__toStringResultat();
?>