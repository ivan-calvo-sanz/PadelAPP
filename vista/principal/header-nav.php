<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&family=Raleway:wght@400;700&display=swap"
      rel="stylesheet"
    />
    

     <!-- RemixIcon (ICONOS) -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">

    <!-- Hojas de estilo -->
    <link rel="stylesheet" type="text/css" href="../css/principal.css" />

    <!-- jQuery -->
<script src="../js/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../js/bootstrap/bootstrap.bundle.min.js"></script>


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
                <a href="#" ><img src="../img/icono.png" alt="" class="logo"><span class="logo-span">PadelAPP</span></a>
            </div>
            <div id="header-span" class="barra-busqueda">
                <span>Inicio</span>
            </div>
            <div class="botones-usuario">
                <span class="logo-span"><?php echo $_SESSION['nombre'].' '.$_SESSION['apellidos']; ?></span>
                <button class="button-cerrar"><a href="../controlador/Logout.php">Cerrar Sesion</a></button>
                <a href="#" class="avatar"><img src="../img/avatar.jpg" alt=""></a>
            </div>
        </header>
        
        <nav class="menu-lateral" id="menu-lateral">
            
            <a href="#" class="enlace active"><i class="icono ri-tools-line"></i>Inicio</a>
            <a href="#" class="enlace"><i class="icono ri-tools-line"></i>aaa</a>
            <a href="#" class="enlace"><i class="icono ri-tools-line"></i>bbb</a>

            <hr>

            <a href="#" class="enlace"><i class="icono ri-tools-line"></i>ccc</a>
            <a href="#" class="enlace"><i class="icono ri-tools-line"></i>ddd</a>
            <a href="#" class="enlace"><i class="icono ri-tools-line"></i>eee</a>

            <hr>

            <a href="#" class="enlace"><i class="icono ri-tools-line"></i>fff</a>
            <a href="#" class="enlace"><i class="icono ri-tools-line"></i>ggg</a>
            <a href="#" class="enlace"><i class="icono ri-tools-line"></i>hhh</a>

        </nav>

<?php
    }
?>

