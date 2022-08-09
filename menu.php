<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="inicio.php"><span class="material-icons">home</span></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-12">
        <li class="nav-item dropdown"><!--Ini mantenimientos-->
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Mantenimientos
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="manClientes.php">Clientes</a></li>
            <li><a class="dropdown-item" href="manTarjetas.php">Tarjetas</a></li>
            <li><a class="dropdown-item" href="manCuentas.php">Cuentas</a></li>
            <li><a class="dropdown-item" href="manServicios.php">Servicios</a></li>
          </ul>
        </li> <!--Fin mantenimientos-->
        <li class="nav-item dropdown"><!--Ini transcciones-->
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Transacciones
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="traDeposito.php">Depositos</a></li>
            <li><a class="dropdown-item" href="traAvances.php">Avances de efectivo</a></li>
            <li><a class="dropdown-item" href="traReversion.php">Reversiones</a></li>
            <li><a class="dropdown-item" href="traPagoServicios.php">Pagos de servicios</a></li>
          </ul>
        </li> <!--Fin transacciones-->
        <li class="nav-item dropdown"><!--Ini contabilidad-->
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Contabilidad
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="conContabilidad.php">Consulta contable</a></li>
            <li><a class="dropdown-item" href="manParamContable.php">Administración de parametros</a></li>
          </ul>
        </li> <!--Fin contabilidad-->
        <li class="nav-item dropdown"><!--Ini Admin-->
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Administración
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">Usuarios</a></li>
            <li><a class="dropdown-item" href="#">Roles</a></li>
            <li><a class="dropdown-item" href="#">Menus</a></li>
          </ul>
        </li> <!--Fin Admin-->
        <li class="nav-item">
          <a class="nav-link" href="manualUsuario.php">Manual de usuario</a>
        </li>
      </ul>
      <ul class="navbar-nav justify-content-end derecha">
        <li class="nav-item dropdown"><!--Ini Admin-->
          <a class="nav-link " href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <span class="material-icons">account_circle</span>
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item text-end" href="cambioClave.php">Cambio Clave</a></li>
            <li><a class="dropdown-item text-end" href="index.php">Desconectarse</a></li>
          </ul>
        </li> <!--Fin Admin-->
      </ul>
    </div>
  </div>
</nav>
