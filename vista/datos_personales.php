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

<!-- CAMPOS OCULTOS PARA PASAR AL JS -->
<input id="avatarSession" type="hidden" value="<?php echo $_SESSION['avatar']?>">

<!-- Modal BOOTSTRAP Cambio Contraseña -->
<div class="modal fade" id="cambio-contra" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cambiar contraseña</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="text-center">
            <!-- ../img/avatarDefault.png -->
            <img id="avatar" src="#" class="avatar profile-user-img img-file img-circle">
        </div>
        <div class="text-center"><b>
            <?php echo $_SESSION['nombre_user']; ?>
        </b></div>

        <!-- creo alert oculto lo gestiona JS cuando aparece -->
        <div id="update" style="display:none" class="alert alert-success text-center">
            <span><i class="fas fa-check"></i>   Contraseña modificada</span>
        </div>
        <!-- creo alert oculto lo gestiona JS cuando aparece -->
        <div id="no-update" style="display:none" class="alert alert-danger text-center">
            <span><i class="fas fa-times"></i>   La contraseña NO es correcta</span>
        </div>

        <form action="" id="form-pass">
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-unlock-alt"></i></span>
                <input id="old-pass" type="password" class="form-control" placeholder="Contraseña actual">
            </div>
            <div class="input-group mt-3">
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                <input id="new-pass" type="text" class="form-control" placeholder="Nueva contraseña">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn bg-gradient-primary">Guardar</button>
            </div>
      </form>
      </div>

    </div>
  </div>
</div>

<!-- Modal BOOTSTRAP Cambio Avatar -->
<div class="modal fade" id="cambiarAvatar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cambiar avatar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="text-center">
            <!-- ../img/avatarDefault.png -->
            <img id="avatar" src="#" class="avatar profile-user-img img-file img-circle">
        </div>
        <div class="text-center"><b>
            <?php echo $_SESSION['nombre_user']; ?>
        </b></div>

        <!-- creo alert oculto lo gestiona JS cuando aparece -->
        <div id="edit" style="display:none" class="alert alert-success text-center">
            <span><i class="fas fa-check"></i>   Se cambio el Avatar</span>
        </div>
        <!-- creo alert oculto lo gestiona JS cuando aparece -->
        <div id="no-edit" style="display:none" class="alert alert-danger text-center">
            <span><i class="fas fa-times"></i>   Formato NO soportado</span>
        </div>

        <!-- enctype="multipart/form-data" para que el formulario permita FILES -->
        <form action="" id="form-avatar" enctype="multipart/form-data">
            <div class="input-group mb-3 ml-5 mt-2">
                <!-- al enviarlos al Controller este recoge los name no los id -->
                <!-- no coge los "id" sino los "name" -->
                <input type="file" id="form-file" name="photo" class="input-group">
                <!-- utilizo un input oculto hidden, para enviar dato al Controller de forma enmascarada -->
                <input type="hidden" name="funcion" value="cambiar_avatar">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn bg-gradient-primary">Guardar</button>
            </div>

      </form>
      </div>

    </div>
  </div>
