<?php
session_start();
if(!isset($_SESSION['carrito'])) $_SESSION['carrito'] = [];

$id_producto = $_GET['id'] ?? null;
if($id_producto) {
    $_SESSION['carrito'][] = $id_producto;
    header('Location: ../pages/merchandising.php');
}
?>
