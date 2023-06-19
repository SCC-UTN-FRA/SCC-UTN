<?php

class CabecerasRenglones
{

    public function cargarRenglones($conex, $pedidoStock)
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

    public function imprimirRenglones($conex)
    {

        $queryTraerDatos = "SELECT * FROM renglones WHERE Habilitado = 1";
        $resultado = mysqli_query($conex, $queryTraerDatos);

        if (!$resultado) {
            die("Error al obtener datos de la tabla: " . mysqli_error($conex));
        }


        while ($filaRenglon = mysqli_fetch_assoc($resultado)) {

            $renglon = 
                '
                    <td>'.$filaRenglon['color'].'</td>
                    <td>'.$filaRenglon['s'].'</td>
                    <td>'.$filaRenglon['m'].'</td>
                    <td>'.$filaRenglon['l'].'</td>
                    <td>'.$filaRenglon['xl'].'</td>
                    <td>'.$filaRenglon['xxl'].'</td>
                    <td>'.$filaRenglon['genero'].'</td>
                ';

            echo $renglon;
        }
    }

    public function fechaActualPedido(){
        $fecha = date('d-m-Y');
        $formValorFecha = '<input type="text" readonly class="form-control-plaintext" id="staticEmail" value="'.$fecha.'">';
        echo $formValorFecha;
    }
    
}
