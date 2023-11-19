<!-- restringir que solo puedan entrar en la Sesion si está Logeado como Usuario ROOT, Administrador o Jugador -->
<!-- es decir evitar que por inyeccion en la URL poniendo la direccion /adm_catalogo.php se pueda entrar,
sino que sea necesario estar Logueado y como Usuario Administrador-->
<?php
    session_start();
    /* si us_rol=1 significa que es Administrador */
    /* si us_rol=2 significa que es ROOT */
    /* si us_rol=3 significa que es Jugador */
    if($_SESSION['us_rol']==1||$_SESSION['us_rol']==2||$_SESSION['us_rol']==3){
?>

  <!-- INCLUYO EL HEADER-NAV -->
  <?php
    include_once "layouts/header-nav.php";
  ?>

<!-- Theme style -->
<link rel="stylesheet" href="../css/contacto.css">


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
            <h1 class="titulo"><p><i class="fa-solid fa-circle-info fa-lg"></i> Contacto</p></h1>
          </div>
        </div>
      </div>
    </section>
    

    <!-- SECTION ENVIAR EMAIL -->
    <section class="content">
    <div class="contact-area">
        <div class="row">
          <div class="col-md-5">
            <div class="contact-form">

              <form>
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Nombre">
                </div>
                <div class="form-group">
                  <input type="email" class="form-control" placeholder="Email">
                </div>
                <div class="form-group">
                  <textarea class="form-control" cols="15" rows="7" placeholder="Mensaje"></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Enviar</button>
              </form>

            </div>
          </div>

          <div class="col-md-5">
            <div class="map-area">
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d190642.78641687523!2d-
              4.973274919829559!3d41.70339255317876!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd
              47728c08c66e93%3A0xb3ff92d41ca26bef!2sValladolid!5e0!3m2!1ses!2ses!4v1698603100805!5m2!1ses!
              2ses" allowfullscreen="" loading="lazy"></iframe>
            </div>
          </div>
        

        </div>
      </div>
    </section> 

    <!-- SECTION DATOS EMPRESA -->
        <section class="content">
    <div class="contact-area">
        <div class="row">
          <div class="col-md-10">
            <div class="contact-logos">
          
              <a href="https://www.linkedin.com/" target="_blank"><i class="fa-brands fa-linkedin fa-2xl"></i></a>
              <a href="https://twitter.com/?lang=es" target="_blank"><i class="fa-brands fa-twitter fa-2xl"></i></a>
              <a href="https://www.facebook.com/?locale=es_ES" target="_blank"><i class="fa-brands fa-square-facebook fa-2xl"></i></a>
              <a href="https://www.instagram.com/" target="_blank"><i class="fa-brands fa-square-instagram fa-2xl"></i></a>

            </div>
          </div>
        </div>
    </div>
    </section> 

    <section class="content">
    <div class="contact-area">
        <div class="row">
          <div class="col-md-10">
            <div class="contact-info">
              
              <p>C/ Cobalto Nº1</p>
              <p>Poligono San Cristobal, Valladolid</p>
              <p>Tel: 618 45 78 58</p>
              <p><i>padelapp@gmail.com</i></p>

            </div>
          </div>
        </div>
    </div>
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

<!-- <script src="../js/contacto.js"></script> -->
