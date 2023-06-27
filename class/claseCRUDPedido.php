<?php
require_once 'class/claseCRUDRenglonesPedido.php';
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
        $queryDeshabilitar = "UPDATE pedidos SET Estado= 3, fechaSuspendido=NOW() WHERE idPedido = $idPed";
        $resultado = mysqli_query($conex, $queryDeshabilitar);

        if (!$resultado) {
            die("Error al obtener datos de la tabla: " . mysqli_error($conex));
        }
    }
    public function finalizarPedido($conex, $idPed)
    {
        $queryDeshabilitar = "UPDATE pedidos SET Estado= 4, fechaFinal=NOW() WHERE idPedido = $idPed";
        $resultado = mysqli_query($conex, $queryDeshabilitar);

        if (!$resultado) {
            die("Error al obtener datos de la tabla: " . mysqli_error($conex));
        }
    }
    public function iniciarPedido($conex, $idPed)
    {
        $queryIniciar = "UPDATE pedidos SET Estado= 2, fechaInicio=NOW() WHERE idPedido = $idPed";
        $resultado = mysqli_query($conex, $queryIniciar);

        if (!$resultado) {
            die("Error al obtener datos de la tabla: " . mysqli_error($conex));
        }
    }

    public function imprimirPedidos($conex)
    {
        $claseRenglon = new CabecerasRenglones;

        $queryTraerDatos = "SELECT * FROM pedidos AS P 
           LEFT JOIN tipoestados TE ON P.Estado = TE.idEstado WHERE Habilitado = 1 ORDER BY P.Estado, P.fechaPedido DESC LIMIT 10";
        $resultado = mysqli_query($conex, $queryTraerDatos);

        if (!$resultado) {
            die("Error al obtener datos de la tabla: " . mysqli_error($conex));
        }

        while ($filaPedido = mysqli_fetch_assoc($resultado)) {

            $fechaInicio = ($filaPedido['fechaInicio'] == NULL) ? 'no asignado' : $filaPedido['fechaInicio'];
            $fechaSuspendido = ($filaPedido['fechaSuspendido'] == NULL) ? 'no asignado' : $filaPedido['fechaSuspendido'];
            $fechaFinal = ($filaPedido['fechaFinal'] == NULL) ? 'no asignado' : $filaPedido['fechaFinal'];

            $botonIniciar = ($filaPedido['Estado'] == 2 || $filaPedido['Estado'] == 4) ? '' : '<form method="post"> <input type="hidden" name="iniciarPedido" value="' . $filaPedido['idPedido'] . '"> <button type="submit" class="btn btn-sm btn-success m-1" >Iniciar</button></form>';
            $botonCancelar = ($filaPedido['Estado'] == 3 || $filaPedido['Estado'] == 4) ? '' : '<form method="post"><input type="hidden" name="cancelarPedido" value="' . $filaPedido['idPedido'] . '"><button type="submit" class="btn btn-sm btn-danger m-1">Suspender</button></form>';
            $botonFinalizar = ($filaPedido['Estado'] == 4) ? '' : '<form method="post"><input type="hidden" name="finalizarPedido" value="' . $filaPedido['idPedido'] . '"><button type="submit" class="btn btn-sm btn-secondary m-1">Finalizar</button></form>';

            $color = '';

            switch ($filaPedido['Estado']) {
                case 1: $color = 'secondary'; break;
                case 2: $color = 'info'; break;
                case 3: $color = 'danger'; break;
                case 4: $color = 'success'; break;
            }

            $claseRenglon->DB_imprimirRenglones($conex, $filaPedido['idPedido']);

            $card = '<button type="button" class="btn btn-dark d-flex justify-content-center " data-bs-toggle="modal" data-bs-target="#' . $filaPedido['idPedido'] . '">
            <p class="m-2">Nº # ' . $filaPedido['idPedido'] . '</p>          
            <p class="m-2">' . date('d-m-Y', strtotime($filaPedido['fechaPedido'])) . '</p>
            <p class="m-2"> ' . $filaPedido['descripcionEstado'] . '</p></button>  ';

            $modal = '
                <div class="modal fade" tabindex="-1" id="' . $filaPedido['idPedido'] . '">
                    <div class="modal-dialog modal-fullscreen modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header justify-content-start">
                                <div>
                                    <h6 class="modal-title">Nº#' . $filaPedido['idPedido'] . ' / ' . date('d-m-Y', strtotime($filaPedido['fechaPedido'])) . '</h6>
                                </div>
                                <h6 class="ms-3 modal-title text-' . $color . '">' . $filaPedido['descripcionEstado']  . '</h6>
                            </div>
                                <div class="row modal-body justify-content-center">
                                    <div class="col-lg-6 overflow-y-hidden">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br>
                                        Nullam volutpat justo ut eros commodo, id viverra purus efficitur.<br>
                                        Quisque auctor tellus eget velit ultrices lacinia.<br>
                                        Maecenas id ligula at libero convallis congue.<br>
                                        Nam non sapien nec mi efficitur venenatis.<br>
                                        Pellentesque sed enim ac mauris fringilla interdum.<br>
                                        Vivamus dignissim orci in erat tempor, non bibendum sem venenatis.<br>
                                        Aliquam luctus dui ut massa dignissim, id mattis elit lacinia.<br>
                                        Duis sed felis eu sem posuere egestas eu vel elit.<br>
                                        Suspendisse ac metus vel nisi finibus pellentesque a sit amet diam.</p>
                                    </div>
                                    
                                    <div class="col-lg-6 overflow-y-scroll h-100"  id="tableColor">
                                        <table class=" table table-striped table-hover">
                                            <thead class="text-bg-dark" style="position: sticky; top: -15px;">
                                                <tr>
                                                    <th scope="col" class="col-lg-1">S</th>
                                                    <th scope="col" class="col-lg-1">M</th>
                                                    <th scope="col" class="col-lg-1">L</th>
                                                    <th scope="col" class="col-lg-1">XL</th>
                                                    <th scope="col" class="col-lg-1">XXL</th>
                                                    <th scope="col" class="col-lg-1">C</th>
                                                    <th scope="col" class="col-lg-1">G</th>
                                                </tr>
                                            </thead>
                                            <tbody class="table-group-divider" >
                                            
                                            ';


            $modalFooter = '                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            
                            <div class="modal-footer justify-content-start">
                                <p class="mb-0"><b>Iniciado</b>: ' . $fechaInicio . '.</p>
                                <p class="mb-0"><b>Suspendido</b>: ' . $fechaSuspendido . '.</p>
                                <p class="mb-0"><b>Finalizado</b>: ' . $fechaFinal . '.</p>                               
                            </div>
                            <div class="modal-footer justify-content-between align-items-center">
                                <div class="ml-auto"><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>
                                <div class="d-flex">' . $botonIniciar . $botonCancelar .' '. $botonFinalizar . '</div>
                            </div>
                        </div>
                    </div>
                    
                </div> 
            ';

            echo $card;
            echo $modal;

            foreach ($claseRenglon->DBListaRenglonesARR as $renglon) {

                $color = $renglon['color'];
                $talleS = $renglon['talleS'];
                $talleM = $renglon['talleM'] ;
                $talleL = $renglon['talleL'] ;
                $talleXL = $renglon['talleXL'] ;
                $talleXXL = $renglon['talleXXL'] ;
                $gen = $renglon['gen'];

                $renglon =
                    '
                        <tr>
                            <td>' . $talleS . '</td>
                            <td>' . $talleM . '</td>
                            <td>' . $talleL . '</td>
                            <td>' . $talleXL . '</td>
                            <td>' . $talleXXL . '</td>
                            <td>' . $color . '</td>
                            <td>' . $gen . '</td>
                        </tr>
                    ';

                echo $renglon;
            }
            unset($claseRenglon->DBListaRenglonesARR);
            echo $modalFooter;
        }
    }

    public function fechaActualPedido()
    {
        date_default_timezone_set('America/Buenos_Aires');
        $fecha = date("d-m-Y");
        echo $fecha;
    }

    public function fechaInvertida()
    {
        date_default_timezone_set('America/Buenos_Aires');
        $fecha = date("Y-m-d");
        echo $fecha;
    }

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
