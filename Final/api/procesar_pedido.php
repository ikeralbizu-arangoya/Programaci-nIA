<?php
require_once '../config/database.php';

if($_SERVER['REQUEST_METHOD'] !== 'POST'){
    header('Location: ../pages/merchandising.php');
    exit;
}

// Datos del cliente
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$telefono = $_POST['telefono'] ?? '';
$direccion = $_POST['direccion'];
$productos = $_POST['productos']; // Array: ['id'=>cantidad]
$total = 0;

// Calcular total y verificar stock
foreach($productos as $id => $cantidad){
    $stmt = $pdo->prepare("SELECT precio, stock FROM productos_merchandising WHERE id=?");
    $stmt->execute([$id]);
    $producto = $stmt->fetch();
    if(!$producto) { die("Producto no encontrado."); }
    if($cantidad > $producto['stock']) { die("Stock insuficiente para producto ID $id."); }
    $total += $producto['precio']*$cantidad;
}

// Insertar pedido
$stmt = $pdo->prepare("INSERT INTO pedidos_merchandising (nombre_cliente,email_cliente,telefono,direccion_envio,total) VALUES (?,?,?,?,?)");
$stmt->execute([$nombre,$email,$telefono,$direccion,$total]);
$pedido_id = $pdo->lastInsertId();

// Insertar detalle de pedido y restar stock
foreach($productos as $id => $cantidad){
    $stmt = $pdo->prepare("SELECT precio FROM productos_merchandising WHERE id=?");
    $stmt->execute([$id]);
    $precio = $stmt->fetchColumn();
    $stmt = $pdo->prepare("INSERT INTO detalle_pedidos_merchandising (pedido_id,producto_id,cantidad,precio_unitario) VALUES (?,?,?,?)");
    $stmt->execute([$pedido_id,$id,$cantidad,$precio]);
    $stmt = $pdo->prepare("UPDATE productos_merchandising SET stock=stock-? WHERE id=?");
    $stmt->execute([$cantidad,$id]);
}

echo "<p>Pedido realizado con éxito! Total: €".number_format($total,2)."</p>";
echo "<a href='../pages/merchandising.php'>Volver a la tienda</a>";
