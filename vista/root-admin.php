<!-- 
***************
INCLUYO EL HEADER
***************
-->
<?php
  include_once "principal/header-nav.php";
?>
<!-- *************** -->


<!-- restringir que solo puede entrar si en la Sesion esta Logeado como Usuario ROOT o Admin -->
<!-- evitar que por inyeccion en URL poniendo la direccion /root-admin.php se pueda 
entrar, que sea necesario estar Logueado y como Usuario ROOT o Admin-->
<?php
    /* si us_rol=1 significa que es ROOT */
    if($_SESSION['us_rol']==1||$_SESSION['us_rol']==2){
?>

<main class="main"> 

    <h1>root-admin.php</h1>
    <h5>id_usuario: <?php echo $_SESSION['id_usuario']; ?></h5>
    <h5>usuario: <?php echo $_SESSION['usuario']; ?></h5>
    <h5>nombre: <?php echo $_SESSION['nombre']; ?></h5>
    <h5>apellidos: <?php echo $_SESSION['apellidos']; ?></h5>
    <h5>edad: <?php echo $_SESSION['edad']; ?></h5>
    <h5>dni: <?php echo $_SESSION['dni']; ?></h5>
    <h5>contraseña: <?php echo $_SESSION['contrasena']; ?></h5>
    <h5>rol: <?php echo $_SESSION['us_rol']; ?></h5>
    <h5>nivel padel: <?php echo $_SESSION['us_nivel']; ?></h5>

    <br><br>
    <button><a href="../controlador/Logout.php">Cerrar Sesion</a></button>

</main>


<?php
    }
?>


<!-- 
***************
INCLUYO EL FOOTER
***************
-->
<?php
  include_once "principal/footer.php";
?>
<!-- *************** -->