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
<link rel="stylesheet" href="../css/reservar_pista.css">
  

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
            <h1 class="titulo"><p><i class="fa-solid fa-table-tennis-paddle-ball fa-lg"></i>  Reservar Pista</p></h1>
          
            <!-- para saber que tipo de usuario ha iniciado sesion -->
            <!-- mediante un campo input oculto paso al JS el rol del usuario -->
            <input type="hidden" id="id_usuario" value="<?php echo $_SESSION['id_usuario'] ?>">  

            <!-- CREO BOTON "BORRAR RESERVA" -->
            <div >
              <button type="button" id="borrar_reserva" class="borrar btn btn-outline-danger mt-2">BORRAR RESERVA</button>
            </div>

            <!-- creo alert oculto lo gestiona JS cuando aparece -->
            <div id="span_pista_completa" style="display:none" class="alert alert-warning text-center">
                <span><i class="fas fa-check"></i>   La Pista está COMPLETA</span>
            </div>
            <!-- creo alert oculto lo gestiona JS cuando aparece -->
            <div id="span_pista_reservada" style="display:none" class="alert alert-success text-center">
                <span><i class="fas fa-times"></i>   Pista RESERVADA</span>
            </div>
            <!-- creo alert oculto lo gestiona JS cuando aparece -->
            <div id="span_existe_reserva" style="display:none" class="alert alert-warning text-center">
                <span><i class="fas fa-check"></i>   Ya tienes Pista reservada</span>
            </div>
            <!-- creo alert oculto lo gestiona JS cuando aparece -->
            <div id="span_no_tienes_reserva" style="display:none" class="alert alert-warning text-center">
                <span><i class="fas fa-check"></i>   NO tienes Pista reservada</span>
            </div>
            <!-- creo alert oculto lo gestiona JS cuando aparece -->
            <div id="span_reserva_borrada" style="display:none" class="alert alert-danger text-center">
                <span><i class="fas fa-check"></i>   Reserva BORRADA!</span>
            </div>
            <!-- creo alert oculto lo gestiona JS cuando aparece -->
            <div id="span_selecciona_hora" style="display:none" class="alert alert-warning text-center">
                <span><i class="fas fa-check"></i>   Selecciona hora</span>
            </div>
            </div>
            

          
        </div>
      </div>
    </section>

              

    <!-- SECTION -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <!-- *** DISTRIBUCION 1 COLUMNA IZQUIERDA *** -->
                <!-- *** col-md-2 col=columna md=tamaño medio 2=que va a ocupar 2 columnas de las 12 que genera Bootstarp
                al utilizar la rejilla *** -->
                <div class="col-md-2">
                    <!-- *** DENTRO 3 FILAS  *** -->
                    <!-- *** FILA DENTRO DE LA COLUMNA *** -->
                    <div class="card card-success card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img id="avatar1" src="../img/<?php echo $_SESSION['avatar']?>" 
                                class="profile-user-img img-fluid img-circle">
                            </div>
                            <h3 class="profile-username text-center text-success"><?php echo $_SESSION['nombre'] ?></h3>
                            <p class="text-muted text-center"><?php echo $_SESSION['apellidos'] ?></p>
         
                            <div class="card card-success">
                              <div class="card-header">
                                  <h3 class="card-title">Fecha</h3>
                              </div>
                            </div>

                            <div class="form-group row">
                                <button type="button" class="btn btn-block btn-outline-warning btn-sm col-sm-2" 
                            data-toggle="modal" data-target="#cambio-contra" id="<"><</button>
                                <!-- *** col-sm-8 ocupa 8 columnas pequeñas de las 12 que genera Bootstarp *** -->
                                <label for="telefono" class="col-sm-8 col-form-label text-center" id="fecha">xx/xx/xxxx</label>
                                <!-- *** col-sm-2 ocupa 2 columnas pequeñas de las 12 que genera Bootstarp *** -->
                            <button type="button" class="btn btn-block btn-outline-warning btn-sm col-sm-2" 
                            data-toggle="modal" data-target="#cambio-contra" id=">">></button>
                            </div>
                            <!-- Button "hora" -->
                            <button type="button" hora="10:00" class="btn btn-block btn-outline-warning btn-sm btn-hora">10:00 - 11:30</button>
                            <button type="button" hora="11:30" class="btn btn-block btn-outline-warning btn-sm btn-hora">11:30 - 13:00</button>
                            <button type="button" hora="16:00" class="btn btn-block btn-outline-warning btn-sm btn-hora">16:00 - 17:30</button>
                            <button type="button" hora="17:30" class="btn btn-block btn-outline-warning btn-sm btn-hora">17:30 - 19:00</button>
                            <button type="button" hora="19:00" class="btn btn-block btn-outline-warning btn-sm btn-hora">19:00 - 20:30</button>
                        </div>
                    </div>
                </div>

                <!-- *** DISTRIBUCION 1 COLUMNA A LA DERECHA *** -->
                <!-- *** col-md-3 col=columna md=tamaño medio 3=que va a ocupar 3 columnas de las 12 que genera Bootstarp
                al utilizar la rejilla *** -->
                <div class="col-md-3">
                    <div class="card card-success">
                        <!-- *** FILA DENTRO DE LA COLUMNA *** -->
                        <div class="card-header">
                            <h3 class="card-title">PISTA A</h3>
                        </div>
                        <div class="card bg-warning pt-2 pb-2 mt-1 mr-1 ml-1">
                            <h3 id="estado_pista_A" class="card-title text-center" estado_pista="seleccionar_hora">Seleccione hora</h3>
                        </div> 

                        <!-- PISTA DE PADEL -->
                        <div class="card-body"> 
                            <div class="text-center ">
                                <img id="avatar1" src="../img/avatar_transparente.png" 
                                class="avatarsA profile-user-img img-fluid img-circle">
                                <h3 id="nombre_us" reservado="no" class="jugadorNombreA profile-username text-center">xxxxx</h3> 
                            </div>
                            <div class="text-center ">
                                <img id="avatar1" src="../img/avatar_transparente.png" 
                                class="avatarsA profile-user-img img-fluid img-circle">
                                <h3 id="nombre_us" reservado="no" class="jugadorNombreA profile-username text-center">xxxxx</h3>
                            </div>
                            <div class="text-center ">
                                <img id="avatar1" src="../img/avatar_transparente.png" 
                                class="avatarsA profile-user-img img-fluid img-circle">
                                <h3 id="nombre_us" reservado="no" class="jugadorNombreA profile-username text-center">xxxxx</h3>
                            </div>
                            <div class="text-center ">
                                <img id="avatar1" src="../img/avatar_transparente.png" 
                                class="avatarsA profile-user-img img-fluid img-circle">
                                <h3 id="nombre_us" reservado="no" class="jugadorNombreA profile-username text-center">xxxxx</h3>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- *** DISTRIBUCION 1 COLUMNA A LA DERECHA *** -->
                <!-- *** col-md-3 col=columna md=tamaño medio 3=que va a ocupar 3 columnas de las 12 que genera Bootstarp
                al utilizar la rejilla *** -->
                <div class="col-md-3">
                    <div class="card card-success">
                        <!-- *** FILA DENTRO DE LA COLUMNA *** -->
                        <div class="card-header">
                            <h3 class="card-title">PISTA B</h3>
                        </div>
                        <div class="card bg-warning pt-2 pb-2 mt-1 mr-1 ml-1">
                            <h3 id="estado_pista_B" class="card-title text-center" estado_pista="seleccionar_hora">Seleccione hora</h3>
                        </div>  

                        <!-- PISTA DE PADEL -->
                        <div class="card-body">          
                            <div class="text-center ">
                                <img id="avatar1" src="../img/avatar_transparente.png" 
                                class="avatarsB profile-user-img img-fluid img-circle">
                                <h3 id="nombre_us" reservado="no" class="jugadorNombreB profile-username text-center">xxxxx</h3> 
                            </div>
                            <div class="text-center ">
                                <img id="avatar1" src="../img/avatar_transparente.png" 
                                class="avatarsB profile-user-img img-fluid img-circle">
                                <h3 id="nombre_us" reservado="no" class="jugadorNombreB profile-username text-center">xxxxx</h3>
                            </div>
                            <div class="text-center ">
                                <img id="avatar1" src="../img/avatar_transparente.png" 
                                class="avatarsB profile-user-img img-fluid img-circle">
                                <h3 id="nombre_us" reservado="no" class="jugadorNombreB profile-username text-center">xxxxx</h3>
                            </div>
                            <div class="text-center ">
                                <img id="avatar1" src="../img/avatar_transparente.png" 
                                class="avatarsB profile-user-img img-fluid img-circle">
                                <h3 id="nombre_us" reservado="no" class="jugadorNombreB profile-username text-center">xxxxx</h3>
                            </div>
                        </div>
                     
                    </div>
                </div>

                <!-- *** DISTRIBUCION 1 COLUMNA A LA DERECHA *** -->
                <!-- *** col-md-3 col=columna md=tamaño medio 3=que va a ocupar 3 columnas de las 12 que genera Bootstarp
                al utilizar la rejilla *** -->
                <div class="col-md-3">
                    <div class="card card-success">
                        <!-- *** FILA DENTRO DE LA COLUMNA *** -->
                        <div class="card-header">
                            <h3 class="card-title">PISTA C</h3>
                        </div>
                        <div class="card bg-warning pt-2 pb-2 mt-1 mr-1 ml-1">
                            <h3 id="estado_pista_C" class="card-title text-center" estado_pista="seleccionar_hora">Seleccione hora</h3>
                        </div>  

                        <!-- PISTA DE PADEL -->
                        <div class="card-body">            
                            <div class="text-center ">
                                <img id="avatar1" src="../img/avatars/avatar_transparente.png" 
                                class="avatarsC profile-user-img img-fluid img-circle">
                                <h3 id="nombre_us" reservado="no" class="jugadorNombreC profile-username text-center">xxxxx</h3> 
                            </div>
                            <div class="text-center ">
                                <img id="avatar1" src="../img/avatar_transparente.png" 
                                class="avatarsC profile-user-img img-fluid img-circle">
                                <h3 id="nombre_us" reservado="no" class="jugadorNombreC profile-username text-center">xxxxx</h3>
                            </div>
                            <div class="text-center ">
                                <img id="avatar1" src="../img/avatar_transparente.png" 
                                class="avatarsC profile-user-img img-fluid img-circle">
                                <h3 id="nombre_us" reservado="no" class="jugadorNombreC profile-username text-center">xxxxx</h3>
                            </div>
                            <div class="text-center ">
                                <img id="avatar1" src="../img/avatar_transparente.png" 
                                class="avatarsC profile-user-img img-fluid img-circle">
                                <h3 id="nombre_us" reservado="no" class="jugadorNombreC profile-username text-center">xxxxx</h3>
                            </div>
                        </div>
                            
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

<script src="../js/reservar_pista.js"></script>
