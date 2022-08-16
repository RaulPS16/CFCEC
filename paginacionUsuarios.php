<?php

include_once("datUsuarios.php");
include_once("datRoles.php");

class paginacionTransacciones extends datUsuarios{

    private $paginaActual;
    private $totalPaginas;
    private $nResultados;
    private $resultadosPorPagina;
    private $indice;
    private $url;
    private $urlModEstado;
    private $urlModRol;
    private $listaRoles;
    private $datRoles;
    private $id_usuarioURL = 0;
    private $id_usuarioForID = 0;

    function __construct($nPorPagina){
        parent::__construct();

        $this->resultadosPorPagina = $nPorPagina;
        $this->indice = 0;
        $this->paginaActual = 1;

        $this->datRoles = new datRoles();

        $this->calcularPaginas();
    }

    function mostrar(){
        
        //$query = $this->connect()->prepare('SELECT * FROM pelicula LIMIT :pos, :n');    
        //$query->execute(['pos' => $this->indice, 'n' => $this->resultadosPorPagina]);
        $datosConsultados = $this->consultaLista($this->indice, $this->resultadosPorPagina);
        foreach ($datosConsultados as $key => $value) {
            
            $this->listaRoles = $this->datRoles->consultaListaOrder($value['id_rol']);
            // arma la URL para luego hacer la modificación del estado
            $this->urlModEstado = "prcModUsuario.php?id_usuario=" . $value['id_usuario'] . "&btnEstado";
            $this->urlModRol = "prcModUsuario.php?id_usuario=" . $value['id_usuario'] . "&btnRol";
            $estado = 'Inactivo';
            $inactivar = FALSE;
            if ($value["estado"] == 1) {
                $estado = 'Activo';
                $inactivar = TRUE;
                $this->urlModEstado .= "&estado=2";
            }else {
                $this->urlModEstado .= "&estado=1";
            }
            $this->id_usuarioURL = "select_".$value['id_usuario'];
            $this->id_usuarioForID = "btnCambiarRol_".$value['id_usuario'];
            ?>
                <tr>
                    <th scope="row"><?php print_r($value["id_usuario"]);?></th>
                    <td><?php print_r($value["nombre"])?></td>
                    <td><?php print_r($value["descripcion"])?></td>
                    <td><?php print_r($value["fecha_ulti_ingreso"])?></td>
                    <td><?php print_r($estado)?></td>
                        <td><a type="submit" name="btnCambiarRol" class="btn btn-warning btn-md" id="<?php print_r($this->id_usuarioForID);?>" href="<?php echo $this->urlModRol;?>">Cambiar rol</a></td>
                    <?php
                    if ($inactivar) {
                        ?>
                            <td><a type="submit" name="btnInactivar" class="btn btn-warning btn-md" href="<?php echo $this->urlModEstado;?>">Inactivar</a></td>
                        <?php
                    }else {
                        ?>
                            <td><a type="submit" name="btnActivar" class="btn btn-warning btn-md" href="<?php echo $this->urlModEstado;?>">Activar</a></td>
                        <?php
                    }
                    ?>
                    <br>
                </tr>
            <?php
        }   

    }

    function calcularPaginas(){
        $queryTotalResultados = $this->consultarContador();
        //$queryTotalResultados = $this->connect()->query('SELECT COUNT(*) AS total FROM pelicula');
        $this->nResultados = $queryTotalResultados[0]["total"]; 
        $this->totalPaginas = $this->nResultados / $this->resultadosPorPagina;
        if(isset($_GET['pagina'])){
            $this->paginaActual = $_GET['pagina'];
            $this->indice = ($this->paginaActual - 1) * $this->resultadosPorPagina;
        }
        /*echo "<br> resultadosPorPagina=" .$this->resultadosPorPagina;
        echo "<br> paginaActual=" .$this->paginaActual;
        echo "<br> indice=" .$this->indice . "<br>";*/

    }

    function mostrarPaginas(){
        echo '<nav aria-label="Page navigation example">';
        echo '<ul class="pagination justify-content-center">';
        for($i=0; $i < $this->totalPaginas; $i++){
            if(($i + 1) == $this->paginaActual){
                $actual = ' active';
            }else{
                $actual = '';
            }
            echo '<li class="page-item ' . $actual . '"><a class="page-link"href="?pagina='. ($i + 1) . $this->url .'">'. ($i + 1) . '</a></li>';
        }
        echo '</ul>';
        echo '</nav>';

    }

    function mostrarTotalResultados(){
        return $this->nResultados;
    }
}
/*$valores = array(
    "fecha_trx" => "2022-08-07",
    "id_usuario" => "604320137",
    "indice" => 1,
    "resultadosPorPagina" => 2);
$paginacion = new paginacionTransacciones(2,$valores);
$paginacion->mostrar();*/
?>