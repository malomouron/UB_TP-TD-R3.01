<?php
function countLetters($str) {
    return strlen(preg_replace('/[^a-zA-Z]/', '', $str));
}

function countVowels($str) {
    preg_match_all('/[aeiouAEIOU]/', $str, $matches);
    return count($matches[0]);
}

function countConsonants($str) {
    preg_match_all('/[bcdfghjklmnpqrstvwxyzBCDFGHJKLMNPQRSTVWXYZ]/', $str, $matches);
    return count($matches[0]);
}

function reverseWords($str) {
    $words = explode(' ', $str);
    $reversedWords = array_reverse($words);
    return implode(' ', $reversedWords);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sentence = trim($_POST['sentence']);
    $wordCount = str_word_count($sentence);
    $letterCount = countLetters($sentence);
    $vowelCount = countVowels($sentence);
    $consonantCount = countConsonants($sentence);
    $reversedSentence = reverseWords($sentence);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Analyse de la phrase</title>
</head>
<body>
<form method="post" action="">
    <label for="sentence">Entrez une phrase :</label><br>
    <input type="text" id="sentence" name="sentence" required><br><br>
    <input type="submit" value="Analyser">
</form>


    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
        <h2>Résultats de l'analyse :</h2>
        <p>Nombre de mots : <?php echo $wordCount; ?></p>
        <p>Nombre de lettres : <?php echo $letterCount; ?></p>
        <p>Nombre de voyelles : <?php echo $vowelCount; ?></p>
        <p>Nombre de consonnes : <?php echo $consonantCount; ?></p>
        <p>Phrase inversée : <?php echo $reversedSentence; ?></p>
    <?php endif; ?>
</body>
</html>