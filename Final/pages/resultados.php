<?php 
require_once '../includes/header.php';
require_once '../config/database.php';
?>

<main>
    <section class="results-section">
        <div class="container">
            <h2 class="section-title">Resultados Temporada 2026</h2>

            <?php
            // Obtener temporada activa
            $stmt = $pdo->query("SELECT id, nombre FROM temporadas WHERE activa=1 LIMIT 1");
            $temporada = $stmt->fetch();

            if($temporada):
                $stmt = $pdo->prepare("
                    SELECT gp.id as gp_id, gp.nombre as gp_nombre, gp.fecha, r.posicion, r.puntos, 
                           p.nombre as piloto_nombre, p.apellido as piloto_apellido, e.nombre as equipo, e.color_principal
                    FROM resultados_carreras r
                    JOIN grandes_premios gp ON r.gran_premio_id = gp.id
                    JOIN pilotos p ON r.piloto_id = p.id
                    JOIN equipos e ON p.equipo_id = e.id
                    WHERE gp.temporada_id = ?
                    ORDER BY gp.fecha ASC, r.posicion ASC
                ");
                $stmt->execute([$temporada['id']]);
                $resultados = $stmt->fetchAll();

                if($resultados):
                    $current_gp = '';
                    foreach($resultados as $r):
                        if($current_gp != $r['gp_nombre']):
                            if($current_gp != '') echo '</tbody></table>';
                            $current_gp = $r['gp_nombre'];
            ?>
                            <h3 class="gp-title"><?= htmlspecialchars($r['gp_nombre']) ?> - <?= date('d/m/Y', strtotime($r['fecha'])) ?></h3>
                            <table class="results-table">
                                <thead>
                                    <tr>
                                        <th>Posición</th>
                                        <th>Piloto</th>
                                        <th>Equipo</th>
                                        <th>Puntos</th>
                                    </tr>
                                </thead>
                                <tbody>
            <?php
                        endif;
            ?>
                                <tr>
                                    <td><?= $r['posicion'] ?></td>
                                    <td><?= htmlspecialchars($r['piloto_nombre'] . ' ' . $r['piloto_apellido']) ?></td>
                                    <td>
                                        <span class="team-badge" style="background-color:<?= $r['color_principal'] ?>;">
                                            <?= htmlspecialchars($r['equipo']) ?>
                                        </span>
                                    </td>
                                    <td><?= $r['puntos'] ?></td>
                                </tr>
            <?php
                    endforeach;
                    echo '</tbody></table>';
                else:
                    echo "<p>No hay resultados para mostrar.</p>";
                endif;
            else:
                echo "<p>No hay temporada activa.</p>";
            endif;
            ?>
        </div>
    </section>
</main>

<style>
/* Tabla estilizada */
.results-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 2rem;
    background-color: #1a1a1a;
    color: #fff;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 4px 10px rgba(0,0,0,0.5);
}

.results-table th, .results-table td {
    padding: 12px 15px;
    text-align: left;
}

.results-table thead {
    background-color: #111;
}

.results-table tr:nth-child(even) {
    background-color: #222;
}

.results-table tr:hover {
    background-color: #333;
}

.gp-title {
    margin-top: 2rem;
    font-size: 1.5rem;
    color: #f0f0f0;
}

/* Badge de equipo */
.team-badge {
    display: inline-block;
    padding: 5px 10px;
    border-radius: 12px;
    color: #fff;
    font-weight: bold;
    font-size: 0.9rem;
}

/* Responsivo para móviles */
@media (max-width: 768px) {
    .results-table th, .results-table td {
        padding: 8px 10px;
    }
    .gp-title {
        font-size: 1.3rem;
    }
}
</style>

<?php require_once '../includes/footer.php'; ?>