<?php
$this->layout('template', ['title' => 'TP TFT -- Add origin']);
?>
<h1>Add Origin</h1>
<form method="post" action="index.php?action=add-origin">
    <label for="name">Name</label>
    <input type="text" id="name" name="name" required>
    <label for="urlImg">URL Image</label>
    <input type="text" id="urlImg" name="urlImg" required>
    <button type="submit">Add</button>
</form>
<?php if (isset($message)): ?>
    <?php $this->insert('message', ['message' => $message]); ?>
<?php endif; ?>
<script src="public/js/home.js"></script>