<!-- restringir que solo puedan entrar en la Sesion si está Logeado como Usuario ROOT o Administrador -->
<!-- es decir evitar que por inyeccion en la URL poniendo la direccion /adm_catalogo.php se pueda entrar,
sino que sea necesario estar Logueado y como Usuario Administrador-->
<?php
    session_start();
    /* si us_rol=1 significa que es Administrador */
    /* si us_rol=2 significa que es ROOT */
    if($_SESSION['us_rol']==1||$_SESSION['us_rol']==2){
?>

  <!-- INCLUYO EL HEADER-NAV -->
  <?php
    include_once "layouts/header-nav.php";
  ?>


<!-- 
***************
INICIO CONTENIDO DE LA PAGINA
***************
-->

  <!-- CONTENEDOR PRINCIPAL -->
  <div class="content-wrapper">
    <!-- SECTION HEADER -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="titulo"><p><i class="fa-solid fa-house fa-lg"></i> HOME</p></h1>
          </div>
        </div>
      </div>
    </section>

    <!-- SECTION -->
    <section class="content">




    </section>
    
  </div>
  
<!-- 
***************
FIN CONTENIDO DE LA PAGINA
***************
-->

  <!-- INCLUYO EL FOOTER -->
  <?php
    include_once "layouts/footer.php";
  ?>
    

<!-- FIN LAYOUT AdminLTE -->
<?php
    }else{
        header('Location: ../index.php');
    }
?>

<!-- <script src="../js/home.js"></script> -->
