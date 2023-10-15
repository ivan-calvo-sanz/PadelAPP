<?php
include_once '../modelo/Usuario.php';
$usuario=new Usuario();
session_start();
$id_usuario=$_SESSION['id_usuario'];


/* FUNCION */
/* READ Usuario */
if($_POST['funcion']=="buscar_usuario"){
    /* creo el JSON vacio */
    $json=array();
    $fecha_actual=new DateTime();
    $usuario->obtener_datos($_POST['id_usuario']);
    foreach($usuario->objetos as $objeto){
        $nacimiento=new DateTime($objeto->edad);
        $edad=$nacimiento->diff($fecha_actual);
        $edad_years=$edad->y;
        /* relleno el json con los datos que obtengo de la consulta de la BBDD */
        $json[]=array(
            'nombre_usuario'=>$objeto->usuario,
            'nombre'=>$objeto->nombre,
            'apellidos'=>$objeto->apellidos,
            'edad'=>$edad_years,
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


/* FUNCION */
/* UPDATE Avatar */
if($_POST['funcion']=="cambiar_avatar"){
    //para que solo admita seleccioanr imagenes y NO otro tipo de archivos
    if(($_FILES['photo']['type']=='image/jpeg')||($_FILES['photo']['type']=='image/png')||($_FILES['photo']['type']=='image/gif')){
        /* las imagenes las envia por FILES en vez de POST */
        /* uniquid() lo que realiza es generar un codigo unico, de esta forma el nombre del archivo que estoy recogiendo va a ser unico
        puedo seleccionar 2 veces el archivo con el mismo nombre que al generar un código unico por delante es posible */
        $nombre=uniqid().'-'.$_FILES['photo']['name'];
        /* ahora el archivo (imagen) está en el Buffer de la APP pero no esta en las carpetas del servidor */
        /* echo $nombre; */
        // guardo la ruta de la carpeta donde quiero guardar la imagen
        $ruta='../img/'.$nombre;
        //para pasar el archivo (imagen) de la ruta de la carpeta a una direccion del servidor "muevo" la imagen con la siguiente funcion
        // ['tmp_name']   hace referencia a la direccion donde se encuentra almacenado en el buffer de la APP temporalmente la imagen
        // le indico que quiero que se guarda en la carpeta ubicada en "ruta"
        move_uploaded_file($_FILES['photo']['tmp_name'],$ruta);
        $usuario->cambiar_avatar($id_usuario,$nombre);
        // de la anterior funcion nos devuelve el objeto con el usuario que contiene el avatar antiguo
        foreach($usuario->objetos as $objeto){
            // metodo para borrar un archivo de una carpeta fisica
            unlink('../img/'.$objeto->avatar);
        }
        /* devuelvo un JSON ya que voy a devolver mas de 1 dato */
        // creo el JSON
        $json=array();
        $json[]=array(
            'ruta'=>$ruta,
            'alert'=>'edit'
        );
        $_SESSION['avatar']=$ruta;
        // transformo el Json en String
        $jsonString=json_encode( $json[0]);
        // devuelvo el Json
        echo $jsonString;
    }else{
        /* en caso que el archivo seleccionado NO es .jpg / .gif / .png */
        // devuelvo este Json
        $json=array();
        $json[]=array(
            'alert'=>'noedit'
        );
        // transformo el Json en String
        $jsonString=json_encode($json[0]);
        // devuelvo el Json
        echo $jsonString;
    }
}

?>