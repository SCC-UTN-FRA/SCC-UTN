<?php

class CabecerasRenglones
{
    //////////////////////////////////////////////////////////////
    /*Carga los renglones a la base de datos,
    en el campo "idPedido" trae el ultimo id registrado en la tabla pedidos
    y le suma uno para poder predecir el pedido que estas por cargar */
    public function cargarRenglones($conex,$idPed,$color,$talleS,$talleM,$talleL,$talleXL,$talleXXL,$gen)
    {
        $query = "INSERT INTO renglones (idPedido,color,s,m,l,xl,xxl,genero) VALUES
         ('$idPed','$color','$talleS','$talleM','$talleL','$talleXL','$talleXXL','$gen')";
        $resultado = mysqli_query($conex, $query);

        if (!$resultado) {
            die("Error al insertar valores: " . mysqli_error($conex));
        } 
        
        header("Location: index.php");
        exit();
    }

    //////////////////////////////////////////////////////////////
    /*Si no se cargo un pedido(osea que se arrepiente de intentar cargar un pedido), esta funcion debera eliminar todo 
    lo ingresado en la tabla "renglones" de la base de datos, para que no se mesclen en algun otro pedido futuro" */
    
    //public function borrarPedido($conex, $idPed)
    //{
    //    $queryElimina = "DELETE FROM renglones WHERE idPedido = $idPed";
    //    $resultado = mysqli_query($conex, $queryElimina);
//
    //    if (!$resultado) {
    //        die("Error al obtener datos de la tabla: " . mysqli_error($conex));
    //    }
    //}

    //////////////////////////////////////////////////////////////
    /*Trae toda la tabla renglones para mostrarla dentro de la tabla "curva de talles" que esta en index */
    public function imprimirRenglones($conex)
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
                        <td>'.$filaRenglon['color'].'</td>
                        <td>'.$filaRenglon['s'].'</td>
                        <td>'.$filaRenglon['m'].'</td>
                        <td>'.$filaRenglon['l'].'</td>
                        <td>'.$filaRenglon['xl'].'</td>
                        <td>'.$filaRenglon['xxl'].'</td>
                        <td>'.$filaRenglon['genero'].'</td>
                    </tr>
                ';

            echo $renglon;
        }
    }
    
    //////////////////////////////////////////////////////////////
    /*Trae toda la tabla "tipoGenero" y llena las option del selector de genero */
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
                    <option value='.$filaRenglon['Descripcion'].'>'.$filaRenglon['Descripcion'].'</option>
                ';
            echo $renglon;
        }
    }

     //////////////////////////////////////////////////////////////
    /*Trae toda la tabla "tipoGenero" y llena las option del selector de genero */
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
                    <option value='.$filaRenglon['color'].'>'.$filaRenglon['color'].'</option>
                ';
            echo $renglon;
        }
    }

}
