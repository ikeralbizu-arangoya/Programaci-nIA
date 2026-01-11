<?php 
require_once '../includes/header.php';
require_once '../config/database.php';
?>

<main>
    <section class="shop-section">
        <div class="container">
            <h2 class="section-title">Tienda Oficial F1</h2>

            <?php
            $stmt = $pdo->query("
                SELECT pm.*, e.nombre as equipo_nombre, e.color_principal
                FROM productos_merchandising pm
                LEFT JOIN equipos e ON pm.equipo_id = e.id
                ORDER BY pm.fecha_agregado DESC
            ");
            $productos = $stmt->fetchAll();

            if($productos):
                echo '<div class="products-grid">';
                foreach($productos as $p):
                    $img_producto = file_exists("../assets/img/producto_{$p['id']}.jpg") 
                        ? "../assets/img/producto_{$p['id']}.jpg" 
                        : "../assets/img/default-product.jpg";
                ?>
                    <div class="product-card">
                        <div class="product-badge" style="background: <?= $p['color_principal'] ?>;">
                            <?= htmlspecialchars($p['equipo_nombre']) ?>
                        </div>
                        <img src="<?= $img_producto ?>" alt="<?= htmlspecialchars($p['nombre']) ?>">
                        <div class="product-info">
                            <h3><?= htmlspecialchars($p['nombre']) ?></h3>
                            <p class="product-price">€<?= number_format($p['precio'], 2) ?></p>
                            <button class="btn btn-cart" onclick="agregarCarrito(<?= $p['id'] ?>)">Añadir al carrito</button>
                        </div>
                    </div>
                <?php
                endforeach;
                echo '</div>';
            else:
                echo "<p>No hay productos disponibles.</p>";
            endif;
            ?>
        </div>
    </section>
</main>

<?php require_once '../includes/footer.php'; ?>