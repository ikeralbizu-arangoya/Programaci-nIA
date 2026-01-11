<?php 
require_once 'includes/header.php'; 
require_once 'config/database.php';
?>

<main>
    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1 class="hero-title">F1</h1>
            <p class="hero-subtitle">La máxima velocidad del automovilismo</p>
            <div class="hero-buttons">
                <a href="pages/entradas.php" class="btn btn-primary">Comprar Entradas</a>
                <a href="pages/resultados.php" class="btn btn-secondary">Resultados</a>
            </div>
        </div>
    </section>

    <!-- Noticias Destacadas -->
    <section class="featured-news">
        <div class="container">
            <h2 class="section-title">ÚLTIMAS NOTICIAS</h2>
            <div class="news-grid">
                <?php
                $stmt = $pdo->query("SELECT * FROM noticias ORDER BY fecha_publicacion DESC LIMIT 3");
                while($noticia = $stmt->fetch()):
                    $img_noticia = file_exists("assets/img/noticia_{$noticia['id']}.jpg") 
                        ? "assets/img/noticia_{$noticia['id']}.jpg" 
                        : "assets/img/default-news.jpg";
                ?>
                <article class="news-card">
                    <img src="<?= $img_noticia ?>" alt="<?= htmlspecialchars($noticia['titulo']) ?>">
                    <div class="news-card-content">
                        <span class="news-category"><?= htmlspecialchars($noticia['categoria']) ?></span>
                        <h3><?= htmlspecialchars($noticia['titulo']) ?></h3>
                        <p><?= htmlspecialchars($noticia['resumen']) ?></p>
                        <a href="pages/noticias.php?id=<?= $noticia['id'] ?>" class="news-link">Leer más →</a>
                    </div>
                </article>
                <?php endwhile; ?>
            </div>
        </div>
    </section>

    <!-- Merchandising Destacado -->
    <section class="featured-products">
        <div class="container">
            <h2 class="section-title">MERCHANDISING OFICIAL</h2>
            <div class="products-grid">
                <?php
                $stmt = $pdo->query("
                    SELECT pm.*, e.nombre as equipo_nombre, e.color_principal
                    FROM productos_merchandising pm
                    LEFT JOIN equipos e ON pm.equipo_id = e.id
                    ORDER BY pm.fecha_agregado DESC LIMIT 3
                ");
                while($p = $stmt->fetch()):
                    $img_producto = file_exists("assets/img/producto_{$p['id']}.jpg") 
                        ? "assets/img/producto_{$p['id']}.jpg" 
                        : "assets/img/default-product.jpg";
                ?>
                <div class="product-card">
                    <div class="product-badge" style="background: <?= $p['color_principal'] ?>;">
                        <?= htmlspecialchars($p['equipo_nombre']) ?>
                    </div>
                    <img src="<?= $img_producto ?>" alt="<?= htmlspecialchars($p['nombre']) ?>">
                    <div class="product-info">
                        <h3><?= htmlspecialchars($p['nombre']) ?></h3>
                        <p class="product-price">€<?= number_format($p['precio'],2) ?></p>
                        <button class="btn btn-cart" onclick="agregarCarrito(<?= $p['id'] ?>)">Añadir al carrito</button>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>
</main>

<?php require_once 'includes/footer.php'; ?>
