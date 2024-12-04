<?php
echo '
        <div class="card">
            <div class="card-header">
                <button class="edit-btn"><a href="index.php?action=edit-unit&id='.$unit->getId().'">✏️</a></button>
                <button class="delete-btn"><a href="index.php?action=del-unit&id='.$unit->getId().'">🗑️</a></button>
            </div>
            <img src="'.$unit->getUrlImg().'" alt="'.$unit->getName().'" class="card-image">
            <div class="card-body">
                <div class="abilities">';
                if ($unit && $unit->getOrigin()) {
                    foreach ($unit->getOrigin() as $origin) {
                        echo '<p><img src="'.$origin->getUrlImg().'" alt="'.$origin->getName().'" class="img_origin">️'.$origin->getName().'</p>';
                    }
                }
        echo   '</div>
                <div class="card-footer">
                    <h4>'.$unit->getName().'</h4>
                    <span class="cost">'.$unit->getCost().'</span>
                </div>
            </div>
        </div>';