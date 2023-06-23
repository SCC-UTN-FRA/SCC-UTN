<?php

class CabecerasRenglones
{
    public $ListaRenglones = array();
    public $idRenglonActual = 1;

    public function DB_cargarRenglones($conex, $idPed, $idRenglon, $color, $talleS, $talleM, $talleL, $talleXL, $talleXXL, $gen)
    {
        $query = "INSERT INTO renglones (idPedido,idRenglon,color,s,m,l,xl,xxl,genero) VALUES
         ('$idPed', '$idRenglon', '$color','$talleS','$talleM','$talleL','$talleXL','$talleXXL','$gen')";
        $resultado = mysqli_query($conex, $query);

        if (!$resultado) {
            die("Error al insertar valores: " . mysqli_error($conex));
        }
    }

    public function DB_imprimirRenglones($conex)
    {

        $queryTraerDatos = "SELECT * FROM renglones ";
        $resultado = mysqli_query($conex, $queryTraerDatos);

        if (!$resultado) {
            die("Error al obtener datos de la tabla: " . mysqli_error($conex));
        }


        while ($filaRenglon = mysqli_fetch_assoc($resultado)) {

            $renglon =
                '
                    <tr>
                        <td>' . $filaRenglon['color'] . '</td>
                        <td>' . $filaRenglon['s'] . '</td>
                        <td>' . $filaRenglon['m'] . '</td>
                        <td>' . $filaRenglon['l'] . '</td>
                        <td>' . $filaRenglon['xl'] . '</td>
                        <td>' . $filaRenglon['xxl'] . '</td>
                        <td>' . $filaRenglon['genero'] . '</td>
                    </tr>
                ';

            echo $renglon;
        }
    }

    public function loadRenglonesSession($idPed, $color, $talleS, $talleM, $talleL, $talleXL, $talleXXL, $gen)
    {   
        $RenglonTMP = array(
            'idPedidoTMP' => $idPed,
            'idRenglon' => $this->idRenglonActual,
            'color' => $color,
            'talleS' => $talleS,
            'talleM' => $talleM,
            'talleL' => $talleL,
            'talleXL' => $talleXL,
            'talleXXL' => $talleXXL,
            'gen' => $gen
        );

        $this->ListaRenglones[] = $RenglonTMP;
        $this->idRenglonActual++;
    }

    public function printRenglonesSession()
    {
        foreach ($this->ListaRenglones as $renglonTemporal) {
            
            $idPedidoAc = strval($renglonTemporal['idPedidoTMP']);
            $idRenglon = strval($renglonTemporal['idRenglon']);
            $color = $renglonTemporal['color'];
            $talleS = $renglonTemporal['talleS'];
            $talleM = $renglonTemporal['talleM'];
            $talleL = $renglonTemporal['talleL'];
            $talleXL = $renglonTemporal['talleXL'];
            $talleXXL = $renglonTemporal['talleXXL'];
            $gen = $renglonTemporal['gen'];

            $renglon =
                '
                    <tr>
                        <td>' . $idPedidoAc . '</td>
                        <td>' . $idRenglon . '</td>
                        <td>' . $color . '</td>
                        <td>' . $talleS . '</td>
                        <td>' . $talleM . '</td>
                        <td>' . $talleL . '</td>
                        <td>' . $talleXL . '</td>
                        <td>' . $talleXXL . '</td>
                        <td>' . $gen . '</td>
                    </tr>
                ';

            echo $renglon;
        }
    }

    public function imprimirGenero($conex)
    {
        $queryTraerDatos = "SELECT * FROM tipogenero ";
        $resultado = mysqli_query($conex, $queryTraerDatos);
        if (!$resultado) {
            die("Error al obtener datos de la tabla: " . mysqli_error($conex));
        }
        while ($filaRenglon = mysqli_fetch_assoc($resultado)) {

            $renglon =
                '  
                    <option value=' . $filaRenglon['Descripcion'] . '>' . $filaRenglon['Descripcion'] . '</option>
                ';
            echo $renglon;
        }
    }

    public function imprimirColor($conex)
    {
        $queryTraerDatos = "SELECT * FROM colores ";
        $resultado = mysqli_query($conex, $queryTraerDatos);
        if (!$resultado) {
            die("Error al obtener datos de la tabla: " . mysqli_error($conex));
        }
        while ($filaRenglon = mysqli_fetch_assoc($resultado)) {

            $renglon =
                '  
                    <option value=' . $filaRenglon['color'] . '>' . $filaRenglon['color'] . '</option>
                ';
            echo $renglon;
        }
    }

    //public function borrarPedido($conex, $idPed)
    //{
    //    $queryElimina = "DELETE FROM renglones WHERE idPedido = $idPed";
    //    $resultado = mysqli_query($conex, $queryElimina);
    //    if (!$resultado) {
    //        die("Error al obtener datos de la tabla: " . mysqli_error($conex));
    //    }
    //}

}
