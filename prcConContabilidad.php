<?php

    try{
        
        /**
		 * Se incluyen todos los dat necesarios
		 */
        include_once("datcontabilidad.php");
        include_once("datServicios.php");
        include_once("utilitarios.php");

        /**
		 * Se instancian las clases
		 */
        $datContabilidad = new datContabilidad();
        $datServicios = new datServicios();
        $utilitario = new utilitarios();

        /**
         * DATOS de ejemplo
         */
        $datosPantalla = array(
            "fecha_contable" => "2022-07-30",
            "id_usuario" => "604320137");

        $datosSQL = $datContabilidad->consultarFechaUsuario($datosPantalla, 1 , 4);
        /*$totalCR = 0;
        $totalDB = 0;
        $difConta = 0;
        ?>
            <table class="table table-striped">
            <thead  class="text-center">
                <tr>
                <th scope="col">Cuenta contable</th>
                <th scope="col">CR / DB</th>
                <th scope="col">Usuario</th>
                <th scope="col">Fehca</th>
                <th scope="col">Num Documento</th>
                <th scope="col">Monto</th>
                </tr>
            </thead>
            <tbody  class="text-center">
                <?Php
                    //Recorre toda la consulta para pintar la tabla
                    foreach ($datosSQL as $key => $value) {
                        ?>
                            <tr>
                            <th scope="row"><?php print_r($value["cuenta_contable"]);?></th>
                            <td><?php print_r($value["cr_db"])?></td>
                            <td><?php print_r($value["id_usuario"])?></td>
                            <td><?php print_r($value["fecha"])?></td>
                            <td><?php print_r($value["num_documento"])?></td>
                            <td>$<?php print_r($value["monto"])?></td>
                            </tr>
                        <?php
                        //Evalua si es un DB o CR para totalizarlos
                        if ($value["cr_db"] == "DB") {
                            $totalDB += $value["monto"];
                        }elseif ($value["cr_db"] == "CR") {
                            $totalCR += $value["monto"];
                        }
                    }
                // Saca la diferencia entre CR y DB
                $difConta = $totalCR - $totalDB;
                ?>

            </tbody>
            <tfoot class="text-center">
                <td colspan="2" scope="row">CR: <?php print_r($totalCR)?></td>
                <td colspan="2" scope="row">DB: <?php print_r($totalDB)?></td>
                <td colspan="2" scope="row">Dif CR - DB: <?php print_r($difConta)?></td>
            </tfoot>
            </table>

        <?Php*/

        $datosSQL = serialize($datosSQL);
        $datosSQL= urlencode($datosSQL);

        header("Location: conContabilidad.php?datosSQL=". $datosSQL);

    }catch (Exception $th) {
        header("Location: conContabilidad.php?datosSQL=0");
    }


?>