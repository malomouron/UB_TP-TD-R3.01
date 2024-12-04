<?php
$this->layout('template', ['title' => 'TP TFT']);
?>
<h1>TFT - Set <?= $this->e($tftSetName) ?></h1>

<div id="contenair_card">
    <?php
    if ($resGetAll) {
        foreach ($resGetAll as $unit) {
            $this->insert('unit', ['unit' => $unit]);
        }
    }
    ?>
</div>
<?php if (isset($message)): ?>
    <?php $this->insert('message', ['message' => $message]); ?>
<?php endif; ?>
<script src="public/js/home.js"></script>
