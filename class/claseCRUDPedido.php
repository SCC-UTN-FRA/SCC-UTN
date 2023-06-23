<?php

class CreadorPedidos
{

    public function cargaPedido($conex)
    {
        $precioTotal = 0.00;
        $query = "INSERT INTO pedidos (fechaPedido,habilitado,precioTotal) VALUES ( NOW(),1,'$precioTotal')";
        $resultado = mysqli_query($conex, $query);
        if (!$resultado) {
            die("Error al insertar valores: " . mysqli_error($conex));
        }
    }

    public function cancelarPedido($conex, $idPed)
    {
        $queryDeshabilitar = "UPDATE pedidos SET Estado= 3 WHERE idPedido = $idPed";
        $resultado = mysqli_query($conex, $queryDeshabilitar);

        if (!$resultado) {
            die("Error al obtener datos de la tabla: " . mysqli_error($conex));
        }
    }
    public function finalizarPedido($conex, $idPed)
    {
        $queryDeshabilitar = "UPDATE pedidos SET Estado= 4 WHERE idPedido = $idPed";
        $resultado = mysqli_query($conex, $queryDeshabilitar);

        if (!$resultado) {
            die("Error al obtener datos de la tabla: " . mysqli_error($conex));
        }
    }
    public function iniciarPedido($conex, $idPed)
    {
        $queryIniciar = "UPDATE pedidos SET Estado= 2 WHERE idPedido = $idPed";
        $resultado = mysqli_query($conex, $queryIniciar);

        if (!$resultado) {
            die("Error al obtener datos de la tabla: " . mysqli_error($conex));
        }
    }

    public function imprimirPedidos($conex)
    {

        $queryTraerDatos = "SELECT * FROM pedidos AS P 
           LEFT JOIN tipoestados TE ON P.Estado = TE.idEstado WHERE Habilitado = 1";
        $resultado = mysqli_query($conex, $queryTraerDatos);

        if (!$resultado) {
            die("Error al obtener datos de la tabla: " . mysqli_error($conex));
        }


        while ($filaPedido = mysqli_fetch_assoc($resultado)) {

            $fechaInicio = ($filaPedido['fechaInicio'] == NULL) ? 'no asignado' : $filaPedido['fechaInicio'];
            $fechaFinal = ($filaPedido['fechaFinal'] == NULL) ? 'no asignado' : $filaPedido['fechaFinal'];
            
            $botonIniciar = ($filaPedido['Estado'] == 2 || $filaPedido['Estado'] == 4) ? '': '<form method="post"> <input type="hidden" name="iniciarPedido" value="' . $filaPedido['idPedido'] . '"> <button type="submit" class="btn btn-sm btn-success" >Iniciar Pedido</button></form>';
                
            $botonCancelar = ($filaPedido['Estado'] == 3 || $filaPedido['Estado'] == 4) ? '': '<form method="post"><input type="hidden" name="cancelarPedido" value="' . $filaPedido['idPedido'] .'"><button type="submit" class="btn btn-sm btn-danger">Cancelar Pedido</button></form>';
            
            $botonFinalizar = ($filaPedido['Estado'] == 4 ) ? '': '<form method="post"><input type="hidden" name="finalizarPedido" value="' . $filaPedido['idPedido'] . '"><button type="submit" class="btn btn-sm btn-secondary">Finalizar Pedido</button></form>';
                
            $card = '<button type="button" class="btn btn-dark d-flex justify-content-center" data-bs-toggle="modal" data-bs-target="#' . $filaPedido['idPedido'] . '">
            <p class="m-2">Pedido Nº # ' . $filaPedido['idPedido'] . '</p>          
            <p class="m-2">' . date('d-m-Y', strtotime($filaPedido['fechaPedido'])) . '</p>
            <p class="m-2"> Estado: ' . $filaPedido['descripcionEstado'] . '</p></button>  ';

            $modal = '
                <div class="modal" tabindex="-1" id="' . $filaPedido['idPedido'] . '">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title">Nº Pedido: #' . $filaPedido['idPedido'] .' '.$filaPedido['descripcionEstado']  . '</h3>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>La fecha del pedido es: ' . date('d-m-Y', strtotime($filaPedido['fechaPedido'])) . '.</p>
                            <p>Fecha de inicio del pedido: ' . $fechaInicio . '.</p>
                            <p>Fecha de finalizacion del pedido: ' . $fechaFinal . '.</p>                               
                        </div>';

            $modalFooter = '
                        <div class="modal-footer justify-content-space-between">
                            '.$botonIniciar.'
                            '.$botonCancelar.'
                            '.$botonFinalizar.'
                        </div>
                    </div>
                </div>
            </div> ';

            echo $card ;
            echo $modal . $modalFooter;
        }
    }

    //////////////////////////////////////////////////////////////
    /*hora actual de buenos aires, lo cambie porque estaba dando mal las fechas, tiraba una fecha global*/
    public function fechaActualPedido()
    {
        date_default_timezone_set('America/Buenos_Aires');
        $fecha = date("d-m-Y");
        echo $fecha;
    }
    //////////////////////////////////////////////////////////////
    /*fecha con el año invertido, es para condicionar cuando se elije
     fecha de inicio y final de fabricacion de un pedido*/
    public function fechaInvertida()
    {
        date_default_timezone_set('America/Buenos_Aires');
        $fecha = date("Y-m-d");
        echo $fecha;
    }

    //////////////////////////////////////////////////////////////
    /*intentaba cargarle un id 1 temporalmente porque en la tabla "pedidos" en la base
     de datos no tiene nada cargado, pero cuando se cargara iba a empezar a cargar desde el 2 
     (esta parte del codigo esta dirigida a mostrar por cual numero de registro vas a registrar tu pedido)*/
    public function traeIdPedido($conex)
    {
        $primerPedido = 1;
        $queryTraerDatos = "SELECT idPedido FROM pedidos ORDER BY idPedido DESC LIMIT 1";
        $resultado = mysqli_query($conex, $queryTraerDatos);

        if (!$resultado) {
            die("Error al obtener datos de la tabla: " . mysqli_error($conex));
        }

        $filaPedido = mysqli_fetch_assoc($resultado);

        if ($filaPedido == null) {
            return $primerPedido;
        } else {
            return $filaPedido['idPedido'] + 1;
        }
    }
}
