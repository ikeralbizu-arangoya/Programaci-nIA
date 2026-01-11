<?php
// Detectar la ruta de assets según si estamos en /pages/ o en raíz
$base_path = (strpos($_SERVER['PHP_SELF'], '/pages/') !== false) ? '../' : '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>F1 Project 2026</title>
    <link rel="stylesheet" href="<?= $base_path ?>assets/css/style.css">
</head>
<body>
    <header class="main-header">
        <div class="container header-content">
            <a href="<?= $base_path ?>index.php" class="logo">F<span>1</span></a>
            <nav class="main-nav">
                <ul>
                    <li><a href="<?= $base_path ?>index.php">Inicio</a></li>
                    <li><a href="<?= $base_path ?>pages/resultados.php">Resultados</a></li>
                    <li><a href="<?= $base_path ?>pages/merchandising.php">Merchandising</a></li>
                    <li><a href="<?= $base_path ?>pages/entradas.php">Entradas</a></li>
                    <li><a href="<?= $base_path ?>pages/noticias.php">Noticias</a></li>
                </ul>
            </nav>
        </div>
    </header>
