<?php

/* incluyo la Clase Conexion para poder generar un objeto de esta Clase */
include_once "Conexion.php";

class Usuario{
    var $objetos;
    var $acceso;
    public function __construct(){
        $db=new Conexion();
        $this->acceso=$db->pdo;
    }

    /* FUNCION */
    /* READ Usuario */
    /* devuelve Objeto Usuario el cual coincide con el dni y contraseña pasado por parametros */
    function Loguearse($user,$pass){
        /* CONSULTA TIPICA SQL, es posible injectar consulta SQL mediante la URL */
        /* $sql="SELECT * FROM tblUsuario WHERE usuario=$usuario AND contrasena=$pass"; */
        
        /* para evitar que se pueda injectar SQL mediante la URL utilizamos PDO */
        $sql="SELECT * FROM tblUsuario WHERE usuario=:usuario AND contrasena=:pass";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':usuario'=>$user,':pass'=>$pass));

        /* ejecuta la consulta y devuelve Objeto con el resultado */
        $this->objetos=$query->fetchAll();
        return $this->objetos;
    }


    /* FUNCION */
    /* READ Usuario */
    /* se le pasa por parámetro el id del Usuario */
    /* retorna un Objeto con los datos del Usuario */
    function obtener_datos($id_usuario){
        /* para evitar que se pueda injectar SQL mediante la URL utilizo PDO */
        /* SELECT * FROM tblusuario JOIN tblnivel ON us_nivel=id_nivel AND id_usuario=1; */
        $sql="SELECT * FROM tblusuario JOIN tblnivel ON us_nivel=id_nivel AND id_usuario=:id";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_usuario));

        /* realizo la consulta y devuelvo el resultado */
        $this->objetos=$query->fetchAll();
        return $this->objetos;
    }


    /* FUNCION */
    /* UPDATE Usuario */
    /* actualiza los datos del Usuario con los nuevos datos que se le pasan por parámetro */
    /* NO Devuelve nada */
    function actualizar($id_usuario,$telefono,$direccion,$email,$genero,$adicional){
        $sql="UPDATE tblusuario SET telefono=:telefono,direccion=:direccion,email=:email,genero=:genero,
        adicional=:adicional WHERE id_usuario=:id";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_usuario,':telefono'=>$telefono,':direccion'=>$direccion,':email'=>$email,
        ':genero'=>$genero,':adicional'=>$adicional));
    }


    /* FUNCION */
    /* UPDATE Usuario Contraseña */
    /* actualiza la contraseña comprobando que la contraseña actual que se pasa por parámetro es correcta */
    /* Devuelve String */
    function cambiar_contra($id_usuario,$oldpass,$newpass){
        /* compruebo que la contraseña introducida pertenece al usuario logueado */
        $sql="SELECT * FROM tblusuario WHERE id_usuario=:id AND contrasena=:oldpass";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_usuario,':oldpass'=>$oldpass));
        $this->objetos=$query->fetchAll();

        /* Si $this->objetos NO está vacio significa que ha encontrado 1 resultado y entonces id_usuario y 
        contraseña introducidos son correctos, sino, NO es correcto*/
        if(!empty($this->objetos)){
            /* actualizo la contraseña */
            $sql="UPDATE tblusuario SET contrasena=:newpass WHERE id_usuario=:id";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id_usuario,':newpass'=>$newpass));
            echo "update";
        }else{
            echo "noupdate";
        }
    }


    /* FUNCION */
    /* UPDATE Usuario Avatar */
    /* actualiza el avatar del Usuario */
    /* Devuelve Objeto con String del nombre avatar antiguo */
    function cambiar_avatar($id_usuario,$nombre){
        // para controlar el espacio ocupado en la carpeta img devuelve el nombre del archivo imagen old
        $sql="SELECT avatar FROM tblusuario WHERE id_usuario=:id";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_usuario));
        $this->objetos=$query->fetchAll();

        // realizo la actualizacion de la imagen
        $sql="UPDATE tblusuario SET avatar=:nombre WHERE id_usuario=:id";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_usuario,':nombre'=>$nombre));
            
        // devuelvo el objeto anterior que contiene el nombre del avatar antiguo
        return $this->objetos;
    }

}

?>