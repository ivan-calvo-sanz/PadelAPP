<?php
include_once '../modelo/Usuario.php';
$usuario=new Usuario();


/* FUNCION */
/* READ Usuario */
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
            'avatar'=>$objeto->avatar,
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


/* FUNCION */
/* UPDATE Usuario */
if($_POST['funcion']=="actualizar-usuario"){
    $id_usuario=$_POST['id_usuario'];
    $telefono=$_POST['telefono'];
    $direccion=$_POST['direccion'];
    $email=$_POST['email'];
    $genero=$_POST['genero'];
    $adicional=$_POST['adicional'];
    $usuario->actualizar($id_usuario,$telefono,$direccion,$email,$genero,$adicional);
    /* mando "editado" o NADA al JS para comprobar que se ha Actualizado la BBDD o NO */
    echo 'editado';
}


/* FUNCION */
/* UPDATE Usuario Contraseña */
if($_POST['funcion']=="cambiar_contra"){
    $id_usuario=$_POST['id_usuario'];
    $oldpass=$_POST['oldpass'];
    $newpass=$_POST['newpass'];
    $usuario->cambiar_contra($id_usuario,$oldpass,$newpass);
}

?>