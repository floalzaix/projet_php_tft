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
            <!-- Menu -->
            <nav>
                <ul>
                    <li><a href="index.php">home</a></li>
                    <li><a href="index.php?action=add-unit">ajout unités</a></li>
                    <li><a href="index.php?action=add-unit-origin">ajout origines</a></li>
                    <li><a href="index.php?action=search">rechercher</a></li>
                </ul>
            </nav>
        </header>
        <!-- #contenu -->
        <main id="contenu">
            <?= $this->section('content') ?>
        </main>
        <footer>

        </footer>
    </body>
</html>
