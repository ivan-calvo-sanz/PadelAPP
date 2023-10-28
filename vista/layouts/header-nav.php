 <!-- 
***************
INICIO LAYOUT AdminLTE
***************
-->

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Padel APP</title>
 
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome (ICONOS) -->
  <link rel="stylesheet" href="../css/cssFont_Awesome/all.min.css">
    <!-- CSS PARTICULARES -->
  <link rel="stylesheet" href="../css/header-nav.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../css/cssAdminLTE/adminlte.min.css">


</head>
<body class="hold-transition sidebar-mini">

<!-- CAMPOS OCULTOS PARA PASAR AL JS -->
<input id="avatarSession" type="hidden" value="<?php echo $_SESSION['avatar']?>">

<!-- HEADER -->
<div class="wrapper">
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Zona izquierdo -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a id="boton-menu" class="nav-link btn-menu active" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="rol nav-item d-none d-sm-inline-block">
        <span  class="nav-link"><?php echo $_SESSION['nombre_user']; ?></span> 
      </li>
    </ul>

    <!-- Zona Derecho -->
    <ul class="navbar-nav ml-auto">
      <button id="btn-cerrar" class="btn btn-block bg-gradient-danger">Cerrar Sesion</button>
    </ul>
  </nav>

  <!-- MENU -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    
    <!-- Logotipo -->
    <a href="home_root.php" class="brand-link">
      <img  src="../img/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Padel APP</span>
    </a>

    <!-- Avatar Usuario -->
    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <!-- ../img/avatarDefault.png -->
          <img id="avatar" src="#" class="profile-user-img img-file img-circle">
        </div>
        <div id="enlace0" class="info">
          <a href="datos_personales.php" class="d-block">
            <span><?php echo $_SESSION['nombre']." ". $_SESSION['apellidos']; ?>  </span>
        </a>
        </div>
      </div>

      <!-- Enlaces Menus Home Contacto -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
         <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="home_root.php" id="enlace1" class="nav-link">
              <i class="fa-solid fa-house fa-lg"></i>
              <p>HOME</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="contacto.php" id="enlace2" class="nav-link">
              <i class="fa-solid fa-circle-info fa-lg"></i>
              <p>CONTACTO</p>
            </a>
          </li> 
         </ul>
      </div>

      <!-- Enlaces Menus -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-header">USUARIO</li> 
          <li class="nav-item">
            <a href="datos_personales.php" id="enlace3" class="nav-link">
              <i class="fa-solid fa-user fa-lg"></i>
              <p>
                 Datos personales
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="gestionar_usuarios.php" id="enlace4" class="nav-link">
              <i class="fa-solid fa-users fa-lg"></i>
              <p>
                Gestionar Usuarios
              </p>
            </a>
          </li>
          <li class="nav-header">PARTIDOS</li> 
          <li class="nav-item">
            <a href="reservar_pista.php" id="enlace5" class="nav-link">
              <i class="fa-solid fa-table-tennis-paddle-ball fa-lg"></i>
              <p>
                Reservar Pista
              </p>
            </a>
          </li>
         
        </ul>
      </nav>

    </div>
  </aside>

<!-- jQuery -->
<script src="../js/jquery/jquery.min.js"></script>
<script src="../js/header-nav.js"></script>