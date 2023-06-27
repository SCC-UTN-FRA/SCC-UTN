<?php

class CabecerasRenglones
{
    function __construct()
    {
        $this->ListaRenglones = array();
    }

    public $idRenglonActual = 1;
    public $DBListaRenglonesARR = array();

    function devolverRenglon()
    {
        return $this->idRenglonActual;
    }

    function aumentarRenglon()
    {
        $this->idRenglonActual++;
    }

    public function DB_cargarRenglones($conex, $idPed, $idRenglon, $color, $talleS, $talleM, $talleL, $talleXL, $talleXXL, $gen)
    {
        $query = "INSERT INTO renglones (idPedido,idRenglon,color,s,m,l,xl,xxl,genero) VALUES
         ('$idPed', '$idRenglon', '$color','$talleS','$talleM','$talleL','$talleXL','$talleXXL','$gen')";
        $resultado = mysqli_query($conex, $query);

        if (!$resultado) {
            die("Error al insertar valores: " . mysqli_error($conex));
        }
    }

    public function DB_imprimirRenglones($conex, $idPed)
    {
        $queryTraerDatos = "SELECT * FROM renglones WHERE idPedido = $idPed";
        $resultado = mysqli_query($conex, $queryTraerDatos);

        if (!$resultado) {
            die("Error al obtener datos de la tabla: " . mysqli_error($conex));
        }


        while ($filaRenglon = mysqli_fetch_assoc($resultado)) {

            $RenglonesTMP = array(

                'color' => $filaRenglon['color'],
                'talleS' => $filaRenglon['s'],
                'talleM' =>  $filaRenglon['m'],
                'talleL' => $filaRenglon['l'],
                'talleXL' => $filaRenglon['xl'],
                'talleXXL' => $filaRenglon['xxl'],
                'gen' => $filaRenglon['genero']
            );

            $this->DBListaRenglonesARR[] = $RenglonesTMP;
        }
    }

    public function loadRenglonesSession($idPed, $idRenglonActual, $color, $talleS, $talleM, $talleL, $talleXL, $talleXXL, $gen)
    {
        $RenglonTMP = array(
            'idPedidoTMP' => $idPed,
            'idRenglon' => $idRenglonActual,
            'color' => $color,
            'talleS' => $talleS,
            'talleM' => $talleM,
            'talleL' => $talleL,
            'talleXL' => $talleXL,
            'talleXXL' => $talleXXL,
            'gen' => $gen
        );

        $this->ListaRenglones[] = $RenglonTMP;
        $this->aumentarRenglon();
    }

    public function printRenglonesSession()
    {
        foreach ($this->ListaRenglones as $renglonTemporal) {

            $idPedidoAc = strval($renglonTemporal['idPedidoTMP']);
            $idRenglon = strval($renglonTemporal['idRenglon']);
            $color = $renglonTemporal['color'];
            $talleS = ($renglonTemporal['talleS'] != NULL) ? $renglonTemporal['talleS'] : '0';
            $talleM = ($renglonTemporal['talleM'] != NULL) ? $renglonTemporal['talleM'] : '0';
            $talleL = ($renglonTemporal['talleL'] != NULL) ? $renglonTemporal['talleL'] : '0';
            $talleXL = ($renglonTemporal['talleXL'] != NULL) ? $renglonTemporal['talleXL'] : '0';
            $talleXXL = ($renglonTemporal['talleXXL'] != NULL) ? $renglonTemporal['talleXXL'] : '0';
            $gen = $renglonTemporal['gen'];

            $renglon =
                '
                
                    <tr>
                        <!-- <td>' . $idRenglon . '</td> -->
                        <td>' . $talleS . '</td>
                        <td>' . $talleM . '</td>
                        <td>' . $talleL . '</td>
                        <td>' . $talleXL . '</td>
                        <td>' . $talleXXL . '</td>
                        <td>' . $color . '</td>
                        <td>' . $gen . '</td>
                        <td>
                        <form method="POST">
                            <input type="hidden" name="eliminarRenglon" value="' . $idRenglon . '">
                            <button data-bs-toggle="tooltip" title="borrar" data-bs-placement="top" data-bs-title="eliminar"  type="submit" style="border: none; background: none;">
                                <i class="fs-4 text-danger fa-solid fa-circle-xmark"></i>
                            </button>
                        </form>  
                        </td>
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

    public function borrarRenglonSession($idRenglon)
    {
        unset($this->ListaRenglones[$idRenglon - 1]);
        $this->ListaRenglones = array_values($this->ListaRenglones);
        $reorganizado = array();
        $i = 1;
        foreach ($this->ListaRenglones as $renglon) {
            $renglon['idRenglon'] = $i;
            $reorganizado[] = $renglon;
            $i++;
        }

        $this->ListaRenglones = $reorganizado;
        $this->idRenglonActual = $i;
    }
}
