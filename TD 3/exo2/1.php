<?php
session_start();

if (isset($_SESSION['reload_count'])) {
    $_SESSION['reload_count']++;
} else {
    $_SESSION['reload_count'] = 1;
}

echo "Page reloaded " . $_SESSION['reload_count'] . " times.";

?>
