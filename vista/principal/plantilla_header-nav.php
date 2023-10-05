<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Página Principal</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&family=Raleway:wght@400;700&display=swap"
      rel="stylesheet"
    />

    <!-- RemixIcon (ICONOS) -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet" />

    <!-- Bootstrap -->
    <!-- <link rel="stylesheet" href="../bootstrap-5.3.2/css/bootstrap.min.css" /> -->
    <link rel="stylesheet" href="../css/cssAdminLTE/adminlte.min.css" />

    <!-- Hojas de estilo -->
    <link rel="stylesheet" type="text/css" href="../css/plantilla.css" />
  
  
    <!-- restringir que solo puede entrar si en la Sesion esta Logeado -->
    <!-- evitar que por inyeccion en URL poniendo la direccion /vista/principal/header-nav.php se pueda 
    entrar, que sea necesario estar Logueado -->
    <?php
        session_start();

        if($_SESSION['us_rol']==1||$_SESSION['us_rol']==2||$_SESSION['us_rol']==3){

        $nombre=$_SESSION['nombre'];
        $apellidos=$_SESSION['apellidos'];

    ?>
  
  
  </head>
  <body>
    <div class="contenedor active" id="contenedor">
      <header class="header">
        <div class="contenedor-logo">
          <button id="boton-menu" class="boton-menu active"><i class="ri-menu-line"></i></button>
          <a href="#"><img src="../img/icono.png" alt="" class="logo" /><span class="logo-span">PadelAPP</span></a>
        </div>
        <div id="header-span" class="barra-busqueda">
          <span class="avatar"><img src="../img/avatar.jpg" alt="" /></span>
          <span>Iván Calvo</span>
        </div>
        <div class="botones-usuario">
          <button class="button-cerrar btn bg-gradient-danger"><a href="../controlador/Logout.php">Cerrar Sesion</a></button>
        </div>
      </header>

      <nav class="menu-lateral" id="menu-lateral">
        <a href="#" class="enlace active"><i class="icono ri-tools-line"></i>Datos personales</a>
        <a href="#" class="enlace"><i class="icono ri-tools-line"></i>aaa</a>
        <a href="#" class="enlace"><i class="icono ri-tools-line"></i>bbb</a>

        <hr />

        <a href="#" class="enlace"><i class="icono ri-tools-line"></i>ccc</a>
        <a href="#" class="enlace"><i class="icono ri-tools-line"></i>ddd</a>
        <a href="#" class="enlace"><i class="icono ri-tools-line"></i>eee</a>

        <hr />

        <a href="#" class="enlace"><i class="icono ri-tools-line"></i>fff</a>
        <a href="#" class="enlace"><i class="icono ri-tools-line"></i>ggg</a>
        <a href="#" class="enlace"><i class="icono ri-tools-line"></i>hhh</a>
      </nav>

<?php
    }
?>
 