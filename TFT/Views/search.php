<?php
$this->layout('template', ['title' => 'TP TFT -- Search']);
?>
<h1>Search</h1>
<form method="post" action="index.php?action=search">
    <label for="name">Name</label>
    <input type="text" id="name" name="name" required>
    <input type="hidden" name="origin">
    <button type="submit">Search</button>
</form>
<br>
<form method="post" action="index.php?action=search">
    <label for="origin">Origin</label>
    <input type="text" id="origin" name="origin" required>
    <input type="hidden" name="name">
    <button type="submit">Search</button>
</form>


<?php
if (isset($results)) {
    echo '<h2>Results</h2>
    <div id="contenair_card">';
    foreach ($results as $unit) {
        $this->insert('unit', ['unit' => $unit]);
    }
    if (empty($results)) {
        echo '<p>No results</p>';
    }
    echo '</div>';
}

if (isset($message)){
    $this->insert('message', ['message' => $message]);
}
