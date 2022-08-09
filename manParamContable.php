<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstap 5.1v -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

        <!-- Google icons -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
        rel="stylesheet">
        <!-- Estilos personales -->
        <link rel="stylesheet" type="text/css" href="css/estilos-propios.css">
        
        <title>Mantenimiento de clientes</title>
    </head>
    <body>

        <?php
        include("menu.php");
        include_once("muestraErrores.php");
        $serviciosDif = null;
        $retornoDatos = array("id" => "",
            "cuenta_contable" => "", 
            "descripcion" => "",
            "fecha_creacion" => "",
            "estado" => "",
            "id_servicio" => "", 
            "cr_db" => "");
            
        $fechaActual = date("Y-m-d");
        include_once("datServicios.php");
        $datServicios = new datServicios();
        $listaServicios = $datServicios->consultaLista();
        
        if (isset($_GET['error']) ) {
            $muestraErrores = new muestraErrores($_GET['error']);
        }

        if (isset($_GET['datosSQL'])) {
            $retornoDatos = unserialize($_GET['datosSQL']);
            $serviciosDif = $datServicios->consultaListaOrder($retornoDatos);
        }
        
        ?>
        <div class="container mant">

            <h2 class="text-center titulos">Mantenimiento de parametros contables</h2>
            
            <form action="prcParam_contable.php" method="POST" class="needs-validation row" novalidate>
            
                <div class="col-md-4">
                    <div class="has-validation form-floating">
                        <input type="text" name="cuenta_contable" class="form-control" id="cuenta_contable" placeholder="211" value="<?php echo($retornoDatos['cuenta_contable']) ?>"  required>
                        <label for="cuenta_contable">Cuenta contable</label>
                        <div class="invalid-feedback">
                            Ingrese una cuenta contable
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="has-validation form-floating">
                        <select class="form-select" name="id_servicio" id="id_servicio" required>
                            <?php
                                if ($retornoDatos['id_servicio'] == '') {
                                    foreach ($listaServicios as  $fila) {
                                        print_r ("<option value='" . $fila['id_servicio'] . "'>" . $fila['nombre_servicio'] . "</option>");
                                    }
                                }else{
                                    foreach ($serviciosDif as  $fila) {
                                        print_r ("<option value='" . $fila['id_servicio'] . "'>" . $fila['nombre_servicio'] . "</option>");
                                    }
                                }

                                
                            ?>
                        </select>
                        <label for="id_servicio">Servicio a pagar</label>
                        <div class="invalid-feedback">
                            Ingrese un servicio
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class=" form-floating">
                        <select class="form-select" name="cr_db" id="cr_db" >
                            <option value="<?php echo($retornoDatos['cr_db']) ?>"><?php echo($retornoDatos['cr_db']) ?></option>
                            <option value="CR">Credito</option>
                            <option value="DB">Debito</option>
                        </select>
                        <label for="cr_db">CR / DB</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class=" form-floating">
                        <select class="form-select" name="estado" id="estado" >
                            <option value="<?php echo($retornoDatos['estado']) ?>"><?php echo($retornoDatos['estado']) ?></option>
                            <option value="1" selected>Activo</option>
                            <option value="2">Inactivo</option>
                        </select>
                        <label for="estado">Estado</label>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="has-validation form-floating">
                        <input type="text" name="descripcion" class="form-control" id="descripcion" placeholder="211" value="<?php echo($retornoDatos['descripcion']) ?>" maxlength="50" >
                        <label for="descripcion">Descipción de la cuenta</label>
                        <div class="invalid-feedback">
                            Ingrese una descipción
                        </div>
                    </div>
                </div>
                <input type="text" name="id" class="form-control visually-hidden" id="id" placeholder="1" value="<?php echo($retornoDatos['id']) ?>" maxlength="50" >
                <div class="col-md-12">
                    <br>
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <input type="submit" name="btnParamContable" class="btn btn-light btn-lg" value="Eliminar">
                    <input type="submit" name="btnParamContable" class="btn btn-warning btn-lg" value="Modificar">
                    <input type="submit" name="btnParamContable" class="btn btn-secondary btn-lg" value="Insertar">
                    <input type="submit" name="btnParamContable" class="btn btn-primary btn-lg" value="Consultar">
                </div>
            
            </form>

        </div>

        <script type="text/javascript" src="js/validaForms.js"></script>

        <?php 
            include("footer.html")
        ?>
    </body>
</html>