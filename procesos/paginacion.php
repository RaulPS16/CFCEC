<?php

include_once("./dat/datcontabilidad.php");

class paginacion extends datContabilidad{

    private $paginaActual;
    private $totalPaginas;
    private $nResultados;
    private $resultadosPorPagina;
    private $indice;
    private $valoresConsulta;
    private $totalCR = 0;
	private $totalDB = 0;
	private $difConta = 0;
    private $url;

    function __construct($nPorPagina, $pValores){
        parent::__construct();

        $this->resultadosPorPagina = $nPorPagina;
        $this->indice = 0;
        $this->paginaActual = 1;
        $this->valoresConsulta = $pValores;

        $this->calcularPaginas();
    }

    function mostrar(){
        
        //$query = $this->connect()->prepare('SELECT * FROM pelicula LIMIT :pos, :n');    
        //$query->execute(['pos' => $this->indice, 'n' => $this->resultadosPorPagina]);
        $datosConsultados = $this->consultarFechaUsuario($this->valoresConsulta, $this->indice, $this->resultadosPorPagina);
        foreach ($datosConsultados as $key => $value) {
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
                $this->totalDB += $value["monto"];
            }elseif ($value["cr_db"] == "CR") {
                $this->totalCR += $value["monto"];
            }
        }
        if (!empty($_GET["totalCR"]) || !empty($_GET["totalDB"])) {
            $this->totalCR += $_GET["totalCR"];
            $this->totalDB += $_GET["totalDB"];
        }
        // muestra totales
        if ($this->totalPaginas == ($this->indice - 1)) {
            
            $this->difConta = $this->totalCR - $this->totalDB;
            ?>
                <tfoot class="text-center">
                    <td colspan="2" scope="row">CR: <?php print_r($this->totalCR)?></td>
                    <td colspan="2" scope="row">DB: <?php print_r($this->totalDB)?></td>
                    <td colspan="2" scope="row">Dif CR - DB: <?php print_r($this->difConta)?></td>
                </tfoot>
            <?php
        }else{
            // mueve los valores de $this->totalCR y $this->totalDB a la url para usarlo en la siguiente consulta
            $this->url = $this->url . "&totalCR=" . $this->totalCR . "&totalDB=" . $this->totalDB;
            ?>
                <tfoot class="text-center">
                    <td colspan="6" scope="row">Totales solo en la ultima pagina</td>
                </tfoot>
            <?php
        }
        

    }

    function calcularPaginas(){
        $queryTotalResultados = $this->consultarContador($this->valoresConsulta);
        //$queryTotalResultados = $this->connect()->query('SELECT COUNT(*) AS total FROM pelicula');
        $this->nResultados = $queryTotalResultados[0]["total"]; 
        $this->totalPaginas = $this->nResultados / $this->resultadosPorPagina;
        if(isset($_GET['pagina'])){
            $this->paginaActual = $_GET['pagina'];
            $this->indice = ($this->paginaActual - 1) * $this->resultadosPorPagina;
        }
    }

    function mostrarPaginas(){
        //fecha_contable=2022-07-30&id_usuario=604320137
        $this->url = $this->url . '&fecha_contable=' . $this->valoresConsulta["fecha_contable"] . '&id_usuario=' . $this->valoresConsulta["id_usuario"] . '';
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
    "fecha_contable" => "2022-07-30",
    "id_usuario" => 604320137,
    "indice" => 1,
    "resultadosPorPagina" => 2);
$paginacion = new paginacion(2,$valores);
$paginacion->mostrar();*/
?>