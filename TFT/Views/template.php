<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8"/>
    <link rel="stylesheet" href="public/css/main.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $this->e($title) ?></title>
</head>
<body>
<header>
    <nav>
        <ul>
            <li><a href="index.php?action=add-unit">Add Unit</a></li>
            <li><a href="index.php?action=add-unit-origin">Add Unit Origin</a></li>
            <li><a href="index.php?action=search">Search</a></li>
            <li><a href="index.php">Home</a></li>
        </ul>
    </nav>
</header>
<main id="contenu">
    <?=$this->section('content')?>

</main>
<footer>
</footer>
</body>
</html>