<?php
    
    include 'FormControllers.php';
    require_once 'class/claseCRUDPedido.php';

    if (!isset($_SESSION['ObjetoPedidos'])) {
        $_SESSION['ObjetoPedidos'] = new CreadorPedidos();
    }
    
    $ObjetoPedidos = $_SESSION['ObjetoPedidos'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>Sistema de Control de Camisas</title>
</head>

<body>

    <div class="container d-flex mt-3 justify-content-center">

        <form class="w-50" method="post">
            <div class="form-floating mb-3">
                <input type="number" name="cantidad" class="form-control" id="floatingInput">
                <label for="floatingInput">Cantidad a pedir</label>
            </div>
            <div class="form-floating mb-3">
                <input type="date" name="fecha" class="form-control" id="floatingInput">
                <label for="floatingInput">Fecha Pedido</label>
            </div>
            <input type="hidden" name="cargarPedido" value="true">
            <input type="submit" value="Enviar">
        </form>

    </div>

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