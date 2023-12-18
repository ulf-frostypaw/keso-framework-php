<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keso Framework PHP</title>
    <link rel="stylesheet" href="<?= APP_PUBLIC . "css/style.css"; ?>">
</head>

<body>
    <nav class="nav">
        <div class="logo">
            <span>Keso Framework PHP</span>
        </div>
        <div class="menu">
            <ul>
                <li><a href="<?= APP_URL; ?>">Inicio</a></li>
                <li><a href="https://github.com/ulf-frostypaw/keso-framework-php" target="_blank">GitHub</a></li>
                <li><span>Versi&oacute;n: <code><?= APP_VERSION ?></code></span></li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <div class="keso">
            <h1>Merp!</h1>
            <img src="<?= APP_PUBLIC . "sergal_wedge_cheese.png"; ?>" width="400px" alt="" srcset="">
            <div class="code">Esta p&aacute;gina est&aacute; siendo renderizada en el directorio: <code>resources/views/home.view.php</code></div>
        </div>
    </div>
</body>

</html>