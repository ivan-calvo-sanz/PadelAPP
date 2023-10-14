<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PadelAPP</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&family=Raleway:wght@400;700&display=swap"
      rel="stylesheet"
    />

    <!-- Font Awesome (ICONOS) -->
    <link rel="stylesheet" href="css/cssFont_Awesome/all.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="css/cssAdminLTE/adminlte.min.css">

    <!-- Hojas de estilo -->
    <link rel="stylesheet" type="text/css" href="css/index.css" />
    <link rel="stylesheet" type="text/css" href="css/cssAdminLTE/adminlte.min.css" />


    <?php
        /* inicio la session para poder utilizar las variables de session */
        session_start();
        
        /* si existe un Usuario guardado en la Sesion */
        if(!empty($_SESSION['us_rol'])){
            header('Location: ../controlador/LoginControler.php');
        /* si NO existe Usuario guardado en la Sesion borra la Sesion */
        }else{
            session_destroy();
    ?>

</head>
<body>

    <div class="login">
        <img src="img/fondo.jpg" alt="login image" class="login_img">
    
        <form id="login_form" action="controlador/LoginControler.php" method="post" class="login_form">
            <h1 class="login_title">Login</h1>
            <div class="login_content">

                <div class="login_box">
                    <i class="fa-regular fa-user fa-lg"></i>
                    <div class="login_box-input">
                        <input id="login-user" name="user" type="text" required class="login_input" placeholder=" ">
                        <label for="" class="login_label">Usuario</label>
                    </div>
                </div>
                <div class="login_box">
                    <i class="fa-solid fa-lock fa-lg"></i>
                    <div class="login_box-input">
                        <input id="login-pass" name="pass" type="password" required class="login_input" placeholder=" ">
                        <label for="" class="login_label">Contraseña</label>
                        <!-- Icono "Ojo" abierto o Cerrado -->
                        <i class="fa-regular fa-eye-slash fa-lg login-eye" id="login-eye"></i>
                    </div>

                </div>
            </div>

            <button type="submit" class="login_button">Login</button>

            <!-- creo alert oculto gestiona LoginController cuando aparece -->
            <?php  if(!empty($_SESSION['logueado'])&&$_SESSION['logueado']=="no"){ 
                echo ('
                    <div class="alert alert-danger text-center">
                    <span><i class="fa-solid fa-circle-xmark fa-lg"></i>   Usuario o Contraseña <br> INCORRECTO</span>
                    </div>
                '); 
            } ?> 

        </form>
    
    </div>
    
</body>

  <?php
      }
  ?>

</html>


<!-- jQuery -->
<script src="js/jquery/jquery-3.7.1.js"></script>  
<!-- JS -->
<script src="js/index.js"></script>