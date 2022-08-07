<?php

include_once("datTransacciones.php");

class paginacionTransacciones extends datTransacciones{

    private $paginaActual;
    private $totalPaginas;
    private $nResultados;
    private $resultadosPorPagina;
    private $indice;
    private $valoresConsulta;
    private $url;
    private $urlReversion;

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
        $datosConsultados = $this->consulTrxUsuarioXFecha($this->valoresConsulta, $this->indice, $this->resultadosPorPagina);
        foreach ($datosConsultados as $key => $value) {
            // arma la URL para luego hacer la reversión
            $fecha = substr($value["fecha_trx"],0,10);
            $this->urlReversion = "procesos/prcReversion.php?id_usuario=" . $value['id_usuario'] . 
            "&fecha_trx=" . $fecha . 
            "&num_documento=" . $value["num_documento"] ;
            ?>
                <tr>
                    <th scope="row"><?php print_r($value["fecha_trx"]);?></th>
                    <td><?php print_r($value["id_tarjeta"])?></td>
                    <td><?php print_r($value["id_cuenta"])?></td>
                    <td><?php print_r($value["id_servicio"])?></td>
                    <td><?php print_r($value["num_documento"])?></td>
                    <td>$<?php print_r($value["monto"])?></td>
                    <td><?php print_r($value["detalle_trx"])?></td>
                    <td><a type="submit" name="btnReversar" class="btn btn-warning btn-md" href="<?php echo $this->urlReversion;?>">Reversar</a></td>
                    <br>
                </tr>
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
        /*echo "<br> resultadosPorPagina=" .$this->resultadosPorPagina;
        echo "<br> paginaActual=" .$this->paginaActual;
        echo "<br> indice=" .$this->indice . "<br>";
        print_r($this->valoresConsulta);
        echo "<br>";*/


    }

    function mostrarPaginas(){
        //fecha_contable=2022-07-30&id_usuario=604320137
        $this->url = $this->url . '&fecha_trx=' . $this->valoresConsulta["fecha_trx"] . '&id_usuario=' . $this->valoresConsulta["id_usuario"] . '';
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