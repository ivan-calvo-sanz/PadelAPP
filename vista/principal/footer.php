    <!-- restringir que solo puede entrar si en la Sesion esta Logeado -->
    <!-- evitar que por inyeccion en URL poniendo la direccion /vista/principal/header-nav.php se pueda 
    entrar, que sea necesario estar Logueado -->
    <?php
        if($_SESSION['us_rol']==1||$_SESSION['us_rol']==2||$_SESSION['us_rol']==3){
    ?>

    </div>

</body>

<?php
    }else{
        header('Location: ../../index.php');
    }
?>

</html>

<script src="../js/principal.js"></script>