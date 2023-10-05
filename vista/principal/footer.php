    <!-- restringir que solo puede entrar si en la Sesion esta Logeado -->
    <!-- evitar que por inyeccion en URL poniendo la direccion /vista/principal/header-nav.php se pueda 
    entrar, que sea necesario estar Logueado -->
    <?php
        if($_SESSION['us_rol']==1||$_SESSION['us_rol']==2||$_SESSION['us_rol']==3){
    ?>

   

<!-- jQuery -->
<script src="../js/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../js/bootstrap/bootstrap.bundle.min.js"></script>

</body>

<?php
    }else{
        header('Location: ../../index.php');
    }
?>

</html>

<script src="../js/principal.js"></script>