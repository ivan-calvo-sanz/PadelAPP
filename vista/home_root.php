<!-- INCLUYO EL HEADER -->
<?php
  include_once "principal/header-nav.php";
?>

<!-- restringir que solo puede entrar si en la Sesion esta Logeado como Usuario ROOT o Admin -->
<!-- evitar que por inyeccion en URL poniendo la direccion /root-admin.php se pueda 
entrar, que sea necesario estar Logueado y como Usuario ROOT o Admin-->
<?php
    /* si us_rol=1 significa que es ROOT */
    if($_SESSION['us_rol']==1||$_SESSION['us_rol']==2){
?>

<!-- INICIO CONTENIDO DE LA PAGINA -->
<main class="main">

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
          <!-- Content Header (Page header) -->
          <section class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <h1>Home</h1>
                </div>
              </div>
            </div>
            <!-- /.container-fluid -->
          </section>
        </div>

</main>

<?php
    }
?>


<!-- js -->
<!-- <script src="../js/datos_personales.js"></script> -->


<!-- INCLUYO EL FOOTER -->
<?php
  include_once "principal/footer.php";
?>