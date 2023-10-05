<?php
include_once '../modelo/Usuario.php';

session_start();
$user=$_POST["user"];
$pass=$_POST["pass"];

$usuario=new Usuario();

if(empty($_SESSION['us_rol'])){
        $usuario->Loguearse($user,$pass);
        /* Control de permisos de acceso a la Web dependeindo del rol que tenga el Usuario */
        /* Controla si el Usuario Introducido es: "ROOT", "Administrador" o "Jugador" */
        if(!empty($usuario->objetos)){
                foreach($usuario->objetos as $objeto){
                        /* variables globales de la Sesion abierta */
                        $_SESSION['id_usuario']=$objeto->id_usuario;
                        $_SESSION['usuario']=$objeto->usuario;
                        $_SESSION['nombre']=$objeto->nombre;
                        $_SESSION['apellidos']=$objeto->apellidos;
                        $_SESSION['edad']=$objeto->edad;
                        $_SESSION['dni']=$objeto->dni;
                        $_SESSION['contrasena']=$objeto->contrasena;
                        $_SESSION['us_rol']=$objeto->us_rol;
                        $_SESSION['us_nivel']=$objeto->us_nivel;
                }
        }
}

/* dependiendo de si es: "ROOT", "Administrador" o "Jugador" redirige a una u otra página */
switch ($_SESSION['us_rol']) {
        case 1:
                /* Tipo 1 y 2 es para ROOT y Administrador, hago que vayan a la misma página, dentro de ella
                hago que cambién ciertas opciones que el Admin NO podrá ver y el ROOT SI */
                header('Location: ../vista/plantilla.php');
                break;
        case 2:
                header('Location: ../vista/plantilla.php');
                break;  
        case 3:
                header('Location: ../vista/plantilla.php');
                break; 
        default:
        /* si NO se ingresa Usuario correctamente o NO existe ese Usuario tiene que volver de nuevo al login */
                header('Location: ../index.php');
                break;
}

?>      