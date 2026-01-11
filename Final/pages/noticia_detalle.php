<?php 
require_once '../includes/header.php';
require_once '../config/database.php';

if(!isset($_GET['id']) || empty($_GET['id'])){
    echo "<p>Noticia no encontrada.</p>";
    require_once '../includes/footer.php';
    exit;
}

$id = intval($_GET['id']);

$stmt = $pdo->prepare("SELECT * FROM noticias WHERE id = ?");
$stmt->execute([$id]);
$noticia = $stmt->fetch();

if(!$noticia){
    echo "<p>Noticia no encontrada.</p>";
    require_once '../includes/footer.php';
    exit;
}
?>

<main>
    <section class="news-detail">
        <div class="container">
            <h2><?= htmlspecialchars($noticia['titulo']) ?></h2>
            <span class="news-category"><?= htmlspecialchars($noticia['categoria']) ?></span>
            <p class="news-content"><?= nl2br(htmlspecialchars($noticia['contenido'])) ?></p>
            <?php if($noticia['imagen_url']): ?>
                <img src="<?= $noticia['imagen_url'] ?>" alt="<?= htmlspecialchars($noticia['titulo']) ?>" style="max-width:100%; margin-top:1rem;">
            <?php endif; ?>
        </div>
    </section>
</main>

<?php require_once '../includes/footer.php'; ?>
