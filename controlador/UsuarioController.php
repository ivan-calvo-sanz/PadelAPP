<?php
include_once '../modelo/Usuario.php';
$usuario=new Usuario();


// *** FUNCION ***
if($_POST['funcion']=="buscar_usuario"){
    /* creo el JSON vacio */
    $json=array();
    $usuario->obtener_datos($_POST['id_usuario']);
    foreach($usuario->objetos as $objeto){
        /* relleno el json con los datos que obtengo de la consulta de la BBDD */
        $json[]=array(
            'nombre_usuario'=>$objeto->usuario,
            'nombre'=>$objeto->nombre,
            'apellidos'=>$objeto->apellidos,
            'edad'=>$objeto->edad,
            'dni'=>$objeto->dni,
            'telefono'=>$objeto->telefono,
            'direccion'=>$objeto->direccion,
            'email'=>$objeto->email,
            'genero'=>$objeto->genero,
            'adicional'=>$objeto->adicional,
            'rol'=>$objeto->us_rol,
            'nivel'=>$objeto->nombre_nivel
        );
    }
    /* envio el JSON al JS */
    /* json_encode realiza la transformacion del JSON PHP a un JSON codificado como String */
    $jsonstring=json_encode($json[0]);
    /* envio el JSON como String */
    echo $jsonstring;   
}


