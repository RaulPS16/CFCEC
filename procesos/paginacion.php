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
        $actual = '';
        
        $actual = ' class="page-item" ';
        for($i=0; $i < $this->totalPaginas; $i++){
            /*if(($i + 1) == $this->paginaActual){
                $actual = ' class="page-item" ';
            }else{
                $actual = '';
            }*/
            echo '<li><a ' .$actual . 'href="?pagina='. ($i + 1). '">'. ($i + 1) . '</a></li>';
        }

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