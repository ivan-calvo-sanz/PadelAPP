<?php
include_once '../modelo/Reserva.php';
$reserva=new Reserva();
session_start();
$id_usuario=$_SESSION['id_usuario'];


/* FUNCION */
/* READ Reservas */
if($_POST['funcion']=="consultarReservas"){
    $json=array();
    
    $fecha=$_POST['formato_fecha'];
    $hora=$_POST['hora'];

    $reserva->consultarReservas($fecha,$hora);
    foreach($reserva->objetos as $objeto){
        /* relleno el json con los datos que obtengo de la consulta de la BBDD */
        $json[]=array(
            'id_reserva'=>$objeto->id_reserva,
            'pista'=>$objeto->pista,
            'fecha'=>$objeto->fecha,
            'hora'=>$objeto->hora,
            'nombreJugador'=>$objeto->nombre,
            'avatar'=>$objeto->avatar,
        );
    }
    /* para enviar el JSON al JS */
    /* json_encode realiza la transformacion del JSON PHP a un JSON codificado como String */
    $jsonstring=json_encode($json);
    /* enviamos el JSON como String */
    echo $jsonstring;
}


/* FUNCION */
/* READ Reservas */
/* Devuelve el Estado de las Pistas */
if($_POST['funcion']=="estadoPistas"){
    $json=array();
    
    $formato_fecha=$_POST['formato_fecha'];
    $hora=$_POST['hora'];

    $json=array();
    $json=$reserva->estadoPistas($formato_fecha,$hora);
    $jsonString=json_encode($json);
    echo $jsonString;
}


/* FUNCION */
/* DELETE Reserva */
if($_POST['funcion']=="borrar_reserva"){
    $id_usuario=$_SESSION['id_usuario'];
    $formato_fecha=$_POST['formato_fecha'];
    $hora=$_POST['hora'];

    $reserva->borrarReserva($id_usuario,$formato_fecha,$hora);
}


/* FUNCION */
/* INSERT Reserva */
if($_POST['funcion']=="reservar"){
    $json=array();
    
    $id_usuario=$_SESSION['id_usuario'];
    $formato_fecha=$_POST['formato_fecha'];
    $hora=$_POST['hora'];
    $pista=$_POST['pista'];

    $reserva->insertarReserva($id_usuario,$formato_fecha,$hora,$pista);
    //echo 'insertarReserva';
}

























?>