<?php
$this->layout('template', ['title' => 'TP TFT']);
?>
<h1>TFT - Set <?= $this->e($tftSetName) ?></h1>
<h2>Résultat de getAll():</h2>
<span>
<?php
foreach ($resGetAll as $unit) {
    echo "ID: " . $unit->getId() . " - Name: " . $unit->getName() . " - Cost: " . $unit->getCost() . "<br>";
}
?>
</span>
<h2>Résultat de getByID(idQuiExiste):</h2>
<span>
<?php
if ($resGetByID) {
    echo "ID: " . $resGetByID->getId() . " - Name: " . $resGetByID->getName() . " - Cost: " . $resGetByID->getCost() . "<br>";
} else {
    echo "Unité avec ID 'idQuiExiste' non trouvée.<br>";
}
?>
</span>
<h2>Résultat de getByID(idQuiNexistePas):</h2>
<span>
<?php
if ($reGetByIdDontExist) {
    echo "ID: " . $reGetByIdDontExist->getId() . " - Name: " . $reGetByIdDontExist->getName() . " - Cost: " . $reGetByIdDontExist->getCost() . "<br>";
} else {
    echo "Unité avec ID 'idQuiNexistePas' non trouvée.<br>";
}
?>
</span>
