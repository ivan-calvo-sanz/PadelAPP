<!-- restringir que solo puedan entrar en la Sesion si está Logeado como Usuario ROOT o Administrador -->
<!-- es decir evitar que por inyeccion en la URL poniendo la direccion /adm_catalogo.php se pueda entrar,
sino que sea necesario estar Logueado y como Usuario Administrador-->
<?php
    session_start();
    /* si us_rol=1 significa que es ROOT */
    /* si us_rol=2 significa que es Administrador */
    if($_SESSION['us_rol']==1||$_SESSION['us_rol']==2){
?>

  <!-- INCLUYO EL HEADER-NAV -->
  <?php
    include_once "layouts/header-nav.php";
  ?>

  <!-- Theme style -->
  <link rel="stylesheet" href="../css/home.css">


<!-- 
***************
INICIO CONTENIDO DE LA PAGINA
***************
-->

<!-- MODAL VISTA RESERVA -->
<div class="modal fade" id="vista_reserva" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Detalles Reserva: <span id="reserva"> x </span></h3>
                    <h3 class="card-title der">
                      <span id="fecha"> xx/xx/xxxx </span>
                      <span id="hora"> xx:xx </span>
                      <span> Pista</span>
                      <span id="pista">x</span>
                      <button data-dismiss="modal" aria-label="close" class="close">
                        <span aria-hidden="tue">&times;</span>
                      </button>
                    </h3>
                </div>
                <div class="card-body">

                    <table class="table table-hover text-nowrap">
                        <thead class="table-success">
                            <tr>
                                <th id="usuario1">-</th>
                                <th id="usuario2">-</th>
                                <th id="usuario3">-</th>
                                <th id="usuario4">-</th>
                            </tr>
                        </thead>
                        <tbody class="table-warning" id="registros">
                            <tr>
                                <td>
                                  <img id="avatar1" src="../img/avatar_transparente.png" 
                                class="profile-user-img img-fluid img-circle"><br>
                                  <span id="nombre1"></span><br>
                                  <span id="reserva1">Vacio</span><br>
                                </td>
                                <td>
                                  <img id="avatar2" src="../img/avatar_transparente.png" 
                                class="profile-user-img img-fluid img-circle"><br>
                                  <span id="nombre2"></span><br>
                                  <span id="reserva2">Vacio</span><br>
                                </td>
                                <td>
                                  <img id="avatar3" src="../img/avatar_transparente.png" 
                                class="profile-user-img img-fluid img-circle"><br>
                                  <span id="nombre3"></span><br>
                                  <span id="reserva3">Vacio</span><br>
                                </td>
                                <td>
                                  <img id="avatar4" src="../img/avatar_transparente.png" 
                                class="profile-user-img img-fluid img-circle"><br>
                                  <span id="nombre4"></span><br>
                                  <span id="reserva4">Vacio</span><br>
                                </td>
                            </tr>
                            <tr>
                                <td id="nivel1">-</td>
                                <td id="nivel2">-</td>
                                <td id="nivel3">-</td>
                                <td id="nivel4">-</td>
                            </tr>
                            <tr>
                                <td id="rol1">-</td>
                                <td id="rol2">-</td>
                                <td id="rol3">-</td>
                                <td id="rol4">-</td>
                            </tr>
                            <tr>
                                <td id="email1">-</td>
                                <td id="email2">-</td>
                                <td id="email3">-</td>
                                <td id="email4">-</td>
                            </tr>
                            <tr>
                                <td id="tel1">-</td>
                                <td id="tel2">-</td>
                                <td id="tel3">-</td>
                                <td id="tel4">-</td>
                            </tr>

                        </tbody>
                    </table>

                </div>
                <div class="card-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-outline-secondary float-right m-1">Close</button>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL BOOTSTRAP BORRAR RESERVA -->
<div class="modal fade" id="eliminar_reserva" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Eliminar reserva <span id="reserva_2"></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div id="no-update">
            <button id="eliminarReserva" class="btn btn-danger" type="button">
              <i class="fas fa-times"></i>   Eliminar reserva del
              </span class="card-title der">
                <span id="fecha_2"> xx/xx/xxxx </span>
                <span id="hora_2"> xx:xx </span>
                <span id="pista_2">x</span>
              </span>
          </button>
        </div>

        <!-- creo alert oculto lo gestiona JS cuando aparece -->
        <br>
        <div id="alert_reserva_borrada" style="display:none" class="alert alert-success text-center">
            <span><i class="fas fa-check"></i>   Reserva borrada</span>
        </div>

      </div>

    </div>
  </div>
</div>



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

            <!-- SECTION PRIMERA FILA -->
            <section>
            <div class="container-fluid">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Resumen Pistas</h3>
                    </div>
                    <div class="card-body">

                        <div class="row">
                          <!-- CAJA -->
                            <div class="col-lg-3 col-6">
                                <div class="small-box bg-info">
                                  <a href="#" class="small-box-footer">HOY</a>
                                  <div class="inner">
                                      <div><p>PISTAS COMPLETAS<span class="datos" id="pistas_completas_hoy">0/3</span></p></div>
                                      <div><p>PISTAS ABIERTAS<span class="datos" id="pistas_abiertas_hoy">0/15</span></p></div>
                                      <div><p>PLAZAS LIBRES<span class="datos" id="plazas_libres_hoy">60/60</span></p></div>
                                  </div>
                                </div>
                            </div>
                            <!-- CAJA -->
                            <div class="col-lg-3 col-6">
                                <div class="small-box bg-success">
                                  <a href="#" class="small-box-footer">MAÑANA</a>
                                  <div class="inner">
                                      <div><p>PISTAS COMPLETAS<span class="datos" id="pistas_completas_mañana">0/3</span></p></div>
                                      <div><p>PISTAS ABIERTAS<span class="datos" id="pistas_abiertas_mañana">0/15</span></p></div>
                                      <div><p>PLAZAS LIBRES<span class="datos" id="plazas_libres_mañana">60/60</span></p></div>
                                  </div>
                                </div>
                            </div>
                            <!-- CAJA -->
                            <div class="col-lg-6 col-6">
                                <div class="small-box bg-warning">
                                  <p class="small-box-footer">TOTALES AÑO</p>
                                  <div class="small-box bg-warning pasadas inner">
                                    <div>
                                      <p class="small-box-footer">PASADAS:</p>
                                      <h3 id="pistas_reservadas_pasadas">0</h3>
                                      <p>Pistas Completas Reservadas</p>
                                    </div>
                                  </div>
                                  <div class="small-box bg-warning futuras inner">
                                    <div>
                                      <p class="small-box-footer">FUTURAS:</p>
                                      <h3 id="pistas_reservadas_futuras">0</h3>
                                      <p>Pistas Completas Reservadas</p>
                                    </div>
                                  </div>
                                </div>
                            </div>

                          </div>

                    </div>

                </div>
            </div>
        </section>

        <section>
            <div class="container-fluid">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Buscar Reservas</h3>

                    </div>
                    <div class="card-body">


                        <table id="tabla_reservas" class="display table table-hover text-nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Reserva</th>
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                    <th>Pista</th>
                                    <th>Jugador</th>
                                    <th>Nombre Apellidos</th>
                                    <th>Teléfono</th>
                                    <th>email</th>
                                    <th>Accion</th>

                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>


                    </div>
                    <div class="card-footer">

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
<script src="../js/datatables.js"></script>
<script src="../js/home_root.js"></script>
