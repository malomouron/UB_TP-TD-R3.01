<?php
echo '
<div class="popup-overlay">
    <div style="border-color: '.$message->getColor().';color: '.$message->getColor().';" class="popup-message">
        <h2 class="h2-message" style="color: '.$message->getColor().';">'.$message->getTitle().'</h2>
        Message: ' . $message->getMessage() . '
    </div>
</div>';
