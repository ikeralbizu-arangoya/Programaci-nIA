<?php
require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $entrada_id = $_POST['entrada_id'];
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $cantidad = $_POST['cantidad'];

    // Obtener información de la entrada y precio
    $stmt = $pdo->prepare("SELECT ed.cantidad_disponible, te.precio, gp.nombre as gran_premio 
                           FROM entradas_disponibles ed
                           JOIN tipos_entradas te ON ed.tipo_entrada_id = te.id
                           JOIN grandes_premios gp ON ed.gran_premio_id = gp.id
                           WHERE ed.id = ?");
    $stmt->execute([$entrada_id]);
    $entrada = $stmt->fetch();

    if (!$entrada) {
        die("Entrada no encontrada.");
    }

    if ($cantidad > $entrada['cantidad_disponible']) {
        die("No hay suficientes entradas disponibles.");
    }

    $precio_total = $cantidad * $entrada['precio'];

    // Insertar pedido
    $stmt = $pdo->prepare("INSERT INTO pedidos_entradas (nombre_cliente, email_cliente, entrada_disponible_id, cantidad, precio_total) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$nombre, $email, $entrada_id, $cantidad, $precio_total]);

    // Actualizar stock
    $stmt = $pdo->prepare("UPDATE entradas_disponibles SET cantidad_disponible = cantidad_disponible - ? WHERE id = ?");
    $stmt->execute([$cantidad, $entrada_id]);

    echo "Compra realizada correctamente para el Gran Premio: " . htmlspecialchars($entrada['gran_premio']);
}
?>
