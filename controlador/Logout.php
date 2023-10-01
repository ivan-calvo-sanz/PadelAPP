<?php

    /* para acceder a la session */
    session_start();
    /* quiero que se desloguee el Usuario, para ello destruyo la Sesion */
    session_destroy();
    /* una vez deslogueado que me mande a Login */
    header('Location: ../index.php');

?>