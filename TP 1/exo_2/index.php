<?php
declare(strict_types=1);
require_once 'HTMLPage.php';
require_once 'HTMLHead.php';
require_once 'HTMLBody.php';
require_once 'HTMLP.php';
require_once 'HTMLForm.php';
require_once 'HTMLInput.php';
require_once 'HTMLDiv.php';
require_once 'HTMLImg.php';
require_once 'HTMLString.php';

// Initialize the form
$form = new HTMLForm("result.php");
$form->add(new HTMLInput("nom", "text", "", "Nom"));
$form->add(new HTMLInput("prenom", "text", "", "Prénom"));
$form->add(new HTMLInput("submit", "submit", "Envoyer", "Envoyer"));
$form->setCSS([
    'border' => '1px solid #ccc',
    'padding' => '10px',
    'margin' => '10px 0'
]);

// Initialize the body
$body = new HTMLBody();
$paragraph = new HTMLP("This is a paragraph.");
$paragraph->setCSS([
    'color' => 'blue',
    'font-size' => '14px'
]);
$body->add($paragraph);

$body->add($form);

$div = new HTMLDiv();
$div->setCSS([
    'background-color' => '#f0f0f0',
    'padding' => '10px'
]);
$body->add($div);

$image = new HTMLImg("https://www.grapheine.com/wp-content/uploads/2015/09/nouveau-logo-google-2015.jpg", "An image");
$image->setCSS([
    'width' => '100px',
    'height' => 'auto'
]);
$body->add($image);

$htmlString = new HTMLString("<strong>Bold text</strong>");
$htmlString->setCSS([
    'color' => 'red'
]);
$body->add($htmlString);

// Initialize the head
$head = new HTMLHead("My Page");

// Initialize the page
$page = new HTMLPage($head, $body);

// Output the page
echo $page;
?>