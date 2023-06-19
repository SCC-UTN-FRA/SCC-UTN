<?php

class CreadorPedidos
{

    public function cargaPedido($conex, $pedidoStock)
    {
        $queryUltimo = "select cantidad,fecha from pedidos order by idPedido DESC limit 1";
        $resultadoUltimo = mysqli_query($conex, $queryUltimo);
        $filaUltimo = mysqli_fetch_assoc($resultadoUltimo);
        $pedidoFecha = date('Y-m-d');

        if (!($pedidoStock ==  $filaUltimo['cantidad'])) {
            $query = "INSERT INTO pedidos (cantidad, fecha) VALUES ('$pedidoStock', '$pedidoFecha')";

            if (mysqli_query($conex, $query)) {
                //$flag = true;
            } else {
                print  "Error al insertar valores: " . mysqli_error($conex);
            }
        }

        header("Location: index.php");
        exit();
    }

    public function borrarPedido($conex, $idPed)
    {
        $queryDeshabilitar = "UPDATE pedidos SET Habilitado = 0 WHERE idPedido = $idPed";
        $resultado = mysqli_query($conex, $queryDeshabilitar);

        if (!$resultado) {
            die("Error al obtener datos de la tabla: " . mysqli_error($conex));
        }
    }

    public function imprimirPedidos($conex)
    {

        $queryTraerDatos = "SELECT * FROM pedidos WHERE Habilitado = 1";
        $resultado = mysqli_query($conex, $queryTraerDatos);

        if (!$resultado) {
            die("Error al obtener datos de la tabla: " . mysqli_error($conex));
        }


        while ($filaPedido = mysqli_fetch_assoc($resultado)) {

            $card = '
                <div class="card" style="width: 12.5rem;margin:.5rem;">
                    <div class="card-body">
                    <h5 class="card-title">Pedido Nº</h5>
                    <h4>#' . $filaPedido['idPedido'] . '</h4>
                    <p class="card-text">' . $filaPedido['cantidad'] . '</p>
                    <p class="card-text">' .date('d-m-Y', strtotime($filaPedido['fecha'])). '</p>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#' . $filaPedido['idPedido'] . '"> abrir pedido </button>
                    </div>
                </div>';

            $modal = '
                <div class="modal" tabindex="-1" id="' . $filaPedido['idPedido'] . '">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Nº Pedido: #' . $filaPedido['idPedido']  . '</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>La cantidad pedida es: ' . $filaPedido['cantidad'] . '.</p> 
                            <p>La fecha del pedido es: ' . date('d-m-Y', strtotime($filaPedido['fecha'])) . '.</p>
                            <p>Fecha de finalizacion aprox: ' . date('d-m-Y', strtotime('+7 days', strtotime($filaPedido['fecha']))) . '.</p>                               
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <form method="post">
                                <input type="hidden" name="eliminarPedido" value="' . $filaPedido['idPedido'] . '">
                                <button type="submit" class="btn btn-danger">Eliminar Pedido</button>
                            </form>
                        </div>
                        </div>
                    </div>
                    </div>';

            echo $card . '<br/>';
            echo $modal . '<br/>';
        }
    }

    public function fechaActualPedido(){
        $fecha = date('d-m-Y');
        $formValorFecha = '<input type="text" readonly class="form-control-plaintext" id="staticEmail" value="'.$fecha.'">';
        echo $formValorFecha;
    }
    
}
