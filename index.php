<?php

include 'FormControllers.php';
require_once 'class/claseCRUDPedido.php';
require_once 'class/claseCRUDRenglonesPedido.php';

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/977a02dee3.js" crossorigin="anonymous"></script>
    <title>Sistema de Control de Camisas</title>
</head>

<body data-bs-theme="dark" class="container d-flex flex-column align-items-center">

    <!--//////////  Esta parte solo es para realizar pedidos ////////////////////////// -->
    <div class="m-3 p-3 rounded border border-white">

        <div class="">
            <div class="col">
                <label for="staticEmail" class="">Fecha del pedido:</label>
                <?php
                $ObjetoPedidos->fechaActualPedido();
                ?>
            </div>
            <div class="col-12">
                <label for="staticEmail" class="col">Pedido N°:
                    <?php echo $ObjetoPedidos->traeIdPedido($conex); ?>
                </label>
            </div>
        </div>

        <div class="container mt-2 text-center">
            <h4>ELIJA PEDIDO Y CANTIDAD</h4>
            <form class="d-flex align-items-center justify-content-center" method="post">
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
                                <select class="form-select form-select-sm" aria-label="Default select example" name="miSelectorColor">
                                    <?php
                                    $ObjetoRenglones->imprimircolor($conex);
                                    ?>
                                </select>
                            </td>
                            <td style="width:70px;"><input type="text" class="form-control form-control-sm" name="S"></td>
                            <td style="width:70px;"><input type="text" class="form-control form-control-sm" name="M"></td>
                            <td style="width:70px;"><input type="text" class="form-control form-control-sm" name="L"></td>
                            <td style="width:70px;"><input type="text" class="form-control form-control-sm" name="XL"></td>
                            <td style="width:70px;"><input type="text" class="form-control form-control-sm" name="XXL"></td>
                            <td style="width:160px;">
                                <select class="form-select form-select-sm" name="miSelectorGenero">
                                    <?php
                                    $ObjetoRenglones->imprimirGenero($conex);
                                    ?>
                                </select>
                            </td>
                            <td style="width:50px;cursor: pointer;">
                                <input type="hidden" name="cargarRenglon" value="true">
                                <button type="submit" style="border: none; background: none;">
                                    <i style="font-size:2rem;" class="fa-solid fa-circle-check"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>

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
                                <?php
                                $ObjetoRenglones->imprimirRenglones($conex);
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <form class="w-50" method="post">
                    <input type="hidden" name="cargarPedido" value="true">
                    <button type="submit" class="btn btn-secondary">Guardar pedido</button>
                </form>

            </div>
        </div>
    </div>

    <!--//////////  Esta parte imprime los pedidos ////////////////////////// -->
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


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script>
        var modales = document.querySelectorAll('.modal');
        $(function() {
            $(modales[0].id).modal('show');
        })
    </script>
</body>

</html>