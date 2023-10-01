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

    /* FUNCION
    devuelve Objeto Usuario el cual coincide con el dni y contraseña pasado por parametros */
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

}

?>