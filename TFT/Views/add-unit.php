<?php
if (isset($unit))
{
    $this->layout('template', ['title' => 'TP TFT -- Edit Unit']);
}
else
{
    $this->layout('template', ['title' => 'TP TFT -- Add Unit']);
}
?>
<?= isset($unit) ? "<h1>Modify Unit</h1>" : "<h1>Add Unit</h1>" ?>
<form action="index.php?action=<?= isset($unit) ? 'edit-unit' : 'add-unit' ?>" method="post">
    <label for="name">Name</label>
    <input type="text" value="<?= isset($unit) ? $unit['name'] : '' ?>" id="name" name="name" required>
    <label for="origin">Origin</label>
    <input type="text" value="<?= isset($unit) ? $unit['origin'] : '' ?>" id="origin" name="origin" required>
    <label for="cost">Cost</label>
    <input type="number" value="<?= isset($unit) ? $unit['cost'] : '' ?>" id="cost" name="cost" required>
    <label for="urlImg">URL Image</label>
    <input type="text" value="<?= isset($unit) ? $unit['urlimg'] : '' ?>" id="urlImg" name="urlImg" required>
    <input type="hidden" value="<?= isset($unit) ? $unit['id'] : '' ?>" id="id" name="id">
    <button type="submit"><?= isset($unit) ? "Modify" : "Add" ?></button>
</form>
<?php
if (isset($message)) {
    echo '
    <div class="popup-overlay">
        <div class="popup-message">Message: ' . $message . '</div>
    </div>';
}
?>
<script src="public/js/home.js"></script>