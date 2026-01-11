<?php 
require_once '../config/database.php';
require_once '../includes/header.php';
?>

<main>
    <section class="featured-entries">
        <div class="container">
            <h2 class="section-title">ENTRADAS DISPONIBLES</h2>
            <div class="news-grid">

                <?php
                $stmt = $pdo->query("
                    SELECT ed.id, ed.cantidad_disponible, gp.nombre AS gran_premio, te.nombre AS tipo_entrada, te.precio
                    FROM entradas_disponibles ed
                    JOIN tipos_entradas te ON ed.tipo_entrada_id = te.id
                    JOIN grandes_premios gp ON ed.gran_premio_id = gp.id
                    WHERE ed.activa = 1 AND ed.cantidad_disponible > 0
                    ORDER BY gp.fecha ASC, te.nombre ASC
                    LIMIT 12
                ");
                $entradas = $stmt->fetchAll();
                if (!$entradas) {
                    echo "<p>No hay entradas disponibles actualmente.</p>";
                }

                foreach ($entradas as $entrada):
                ?>
                <article class="news-card">
                    <div class="news-card-content">
                        <h3><?= htmlspecialchars($entrada['tipo_entrada']) ?></h3>
                        <p><strong>Gran Premio:</strong> <?= htmlspecialchars($entrada['gran_premio']) ?></p>
                        <p><strong>Precio:</strong> €<?= number_format($entrada['precio'],2) ?></p>
                        <p><strong>Disponibles:</strong> <?= $entrada['cantidad_disponible'] ?></p>
                        <button class="btn btn-primary" onclick="abrirModal(<?= $entrada['id'] ?>)">Comprar</button>
                    </div>
                </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
</main>

<!-- Modal Compra -->
<div class="modal" id="modalCompra" style="display:none;">
    <div class="modal-content" style="background-color:#1a1a1a; color:#fff;">
        <span class="close" onclick="cerrarModal()" style="cursor:pointer; float:right; font-size:20px;">&times;</span>
        <h3>Comprar Entrada</h3>
        <form id="formCompra" method="POST" action="../api/comprar_entrada.php">
            <input type="hidden" name="entrada_id" id="entrada_id_modal">

            <label for="nombre">Nombre completo</label>
            <input type="text" name="nombre" id="nombre" required>

            <label for="email">Correo electrónico</label>
            <input type="email" name="email" id="email" required>

            <label for="cantidad">Cantidad</label>
            <input type="number" name="cantidad" id="cantidad" min="1" value="1" required>

            <button type="submit" class="btn btn-primary">Confirmar Compra</button>
        </form>
        <div id="mensajeCompra" style="margin-top:10px;"></div>
    </div>
</div>

<script>
function abrirModal(entradaId) {
    document.getElementById('entrada_id_modal').value = entradaId;
    document.getElementById('modalCompra').style.display = 'flex';
}

function cerrarModal() {
    document.getElementById('modalCompra').style.display = 'none';
    document.getElementById('formCompra').reset();
    document.getElementById('mensajeCompra').innerHTML = '';
}

// Opcional: enviar el formulario vía AJAX para no recargar
document.getElementById('formCompra').addEventListener('submit', function(e){
    e.preventDefault();
    let formData = new FormData(this);
    fetch('../api/comprar_entrada.php', {
        method: 'POST',
        body: formData
    })
    .then(res => res.text())
    .then(data => {
        document.getElementById('mensajeCompra').innerHTML = data;
        this.reset();
    })
    .catch(err => console.error(err));
});
</script>

<style>
/* Grid 4 cards por fila */
.news-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 20px;
}

/* Modal estilos */
.modal {
    position: fixed;
    top: 0;
    left: 0;
    right:0;
    bottom:0;
    background: rgba(0,0,0,0.7);
    display:flex;
    align-items:center;
    justify-content:center;
    z-index:1000;
}

.modal-content {
    padding:20px;
    border-radius:8px;
    width: 100%;
    max-width: 500px;
}
.modal-content input {
    width:100%;
    margin-bottom:10px;
    padding:8px;
    border-radius:4px;
    border:none;
}
.modal-content button {
    width:100%;
}
</style>

<?php require_once '../includes/footer.php'; ?>
