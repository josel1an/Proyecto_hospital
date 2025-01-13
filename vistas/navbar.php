<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="inicio.php">INICIO</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">


        <!-- NAVBAR DE EMPLEADOS, HORARIOS, DEPARTAMENTO y REPORTES -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Asistencia
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="asistencia.php">Registrar</a></li>
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Empleados
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="empleado_registrar.php">Registrar</a></li>
            <li><a class="dropdown-item" href="empleado_modificar.php">Modificar</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="empleado_elimina.php">Eliminar</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Turno
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="registrar_turno.php">Registrar</a></li>
            <li><a class="dropdown-item" href="modificar_turno.php">Modificar</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="eliminar_turno.php">Eliminar</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Departamento
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="registrar_departamento.php">Registrar</a></li>
            <li><a class="dropdown-item" href="modificar_departamento.php">Modificar</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="eliminar_departamento.php">Eliminar</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Reportes
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="cant_ho_tra_mes.php">Cantidad de Horas Trabajadas al mes de cada empleado</a></li>
            <li><a class="dropdown-item" href="em_turno_espe.php">Empleado por Turno en especifico</a></li>
            <li><a class="dropdown-item" href="em_depa.php">Empleado por Departamento</a></li>
            <li><a class="dropdown-item" href="em_depa_turno.php">Empleado por Departamento en un Turno</a></li>
            <li><a class="dropdown-item" href="em_de_turno_fecha.php">Empleado por Departamento en un turno y rango de Fecha</a></li>
          </ul>
        </li>
      </ul>
      

      <ul class="navbar-nav mb-2 mb-lg-0 d-flex ml-auto">
        
            <a class="nav-item link-danger nav-link ml-3 hover-danger" href="../controlador/controlador_singout.php">Desconectar</a>
        
    
</ul>
    </div>
  </div>
</nav>

