<?php
$this->layout('template', ['title' => 'TP TFT']);
?>
<h1>TFT - Set <?= $this->e($tftSetName) ?></h1>

<div id="contenair_card">
    <?php
    if ($resGetAll) {
        foreach ($resGetAll as $unit) {
            echo '
        <div class="card">
            <div class="card-header">
                <button class="edit-btn"><a href="index.php?action=edit-unit&id='.$unit->getId().'">✏️</a></button>
                <button class="delete-btn"><a href="index.php?action=del-unit&id='.$unit->getId().'">🗑️</a></button>
            </div>
            <img src="'.$unit->getUrlImg().'" alt="'.$unit->getName().'" class="card-image">
            <div class="card-body">
                <div class="abilities">
                    <p>🗡️'.$unit->getOrigin().'</p>
                    <p>🗡️'.$unit->getOrigin().'</p>
                    <p>🗡️'.$unit->getOrigin().'</p>
                </div>
                <div class="card-footer">
                    <h4>'.$unit->getName().'</h4>
                    <span class="cost">'.$unit->getCost().'</span>
                </div>
            </div>
        </div>';
        }
    }
    ?>
</div>
<?php
if (isset($message)) {
    echo '
    <div class="popup-overlay">
        <div class="popup-message">Message: ' . $message . '</div>
    </div>';
}
?>
<script src="public/js/home.js"></script>
