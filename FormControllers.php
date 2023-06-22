<?php

require_once 'class/claseCRUDPedido.php';
require_once 'class/claseCRUDRenglonesPedido.php';

$host = '127.0.0.1';
$user = 'root';
$password = '';
$database = 'SCC';
$conex = mysqli_connect($host, $user, $password, $database);

if (!$conex) {
    die("Error al conectar a la base de datos: " . mysqli_connect_error());
}

session_start();

///////////////////////////-PEDIDO-////////////////////////////////////
if (!isset($_SESSION['ObjetoPedidos'])) {
    $_SESSION['ObjetoPedidos'] = new CreadorPedidos();
}

$ObjetoPedidos = $_SESSION['ObjetoPedidos'];

if (!isset($_SESSION['CabecerasRenglones'])) {
    $_SESSION['CabecerasRenglones'] = new CabecerasRenglones();
}
$ObjetoRenglones = $_SESSION['CabecerasRenglones'];

if (isset($_POST['cargarPedido'])) {

    $ObjetoPedidos->cargaPedido($conex);
}

if (isset($_POST['cancelarPedido'])) {
    $pedidoActual = $_POST['cancelarPedido'];
    $ObjetoPedidos->cancelarPedido($conex, $pedidoActual);
    
}

if (isset($_POST['iniciarPedido'])) {
    $pedidoActual = $_POST['iniciarPedido'];
    $ObjetoPedidos->iniciarPedido($conex, $pedidoActual);
    
}

if (isset($_POST['finalizarPedido'])) {
    $pedidoActual = $_POST['finalizarPedido'];
    $ObjetoPedidos->finalizarPedido($conex, $pedidoActual);
    
}
///////////////////////////-RENGLONES-//////////////////////////////////////

if (isset($_POST['cargarRenglon'])) {
    if (strlen(($_POST["S"])) > 0||strlen(($_POST["M"])) > 0||
        strlen(($_POST["L"])) > 0||strlen(($_POST["XL"])) > 0||strlen(($_POST["XXL"])) > 0) {

        $color=$_POST['miSelectorColor'];
		$genero=$_POST['miSelectorGenero'];
        
        $pedidoActual=$ObjetoPedidos->traeIdPedido($conex);
        
        $S=$_POST['S'];
		$M=$_POST['M'];
        $L=$_POST['L'];
		$XL=$_POST['XL'];
        $XXL=$_POST['XXL'];
        $ObjetoRenglones->cargarRenglones($conex,$pedidoActual,$color,$S,$M,$L,$XL,$XXL,$genero);
    }
}
?>