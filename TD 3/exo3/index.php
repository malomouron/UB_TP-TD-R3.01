<?php
session_start();

if (!isset($_SESSION['secret_number'])) {
    $_SESSION['secret_number'] = rand(1, 100);
    $_SESSION['history'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $guess = (int)$_POST['guess'];
    $_SESSION['history'][] = $guess;

    if ($guess === $_SESSION['secret_number']) {
        echo "Congratulations! You've guessed the number.";
        session_unset();
    } elseif ($guess < $_SESSION['secret_number']) {
        echo "Too low!";
    } else {
        echo "Too high!";
    }
}

?>

<form method="post">
    <input type="number" name="guess" required>
    <button type="submit">Guess</button>
</form>

<h2>History:</h2>
<ul>
    <?php
    if (isset($_SESSION['history'])) {
        foreach ($_SESSION['history'] as $attempt) {
            echo "<li>$attempt</li>";
        }
    }
    ?>
</ul>