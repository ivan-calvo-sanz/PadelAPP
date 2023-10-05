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

    <!-- RemixIcon https://remixicon.com/ -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">

    <!-- Hojas de estilo -->
    <link rel="stylesheet" type="text/css" href="css/index.css" />


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
    
        <form action="controlador/LoginControler.php" method="post" class="login_form">
            <h1 class="login_title">Login</h1>
            <div class="login_content">
                <div class="login_box">
                    <i class="ri-user-3-line login_icon"></i>
                    <div class="login_box-input">
                        <input name="user" type="text" required class="login_input" placeholder=" ">
                        <label for="" class="login_label">Usuario</label>
                    </div>
                </div>
                <div class="login_box">
                    <i class="ri-lock-2-line login_icon"></i>
                    <div class="login_box-input">
                        <input name="pass" type="password" required class="login_input" id="login-pass" placeholder=" ">
                        <label for="" class="login_label">Contraseña</label>
                        <i class="ri-eye-off-line login_eye" id="login-eye"></i>
                    </div>
                </div>
            </div>

            <button type="submit" class="login_button">Login</button>
        </form>
    
    </div>
    
</body>

  <?php
      }
  ?>

</html>

<script src="js/index.js"></script>