</div>


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
            <h1 class="titulo"><p><i class="fa-solid fa-user fa-lg"></i>  Datos personales</p></h1>
          </div>
        </div>
      </div>
    </section>
    
    <!-- SECTION -->
    <section>
        <div class="content">
            <div class="container-fluid">
                <div class="row">

                    <!-- *** DISTRIBUCION 1 COLUMNA IZQUIERDA *** -->
                    <!-- *** col-md-3 
                            col=columna 
                            md=tamaño medio 
                            3=que va a ocupar 3 columnas de las 12 que genera Bootstarp al utilizar la rejilla 
                    *** -->
                    <div class="col-md-3">
                        <!-- *** FILA DENTRO DE LA COLUMNA *** -->
                        <div class="card card-success">
                            <div class="card-header">
                                <!-- <h3 class="card-title">Sobre mi</h3> -->
                                <h3 id="nombre_apellidos_us" class="card-title">xxxxx</h3>
                            </div>
                            <div class="card-body">
                                <div class="text-center">
                                    <!-- ../img/avatarDefault.png -->
                                    <img id="avatar" src="#" class="avatar profile-user-img img-fluid img-circle">
                                </div>
                                <!-- Button trigger modal BOOTSTRAP cambiar Avatar -->
                                <div class="text-center mt-1">
                                    <button type="button" class="btn btn-primary btn-sm"
                                    data-toggle="modal" data-target="#cambiarAvatar">Cambiar avatar</button>
                                </div>

                                <!-- CAMPOS OCULTOS PARA PASAR AL JS -->
                                <input id="id_usuario" type="hidden" value="<?php echo $_SESSION['id_usuario']?>">
                                <br>
                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b style="color:#0B7300">Rol</b>
                                        <span id="us_rol" class="float-right">xxxxx</span>
                                    </li>
                                    <li class="list-group-item">
                                        <b style="color:#0B7300">Edad</b><a id="edad" class="float-right">xx</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b style="color:#0B7300">DNI</b><a id="dni_us" class="float-right">xx</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b style="color:#0B7300">Nivel del Jugador</b><a id="nivel" class="float-right">xx</a>
                                    </li>
                                </ul>
                                    <!-- Button trigger modal BOOTSTRAP cambiar Contraseña -->
                                    <button type="button" class="btn btn-block btn-outline-warning btn-sm" 
                                    data-toggle="modal" data-target="#cambio-contra">Cambiar contraseña</button>
                            </div>
                        </div>
                    </div>


                    <!-- *** DISTRIBUCION 1 COLUMNA MEDIO *** -->
                    <!-- *** col-md-3 
                            col=columna 
                            md=tamaño medio 
                            3=que va a ocupar 3 columnas de las 12 que genera Bootstarp al utilizar la rejilla 
                    *** -->
                    <div class="col-md-4">
                        <!-- *** FILA DENTRO DE LA COLUMNA *** -->
                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">Sobre mi</h3>
                            </div>
                            <div class="card-body">
                                <strong style="color:#0B7300">
                                    <i class="fas fa-phone mr-1"></i>Teléfono
                                </strong>
                                    <p id="telefono" class="text-muted">xxxxx</p>
                                <strong style="color:#0B7300">
                                    <i class="fas fa-map-marker-alt mr-1"></i>Dirección
                                </strong>
                                    <p id="direccion" class="text-muted">xxxxx</p>
                                <strong style="color:#0B7300">
                                    <i class="fas fa-at mr-1"></i>Email
                                </strong>
                                    <p id="email" class="text-muted">xxxxx</p>
                                <strong style="color:#0B7300">
                                    <i class="fas fa-smile-wink mr-1"></i>Genero
                                </strong>
                                    <p id="genero" class="text-muted">xxxxx</p>
                                <strong style="color:#0B7300">
                                    <i class="fas fa-pencil-alt mr-1"></i>Información adicional
                                </strong>
                                    <p id="adicional" class="text-muted">xxxxx</p>
                                    <button id="btn-editar" class="btn btn-block bg-gradient-danger">Editar</button>
                            </div>
                        </div>
                    </div>

                    
                    <!-- *** DISTRIBUCION 1 COLUMNA DERECHA, OCUPA TODO EL ESPACIO DERECHO *** -->
                    <!-- *** col-md-6 
                            col=columna 
                            md=tamaño medio 
                            6=que va a ocupar 6 columnas de las 12 que genera Bootstarp al utilizar la rejilla 
                    *** -->
                    <div class="col-md-5">
                        <!-- *** CREO UN div en el cual dentro irá todo el formulario *** -->
                        <div class="card card-success">
                            <!-- *** FILA DENTRO DE LA COLUMNA *** -->
                            <div class="card-header">
                                <h3 class="card-title">Editar datos personales</h3>
                            </div>
                            
                            <div class="card-body">
                                <!-- creo alert oculto lo gestiona JS cuando aparece -->
                                <div id="editado" style="display:none" class="alert alert-success text-center">
                                <span><i class="fas fa-check"></i>   Editado</span>
                                </div>
                                <!-- creo alert oculto lo gestiona JS cuando aparece -->
                                <div id="no-editado" style="display:none" class="alert alert-danger text-center">
                                <span><i class="fas fa-times"></i>   Para Editar tiene que pulsar en el botón "Editar"</span>
                                </div>
                                <form id="form-usuario" class="form-horizontal">
                                    <!-- *** FILA DENTRO DE LA COLUMNA *** -->
                                    <div class="form-group row">
                                        <!-- *** col-sm-2 ocupa 2 columnas pequeñas de las 12 que genera Bootstarp *** -->
                                        <label for="telefono" class="col-sm-2 col-form-label">Telefono</label>
                                        <!-- *** col-sm-10 ocupa 10 columnas pequeñas de las 12 que genera Bootstarp *** -->
                                        <div class="col-sm-10">
                                            <input type="text" id="edit_telefono" class="form-control">
                                        </div>
                                    </div>
                                    <!-- *** FILA DENTRO DE LA COLUMNA *** -->
                                    <div class="form-group row">
                                        <label for="direccion" class="col-sm-2 col-form-label">Direccion</label>
                                        <div class="col-sm-10">
                                            <input type="text" id="edit_direccion" class="form-control">
                                        </div>
                                    </div>
                                    <!-- *** FILA DENTRO DE LA COLUMNA *** -->
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="text" id="edit_email" class="form-control">
                                        </div>
                                    </div>
                                    <!-- *** FILA DENTRO DE LA COLUMNA *** -->
                                    <div class="form-group row">
                                        <label for="genero" class="col-sm-2 col-form-label">Genero</label>
                                        <div class="col-sm-10">
                                            <input type="text" id="edit_genero" class="form-control">
                                        </div>
                                    </div>
                                    <!-- *** FILA DENTRO DE LA COLUMNA *** -->
                                    <div class="form-group row">
                                        <label for="adicional" class="col-sm-2 col-form-label">Información adicional</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" id="edit_adicional" cols="30" rows="10"></textarea>
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

<script src="../js/datos_personales.js"></script>
