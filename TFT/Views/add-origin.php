<?php
$this->layout('template', ['title' => 'TP TFT -- Add origin']);
?>
<h1>Add Origin</h1>
<form method="post">
    <label for="name">Name</label>
    <input type="text" id="name" name="name" required>
    <button type="submit">Add</button>
</form>