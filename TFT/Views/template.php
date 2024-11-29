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
        <div class="menu">
            <img src="public/img/logo.png" alt="logo" class="logo">
            <span class="menu-item"><a href="index.php?action=add-unit">Add Unit</a></span>
            <span class="menu-item"><a href="index.php?action=add-origin">Add Unit Origin</a></span>
            <span class="menu-item"><a href="index.php?action=search">Search</a></span>
            <span class="menu-item"><a href="index.php">Home</a></span>
        </div>
    </nav>
</header>
<main id="contenu">
    <?=$this->section('content')?>
</main>
<footer>
</footer>
</body>
</html>