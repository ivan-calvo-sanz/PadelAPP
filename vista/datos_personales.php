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
                  <h1>Datos personales</h1>
                </div>
              </div>
            </div>
            <!-- /.container-fluid -->
          </section>

          <section>
            <div class="content">
              <div class="container-fluid">
                <div class="row">
                  <!-- *** DISTRIBUCION 1 COLUMNA IZQUIERDA *** -->
                  <!-- *** col-md-3 col=columna md=tamaño medio 3=que va a ocupar 3 columnas de las 12 que genera Bootstarp
                al utilizar la rejilla *** -->
                  <div class="col-md-3">
                    <!-- *** DENTRO 3 FILAS  *** -->
                    <!-- *** FILA DENTRO DE LA COLUMNA *** -->
                    <div class="card card-success card-outline">
                      <div class="card-body box-profile">
                        <div class="text-center">
                          <img id="avatar1" src="" class="profile-user-img img-fluid img-circle" />
                        </div>
                        <!-- Button trigger modal BOOTSTRAP cambiar Avatar -->
                        <div class="text-center mt-1">
                          <button
                            type="button"
                            class="btn btn-primary btn-sm"
                            data-toggle="modal"
                            data-target="#cambiophoto"
                          >
                            Cambiar avatar
                          </button>
                        </div>

                        <input id="id_usuario" type="hidden" value="<?php echo $_SESSION['id_usuario'] ?>" />
                        <h3 id="nombre_us" class="profile-username text-center text-success">xxxxx</h3>
                        <p id="apellidos_us" class="text-muted text-center">xxxxx</p>
                        <ul class="list-group list-group-unbordered mb-3">
                          <li class="list-group-item">
                            <b style="color: #0b7300">Edad</b><a id="edad" class="float-right">xx</a>
                          </li>
                          <li class="list-group-item">
                            <b style="color: #0b7300">DNI</b><a id="dni_us" class="float-right">xx</a>
                          </li>
                          <li class="list-group-item">
                            <b style="color: #0b7300">Rol Usuario</b>
                            <span id="us_rol" class="float-right">xxxxx</span>
                          </li>
                          <li class="list-group-item">
                            <b style="color: #0b7300">Nivel de Jugador</b>
                            <span id="nivel" class="float-right">xxxxx</span>
                          </li>

                          <!-- Button trigger modal BOOTSTRAP cambiar Contraseña -->
                          <button
                            type="button"
                            class="btn btn-block btn-outline-warning btn-sm"
                            data-toggle="modal"
                            data-target="#cambio-contra"
                          >
                            Cambiar contraseña
                          </button>
                        </ul>
                      </div>
                    </div>

                    <!-- *** FILA DENTRO DE LA COLUMNA *** -->
                    <div class="card card-success">
                      <div class="card-header">
                        <h3 class="card-title">Sobre mi</h3>
                      </div>
                      <div class="card-body">
                        <strong style="color: #0b7300"> <i class="fas fa-phone mr-1"></i>Telefono </strong>
                        <p id="telefono_us" class="text-muted">xxxxx</p>
                        <strong style="color: #0b7300"> <i class="fas fa-map-marker-alt mr-1"></i>Direccion </strong>
                        <p id="direccion_us" class="text-muted">xxxxx</p>
                        <strong style="color: #0b7300"> <i class="fas fa-at mr-1"></i>Email </strong>
                        <p id="email_us" class="text-muted">xxxxx</p>
                        <strong style="color: #0b7300"> <i class="fas fa-smile-wink mr-1"></i>Genero </strong>
                        <p id="genero_us" class="text-muted">xxxxx</p>
                        <strong style="color: #0b7300">
                          <i class="fas fa-pencil-alt mr-1"></i>Información adicional
                        </strong>
                        <p id="adicional_us" class="text-muted">xxxxx</p>
                        <button id="btn-editar" class="btn btn-block bg-gradient-danger">Editar</button>
                      </div>

                    </div>


                  </div>

                  <!-- *** DISTRIBUCION 1 COLUMNA DERECHA, OCUPA TODO EL ESPACIO DERECHO *** -->
                  <!-- *** col-md-9 col=columna md=tamaño medio 9=que va a ocupar 9 columnas de las 12 que genera Bootstarp
                al utilizar la rejilla *** -->
                  <div class="col-md-9">
                    <!-- *** CREO UN div en el cual dentro irá todo el formulario *** -->
                    <div class="card card-success">
                      <!-- *** FILA DENTRO DE LA COLUMNA *** -->
                      <div class="card-header">
                        <h3 class="card-title">Editar datos personales</h3>
                      </div>

                      <div class="card-body">
                        <!-- creo alert oculto lo gestiona JS cuando aparece -->
                        <div id="editado" style="display: none" class="alert alert-success text-center">
                          <span><i class="fas fa-check"></i> Editado</span>
                        </div>
                        <!-- creo alert oculto lo gestiona JS cuando aparece -->
                        <div id="no-editado" style="display: none" class="alert alert-danger text-center">
                          <span><i class="fas fa-times"></i> Para Editar tiene que pulsar en el botón "Editar"</span>
                        </div>
                        <form id="form-usuario" class="form-horizontal">
                          <!-- *** FILA DENTRO DE LA COLUMNA *** -->
                          <div class="form-group row">
                            <!-- *** col-sm-2 ocupa 2 columnas pequeñas de las 12 que genera Bootstarp *** -->
                            <label for="telefono" class="col-sm-2 col-form-label">Telefono</label>
                            <!-- *** col-sm-10 ocupa 10 columnas pequeñas de las 12 que genera Bootstarp *** -->
                            <div class="col-sm-10">
                              <input type="number" id="telefono" class="form-control" />
                            </div>
                          </div>
                          <!-- *** FILA DENTRO DE LA COLUMNA *** -->
                          <div class="form-group row">
                            <label for="residencia" class="col-sm-2 col-form-label">Residencia</label>
                            <div class="col-sm-10">
                              <input type="text" id="residencia" class="form-control" />
                            </div>
                          </div>
                          <!-- *** FILA DENTRO DE LA COLUMNA *** -->
                          <div class="form-group row">
                            <label for="correo" class="col-sm-2 col-form-label">Correo</label>
                            <div class="col-sm-10">
                              <input type="text" id="correo" class="form-control" />
                            </div>
                          </div>
                          <!-- *** FILA DENTRO DE LA COLUMNA *** -->
                          <div class="form-group row">
                            <label for="genero" class="col-sm-2 col-form-label">Genero</label>
                            <div class="col-sm-10">
                              <input type="text" id="sexo" class="form-control" />
                            </div>
                          </div>
                          <!-- *** FILA DENTRO DE LA COLUMNA *** -->
                          <div class="form-group row">
                            <label for="adicional" class="col-sm-2 col-form-label">Información adicional</label>
                            <div class="col-sm-10">
                              <textarea class="form-control" id="adicional" cols="30" rows="10"></textarea>
                            </div>
                          </div>
                          <!-- *** FILA DENTRO DE LA COLUMNA *** -->
                          <div class="form-group row">
                            <div class="offset-sm-2 col-sm-10 float-right">
                              <button type="submit" class="btn btn-block btn-outline-success">Guardar</button>
                            </div>
                          </div>
                        </form>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>

</main>


<?php
    }
?>


<!-- js -->
<script src="../js/datos_personales.js"></script>


<!-- INCLUYO EL FOOTER -->
<?php
  include_once "principal/footer.php";
?>