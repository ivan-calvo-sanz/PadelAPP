<!-- restringir que solo puedan entrar en la Sesion si está Logeado como Usuario ROOT o Administrador -->
<!-- es decir evitar que por inyeccion en la URL poniendo la direccion /adm_catalogo.php se pueda entrar,
sino que sea necesario estar Logueado y como Usuario Administrador-->
<?php
    session_start();
    /* si us_rol=3 significa que es Jugador */
    if($_SESSION['us_rol']==3){
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
                    <h3 class="card-title">Mi Próxima Reserva: <span id="miProximaReserva_reserva"> x </span></h3>
                    <h3 class="card-title der">
                      <span id="miProximaReserva_fecha"> xx/xx/xxxx </span>
                      <span id="miProximaReserva_hora"> xx:xx </span>
                      <span> Pista</span>
                      <span id="miProximaReserva_pista">x</span>
                    </h3>
                </div>


                    
                    <div class="card-body">

                        <div class="row">

                    <table class="table table-hover text-nowrap">
                        <thead class="table-success">
                            <tr>
                                <th id="miProximaReserva_usuario1">-</th>
                                <th id="miProximaReserva_usuario2">-</th>
                                <th id="miProximaReserva_usuario3">-</th>
                                <th id="miProximaReserva_usuario4">-</th>
                            </tr>
                        </thead>
                        <tbody class="table-warning" id="registros">
                            <tr>
                                <td>
                                  <img id="miProximaReserva_avatar1" src="../img/avatar_transparente.png" 
                                class="profile-user-img img-fluid img-circle"><br>
                                  <span id="miProximaReserva_nombre1"></span><br>
                                </td>
                                <td>
                                  <img id="miProximaReserva_avatar2" src="../img/avatar_transparente.png" 
                                class="profile-user-img img-fluid img-circle"><br>
                                  <span id="miProximaReserva_nombre2"></span><br>
                                </td>
                                <td>
                                  <img id="miProximaReserva_avatar3" src="../img/avatar_transparente.png" 
                                class="profile-user-img img-fluid img-circle"><br>
                                  <span id="miProximaReserva_nombre3"></span><br>
                                </td>
                                <td>
                                  <img id="miProximaReserva_avatar4" src="../img/avatar_transparente.png" 
                                class="profile-user-img img-fluid img-circle"><br>
                                  <span id="miProximaReserva_nombre4"></span><br>
                                </td>
                            </tr>
                            <tr>
                                <td id="miProximaReserva_nivel1">-</td>
                                <td id="miProximaReserva_nivel2">-</td>
                                <td id="miProximaReserva_nivel3">-</td>
                                <td id="miProximaReserva_nivel4">-</td>
                            </tr>
                            <tr>
                                <td id="miProximaReserva_tel1">-</td>
                                <td id="miProximaReserva_tel2">-</td>
                                <td id="miProximaReserva_tel3">-</td>
                                <td id="miProximaReserva_tel4">-</td>
                            </tr>

                        </tbody>
                    </table>

                          </div>

                    </div>

                </div>
            </div>
        </section>

        <section>
            <div class="container-fluid">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Mis Reservas</h3>

                    </div>
                    <div class="card-body">


                        <table id="tabla_reservas_jugador" class="display table table-hover text-nowrap" style="width:100%">
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
<script src="../js/home_jugador.js"></script>
