<?php

include 'FormControllers.php';
require_once 'class/claseCRUDPedido.php';
require_once 'class/claseCRUDRenglonesPedido.php';

if (!isset($_SESSION['ObjetoPedidos'])) {
    $_SESSION['ObjetoPedidos'] = new CreadorPedidos();
}
$ObjetoPedidos = $_SESSION['ObjetoPedidos'];

if (!isset($_SESSION['CabecerasRenglones'])) {
    $_SESSION['CabecerasRenglones'] = new CabecerasRenglones();
}
$CabecerasRenglones = $_SESSION['CabecerasRenglones'];

if (isset($_POST['cargarRenglon'])) {
    //echo '<h1>HOLA ESTE ES EL CLICK</h1>';
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/977a02dee3.js" crossorigin="anonymous"></script>
    <title>Sistema de Control de Camisas</title>
</head>

<body data-bs-theme="dark" class="container d-flex flex-column align-items-center">
    <div>
        <div class="container text-center">
            <h4>PEDIDOS</h4>
            <div class="d-flex align-items-center justify-content-center">
                <div class="row g-2 justify-content-center">
                    <?php
                    $ObjetoPedidos->imprimirPedidos($conex);
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="container d-flex mt-3 justify-content-center">

        <form class="w-50" method="post">
            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-4 col-form-label">Fecha del pedido</label>
                <div class="col-sm-8">
                    <?php
                    $ObjetoPedidos->fechaActualPedido();
                    ?>
                </div>
            </div>
            <div class="form-floating mb-3">
                <input type="number" name="cantidad" class="form-control" id="floatingInput">
                <label for="floatingInput">Cantidad a pedir</label>
            </div>
            <!-- <div class="form-floating mb-3">
                <input type="date" name="fecha" class="form-control" id="floatingInput">
                <label for="floatingInput">Fecha Pedido</label>
            </div> -->
            <input type="hidden" name="cargarPedido" value="true">
            <input type="submit" value="Enviar">
        </form>

    </div>

    <form class="d-flex align-items-center w-75" method="post">
        <table class="table ">
            <thead>
                <tr>
                    <th scope="col">COLOR</th>
                    <th scope="col">S</th>
                    <th scope="col">M</th>
                    <th scope="col">L</th>
                    <th scope="col">XL</th>
                    <th scope="col">XXL</th>
                    <th scope="col">GENERO</th>
                    <th scope="col">ENVIAR</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="width:120px;">
                        <select class="form-select" aria-label="Default select example">
                            <option selected value="1">Rojo</option>
                            <option value="2">Verde</option>
                            <option value="3">Amarillo</option>
                        </select>
                    </td>
                    <td style="width:70px;"><input type="text" class="form-control"></td>
                    <td style="width:70px;"><input type="text" class="form-control"></td>
                    <td style="width:70px;"><input type="text" class="form-control"></td>
                    <td style="width:70px;"><input type="text" class="form-control"></td>
                    <td style="width:70px;"><input type="text" class="form-control"></td>
                    <td style="width:160px;">
                        <select class="form-select">
                            <option select value="1">Hombre</option>
                            <option value="2">Mujer</option>
                        </select>
                    </td>
                    <td style="width:50px;cursor: pointer;">
                        <input type="hidden" name="cargarRenglon" value="true">
                        <button type="submit" style="border: none; background: none;">
                            <i style="font-size:2.5rem;" class="fa-solid fa-circle-check"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>

    <div class="container mt-2">
        <div>
            <div class="container text-center">
                <h4>CURVA DE TALLE</h4>
                <div class="d-flex align-items-center justify-content-center">
                    <table class="table ">
                        <thead>
                            <tr>
                                <th scope="col">COLOR</th>
                                <th scope="col">S</th>
                                <th scope="col">M</th>
                                <th scope="col">L</th>
                                <th scope="col">XL</th>
                                <th scope="col">XXL</th>
                                <th scope="col">GENERO</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>44</td>
                                <td>89</td>
                                <td>133</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script>
        var modales = document.querySelectorAll('.modal');
        $(function() {
            $(modales[0].id).modal('show');
        })
    </script>
</body>

</html>