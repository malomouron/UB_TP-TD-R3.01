<?php

session_start();

if (!isset($_SESSION['input_value'])) {
    $_SESSION['input_value'] = '';
    $_SESSION['is_result'] = false;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['C'])) {
        $_SESSION['input_value'] = '';
    } elseif (isset($_POST['CE'])) {
        $_SESSION['input_value'] = substr($_SESSION['input_value'], 0, -1);
    } elseif (isset($_POST['btn'])) {
        $_SESSION['input_value'] .= $_POST['btn'];
    } elseif (isset($_POST['btnAdd'])) {
        $_SESSION['input_value'] .= $_POST['btnAdd'].'h(';
    } elseif (isset($_POST['sqrt'])) {
        $_SESSION['input_value'] .= 'sqrt(';
    } elseif (isset($_POST['abs'])) {
        $_SESSION['input_value'] .= 'abs(';
    } elseif (isset($_POST['exp'])) {
        $_SESSION['input_value'] .= 'exp(';
    }
    else
    if (isset($_POST['='])) {
        try {
            $result = eval('return ' . $_SESSION['input_value'] . ';');
        }
        catch (ParseError $e) {
            $result = 'Syntax Error';
        } finally {
            $_SESSION['input_value'] = $result;
            $_SESSION['is_result'] = true;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Exercice 2</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <form action="" method="post" name="calc" class="calculator">
        <input type="text" class="value" value="
        <?php
        echo $_SESSION["input_value"];
        if ($_SESSION["is_result"]) {
            $_SESSION["input_value"] = "";
            $_SESSION["is_result"] = false;
        }
        ?>
" readonly name="txt" />
        <span class="num clear"><i><input class="reset_input_submit" value="C" name="C" type="submit"></i></span>
        <span class="num"><i><input class="reset_input_submit" value="/" name="btn" type="submit"></i></span>
        <span class="num"><i><input class="reset_input_submit" value="*" name="btn" type="submit"></i></span>
        <span class="num"><i><input class="reset_input_submit" value="7" name="btn" type="submit"></i></span>
        <span class="num"><i><input class="reset_input_submit" value="8" name="btn" type="submit"></i></span>
        <span class="num"><i><input class="reset_input_submit" value="9" name="btn" type="submit"></i></span>
        <span class="num"><i><input class="reset_input_submit" value="-" name="btn" type="submit"></i></span>
        <span class="num"><i><input class="reset_input_submit" value="4" name="btn" type="submit"></i></span>
        <span class="num"><i><input class="reset_input_submit" value="5" name="btn" type="submit"></i></span>
        <span class="num"><i><input class="reset_input_submit" value="6" name="btn" type="submit"></i></span>
        <span class="num plus"><i><input class="reset_input_submit" value="+" name="btn" type="submit"></i></span>
        <span class="num"><i><input class="reset_input_submit" value="1" name="btn" type="submit"></i></span>
        <span class="num"><i><input class="reset_input_submit" value="2" name="btn" type="submit"></i></span>
        <span class="num"><i><input class="reset_input_submit" value="3" name="btn" type="submit"></i></span>
        <span class="num"><i><input class="reset_input_submit" value="0" name="btn" type="submit"></i></span>
        <span class="num"><i><input class="reset_input_submit" value="(" name="btn" type="submit"></i></span>
        <span class="num"><i><input class="reset_input_submit" value=")" name="btn" type="submit"></i></span>
        <span class="num"><i><input class="reset_input_submit" value="√" name="sqrt" type="submit"></i></span>
        <span class="num"><i><input class="reset_input_submit" value="abs" name="abs" type="submit"></i></span>
        <span class="num"><i><input class="reset_input_submit" value="ⅇ" name="exp" type="submit"></i></span>
        <span class="num"><i><input class="reset_input_submit" value="sin" name="btnAdd" type="submit"></i></span>
        <span class="num"><i><input class="reset_input_submit" value="cos" name="btnAdd" type="submit"></i></span>
        <span class="num"><i><input class="reset_input_submit" value="tan" name="btnAdd" type="submit"></i></span>
        <span class="num"><i><input class="reset_input_submit" value="CE" name="CE" type="submit"></i></span>
        <span class="num"><i><input class="reset_input_submit" value="." name="btn" type="submit"></i></span>
        <span class="num equal"><i><input class="reset_input_submit" value="=" name="=" type="submit"></i></span>
    </form>
</div>
</body>
</html>


