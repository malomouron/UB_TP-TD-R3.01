<?php
$title = isset($unit) ? 'TP TFT -- Edit Unit' : 'TP TFT -- Add Unit';
$this->layout('template', ['title' => $title]);
?>
<?= isset($unit) ? "<h1>Modify Unit</h1>" : "<h1>Add Unit</h1>" ?>
<form action="index.php?action=<?= isset($unit) ? 'edit-unit' : 'add-unit' ?>" method="post">
    <label for="name">Name</label>
    <input type="text" value="<?= isset($unit) ? $unit['name'] : '' ?>" id="name" name="name" required>
    <label for="origin1">Origin</label>
    <select id="origin1" name="origin1" required>
        <option value="">Select the first origin</option>
        <?php foreach ($originList as $origin): ?>
            <option value="<?= $origin->getId() ?>"><?= $origin->getName() ?></option>
        <?php endforeach; ?>
    </select>
    <select id="origin2" name="origin2">
        <option value="">Select the second origin</option>
        <?php foreach ($originList as $origin): ?>
            <option value="<?= $origin->getId() ?>"><?= $origin->getName() ?></option>
        <?php endforeach; ?>
    </select>
    <select id="origin3" name="origin3">
        <option value="">Select the third origin</option>
        <?php foreach ($originList as $origin): ?>
            <option value="<?= $origin->getId() ?>"><?= $origin->getName() ?></option>
        <?php endforeach; ?>
    </select>
    <label for="cost">Cost</label>
    <input type="number" value="<?= isset($unit) ? $unit['cost'] : '' ?>" id="cost" name="cost" required>
    <label for="urlImg">URL Image</label>
    <input type="text" value="<?= isset($unit) ? $unit['urlimg'] : '' ?>" id="urlImg" name="urlImg" required>
    <input type="hidden" value="<?= isset($unit) ? $unit['id'] : '' ?>" id="id" name="id">
    <button type="submit"><?= isset($unit) ? "Modify" : "Add" ?></button>
</form>
<?php if (isset($message)): ?>
    <?php $this->insert('message', ['message' => $message]); ?>
<?php endif; ?>
<script src="public/js/home.js"></script>