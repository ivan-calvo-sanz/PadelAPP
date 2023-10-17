<!-- restringir que solo puedan entrar en la Sesion si está Logeado como Usuario ROOT o Administrador, 
tipo Jugador no quiero que puedan acceder -->
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

<!-- Modal BOOTSTRAP Confirmar Accion -->
<div class="modal fade" id="confirmar-contra" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirmar acción</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="text-center">
          <!-- <img id="avatar3" src="../img/avatar.png" alt="" class="profile-user-img img-file img-circle"> -->
            <img id="avatar3" src="#" alt="" class="profile-user-img img-file img-circle">
        </div>
        <div class="text-center"><b>
            <?php   
                echo $_SESSION['nombre_us'];    
            ?>
        </b></div>
        <span>Confirme su contraseña</span>
        <!-- creo alert oculto lo gestiona JS cuando aparece -->
        <div id="alert_confirmar" style="display:none" class="alert alert-success text-center">
            <span><i class="fas fa-check"></i>   Se ha modificado al usuario</span>
        </div>
        <!-- creo alert oculto lo gestiona JS cuando aparece -->
        <div id="alert_rechazar" style="display:none" class="alert alert-danger text-center">
            <span><i class="fas fa-times"></i>   La contraseña NO es correcta</span>
        </div>

        <form action="" id="form-confirmar">
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-unlock-alt"></i></span>
                <input id="pass" type="password" class="form-control" placeholder="Contraseña actual">
            </div>
            <input type="hidden" id="id_user">
            <input type="hidden" id="funcion">

            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn bg-gradient-primary">Confirmar</button>
            </div>
      </form>
      </div>

    </div>
  </div>
</div>


<!-- Modal BOOTSTRAP Cambio Avatar -->
<div class="modal fade" id="crearusuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
     <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title">Crear Usuario</h3>
             <!-- Creo boton que cierra el MODAL -->
            <button data-dismiss="modal" aria-label="close" class="close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="card-body">
            <!-- creo alert oculto lo gestiona JS cuando aparece -->
            <div id="add" style="display:none" class="alert alert-success text-center">
                <span><i class="fas fa-check"></i>   Usuario creado correctamente</span>
            </div>
            <!-- creo alert oculto lo gestiona JS cuando aparece -->
            <div id="noadd" style="display:none" class="alert alert-danger text-center">
                <span><i class="fas fa-times"></i>   El DNI ya existe. <br> Usuario NO creado</span>
            </div>

            <!-- Creo el formulario -->
            <form id="form-crear">
                <div class="form-group">
                    <label for="nombre">Nombres</label>
                    <input id="nombre" type="text" class="form-control" placeholder="Ingrese nombre" required>
                </div>
                <div class="form-group">
                    <label for="apellido">Apellidos</label>
                    <input id="apellido" type="text" class="form-control" placeholder="Ingrese apellido" required>
                </div>
                <div class="form-group">
                    <label for="edad">Nacimiento</label>
                    <input id="edad" type="date" class="form-control" placeholder="Ingrese nacimiento" required>
                </div>
                <div class="form-group">
                    <label for="dni">DNI</label>
                    <input id="dni" type="text" class="form-control" placeholder="Ingrese DNI" required>
                </div>
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input id="password" type="password" class="form-control" placeholder="Ingrese contraseña" required>
                </div>
        
                <div class="card-footer">
                    <button type="submit" class="btn bg-gradient-primary float-right m-1">Guardar</button>
                    <button type="button" data-dismiss="modal" class="btn btn-outline-secondary float-right m-1">Close</button>
                </div>
            </form>
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
            <h1 class="titulo"><p><i class="fa-solid fa-users fa-lg"></i> Gestionar Usuarios</p></h1>

            <!-- para saber que tipo de usuario ha iniciado sesion -->
            <!-- mediante un campo input oculto paso al JS el rol del usuario -->
            <input type="hidden" id="rol_usuario" value="<?php echo $_SESSION['us_rol'] ?>">  

            <!-- Creo el link al MODAL -->
            <button type="button" id="button-crear" 
            data-toggle="modal" data-target="#crearusuario" class="btn bg-gradient-primary ml-2">Crear usuario</button>
            </h1>
          </div>

        </div>
      </div>
    </section>

    <!-- Contenido PRINCIPAL -->
    <section>
    <div class="container-fluid">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Buscar usuario</h3>
                <div class="input-group">
                    <input type="text" id="buscar" placeholder="Nombre de usuario" class="form-control float-left">
                    <div class="input-group-append">
                        <button class="btn btn-default">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="card-body">
              <div id="usuarios" class="row d-flex align-items-stretch">
              </div>
            </div>
            <div class="card-footer"></div>
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

<script src="../js/gestionar_usuarios.js"></script>
