<?php

require_once 'class/claseCRUDPedido.php';

$host = '127.0.0.1';
$user = 'root';
$password = '';
$database = 'SCC';
$conex = mysqli_connect($host, $user, $password, $database);

if (!$conex) {
    die("Error al conectar a la base de datos: " . mysqli_connect_error());
}

session_start();

if (!isset($_SESSION['ObjetoPedidos'])) {
    $_SESSION['ObjetoPedidos'] = new CreadorPedidos();
}

$ObjetoPedidos = $_SESSION['ObjetoPedidos'];

if (isset($_POST['cargarPedido'])) {
    if (strlen(($_POST["cantidad"])) > 0 && strlen($_POST["fecha"]) >= 1) {
        $pedStock = $_POST["cantidad"];
        $pedFecha = $_POST["fecha"];
        $ObjetoPedidos->cargaPedido($conex, $pedStock, $pedFecha);
    }
}

if (isset($_POST['eliminarPedido'])) {
    $pedidoActual = $_POST['eliminarPedido'];
    $ObjetoPedidos->borrarPedido($conex, $pedidoActual);
}
?>