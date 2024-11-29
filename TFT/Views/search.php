<?php
$this->layout('template', ['title' => 'TP TFT -- Search']);
?>
<h1>Search</h1>
<form method="post">
    <label for="name">Name</label>
    <input type="text" id="name" name="name" required>
    <button type="submit">Search</button>
</form>