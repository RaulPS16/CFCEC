<?php

include_once("datMenu.php");

class menu{

    private $datMenu;
    private $rol;

    function __construct($pRol){
        $this->datMenu = new datMenu();
        $this->rol = $pRol;
        $this->construyeMenu();
    }

    function construyeMenu(){
        ?>
        
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="inicio.php"><span class="material-icons">home</span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-12">
                <?php
                //Consulta los titulos del menu
                $titulos = $this->datMenu->consultarTitulos($this->rol);
                //Recorre los titulos si hay
                foreach ($titulos as $key => $value) {
                    if ($value['url'] <> '') {
                        ?>
                        <li class="nav-item"><a class="nav-link" href="<?php print_r($value['url']);?>"><?php print_r($value['titulo']);?></a></li>
                    <?php
                    }else{
                        ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php print_r($value['titulo']); ?>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <?php
                                $subTitulos = $this->datMenu->consultarSubTitulos($value['titulo']);
                                foreach ($subTitulos as $col => $valor) {
                                    ?>
                        <li><a class="dropdown-item" href="<?php print_r($valor['url']);?>"><?php print_r($valor['sub_titulo']);?></a></li>
                                    <?php
                                }
                                ?>
                    </ul>
                </li>
                        <?php
                    }
                    
                }

                ?>
            </ul>
            <ul class="navbar-nav justify-content-end derecha">
                <li class="nav-item dropdown"><!--Ini Admin-->
                <a class="nav-link " href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="material-icons">account_circle</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item text-end" href="cambioClave.php">Cambio Clave</a></li>
                    <li><a class="dropdown-item text-end" href="desconexion.php">Desconectarse</a></li>
                </ul>
                </li> <!--Fin Admin-->
            </ul>
        </div>
    </div>
</nav>
        <?php

    }
}

?>
