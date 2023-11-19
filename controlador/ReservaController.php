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
            'nivelString'=>$objeto->nombre_nivel,
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


/* FUNCION */
/* READ Reservas */
/* Devuelve Datos generales del Estado de las Pistas */
if($_POST['funcion']=="mostrar_datos_hoy"){
    $json=array();
    $json=$reserva->reservasHoy(0);
    $jsonString=json_encode($json);
    echo $jsonString;
}
if($_POST['funcion']=="mostrar_datos_mañana"){
    $json=array();
    $json=$reserva->reservasHoy(1);
    $jsonString=json_encode($json);
    echo $jsonString;
}
if($_POST['funcion']=="mostrar_datos_anuales_pasados"){
    $json=array();
    $json=$reserva->reservasAnualesPasadas();
    $jsonString=json_encode($json);
    echo $jsonString;
}
if($_POST['funcion']=="mostrar_datos_anuales_futuros"){
    $json=array();
    $json=$reserva->reservasAnualesFuturas();
    $jsonString=json_encode($json);
    echo $jsonString;
}


/* FUNCION */
/* READ Reservas */
/* Devuelve Datos generales para listar en "datatable" */
if($_POST['funcion']=='listar'){
    $reserva->buscar();
    $json=array();
    foreach($reserva->objetos as $objeto){
        //documentacion de DATATABLE
        $json['data'][]=$objeto;
    }
    $jsonstring=json_encode($json);
    echo $jsonstring; 
}


/* FUNCION */
/* READ Reservas */
/* Devuelve Datos de una Reserva en concreto, pasándole por parámetro fecha, hora y pista */
if($_POST['funcion']=='mostrarReserva'){
    $fecha=$_POST['fecha'];
    $hora=$_POST['hora'];
    $pista=$_POST['pista'];
    $json=array();
    $json=$reserva->mostrarReserva($fecha,$hora,$pista);
    $jsonString=json_encode($json);
    echo $jsonString;
}


/* FUNCION */
/* DELETE Reserva */
if($_POST['funcion']=="borrarReservaID"){
    $id_reserva=$_POST['id_reserva'];
    $reserva->borrarReservaID($id_reserva);
    return $reserva;
}


/* FUNCION */
/* READ Reservas */
/* Devuelve Datos generales para listar en "datatable" del Jugador logueado */
if($_POST['funcion']=='listar_reservas_jugador'){
    $reserva->buscar_reservas_jugador($id_usuario);
    $json=array();
    foreach($reserva->objetos as $objeto){
        //documentacion de DATATABLE
        $json['data'][]=$objeto;
    }
    $jsonstring=json_encode($json);
    echo $jsonstring; 
}


/* FUNCION */
/* READ Reserva */
/* Devuelve Datos de la próxima Reserva del usuario logueado */
if($_POST['funcion']=='mostrarProximaReserva'){
    $json=array();
    $json=$reserva->buscarProximaReservaJugador($id_usuario);
    $jsonString=json_encode($json);
    echo $jsonString;
}



?>