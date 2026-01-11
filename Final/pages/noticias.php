<?php 
require_once '../includes/header.php'; 
require_once '../config/database.php';
?>

<main>
    <section class="featured-news">
        <div class="container">
            <h2 class="section-title">NOTICIAS F1</h2>
            <div class="news-grid">
                <?php
                $stmt = $pdo->query("SELECT * FROM noticias ORDER BY fecha_publicacion DESC LIMIT 9");
                while($noticia = $stmt->fetch()):
                    $img_noticia = file_exists("../assets/img/noticia_{$noticia['id']}.jpg") 
                        ? "../assets/img/noticia_{$noticia['id']}.jpg" 
                        : "../assets/img/default-news.jpg";
                ?>
                <article class="news-card">
                    <img src="<?= $img_noticia ?>" alt="<?= htmlspecialchars($noticia['titulo']) ?>">
                    <div class="news-card-content">
                        <span class="news-category"><?= htmlspecialchars($noticia['categoria']) ?></span>
                        <h3><?= htmlspecialchars($noticia['titulo']) ?></h3>
                        <p><?= htmlspecialchars($noticia['resumen']) ?></p>
                        <a href="noticia_detalle.php?id=<?= $noticia['id'] ?>" class="news-link">Leer más →</a>
                    </div>
                </article>
                <?php endwhile; ?>
            </div>
        </div>
    </section>
</main>

<?php require_once '../includes/footer.php'; ?>
