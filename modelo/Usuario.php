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


    /* FUNCION */
    /* READ Usuario Cards */
    /* busca los usuarios cuyo nombre contiene las letras que se le pasa por parámetro */
    /* Devuelve Objeto con los datos de todos los Usuarios coincidentes */
    function buscarCards(){
        //si "consulta" NO está vacio, es decir si hemos introducido algo en el cuadro de texto
        //es decir, si envia algo realizo una consulta
        if(!empty($_POST["consulta"])){
            $consulta=$_POST["consulta"];
            /* SELECT * FROM tblusuario INNER JOIN tblrol ON us_rol=id_rol INNER JOIN tblnivel ON us_nivel=id_nivel WHERE nombre LIKE :consulta; */
            /* $sql="SELECT * FROM tblusuario JOIN tblrol ON us_rol=id_rol WHERE nombre LIKE :consulta"; */
            $sql="SELECT * FROM tblusuario INNER JOIN tblrol ON us_rol=id_rol INNER JOIN tblnivel ON us_nivel=id_nivel WHERE nombre LIKE :consulta 
            ORDER BY us_rol LIMIT 25";
            $query=$this->acceso->prepare($sql);
            //utilizo %consulta% para que busque coincidencias NO solo la busqueda exacta
            $query->execute(array(':consulta'=>"%$consulta%"));
            $this->objetos=$query->fetchAll();
            return $this->objetos;

        //si NO envia nada realizo otra consulta diferente
        }else{
            /* $sql="SELECT * FROM tblusuario JOIN tblrol ON us_rol=id_rol WHERE nombre NOT LIKE '' ORDER BY id_usuario LIMIT 25"; */
            $sql="SELECT * FROM tblusuario INNER JOIN tblrol ON us_rol=id_rol INNER JOIN tblnivel ON us_nivel=id_nivel 
            WHERE nombre NOT LIKE '' ORDER BY us_rol LIMIT 25";
            $query=$this->acceso->prepare($sql);
            $query->execute();
            $this->objetos=$query->fetchAll();
            return $this->objetos;
        }
    }


    /* FUNCION */
    /* DELETE Usuario */
    /* busca el usuario cuyo id coincide con el que se le pasa por parámtero y borra su registro */
    /* Devuelve String confirmando el borrado del registro */
    function eliminar($id_usuario,$pass,$id_card){
        // compruebo que la contraseña que introduce Usuario logueado es correcta
        $sql="SELECT id_usuario FROM tblusuario WHERE id_usuario=:id_usuario AND contrasena=:pass";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':id_usuario'=>$id_usuario,':pass'=>$pass));
        $this->objetos=$query->fetchAll();
        // si la consulta devuelve valores, es decir NO está vacia, es que el usuairo logueado es correcto
        if(!empty($this->objetos)){
            $sql="DELETE FROM tblusuario WHERE id_usuario=:id_card";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':id_card'=>$id_card)); 
            echo 'eliminado';
        }else{
            echo 'no_eliminado';
        }
    }


    /* FUNCION */
    /* ASCENDER Usuario */
    /* busca el usuario cuyo id coincide con el que se le pasa por parámtero y modifica su registro */
    /* Devuelve String confirmando la actualización del registro */
    function ascenderAAdmin($id_usuario,$pass,$id_card){
        // compruebo que la contraseña que introduce Usuario logueado es correcta
        $sql="SELECT id_usuario FROM tblusuario WHERE id_usuario=:id_usuario AND contrasena=:pass";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':id_usuario'=>$id_usuario,':pass'=>$pass));
        $this->objetos=$query->fetchAll();
        // si la consulta devuelve valores, es decir NO está vacia, es que el usuairo logueado es correcto
        if(!empty($this->objetos)){
            $rol="2";
            $sql="UPDATE tblusuario SET us_rol=:rol WHERE id_usuario=:id_card";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':id_card'=>$id_card,':rol'=>$rol));
            echo 'ascendidoAAdmin';
        }else{
            echo 'no_ascendidoAAdmin';
        }
    }


    /* FUNCION */
    /* DESCENDER Usuario */
    /* busca el usuario cuyo id coincide con el que se le pasa por parámtero y modifica su registro */
    /* Devuelve String confirmando la actualización del registro */
    function desscenderAJugador($id_usuario,$pass,$id_card){
        // compruebo que la contraseña que introduce Usuario logueado es correcta
        $sql="SELECT id_usuario FROM tblusuario WHERE id_usuario=:id_usuario AND contrasena=:pass";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':id_usuario'=>$id_usuario,':pass'=>$pass));
        $this->objetos=$query->fetchAll();
        // si la consulta devuelve valores, es decir NO está vacia, es que el usuairo logueado es correcto
        if(!empty($this->objetos)){
            $rol="3";
            $sql="UPDATE tblusuario SET us_rol=:rol WHERE id_usuario=:id_card";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':id_card'=>$id_card,':rol'=>$rol));
            echo 'descendidoAJugador';
        }else{
            echo 'no_descendidoAJugador';
        }
    }

    /* FUNCION */
    /* SUBIR nivel Usuario */
    /* busca el usuario cuyo id coincide con el que se le pasa por parámtero y modifica su registro */
    /* Devuelve String confirmando la actualización del registro */
    function subirNivel($id_usuario,$pass,$id_card){
        // compruebo que la contraseña que introduce Usuario logueado es correcta
        $sql="SELECT id_usuario FROM tblusuario WHERE id_usuario=:id_usuario AND contrasena=:pass";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':id_usuario'=>$id_usuario,':pass'=>$pass));
        $this->objetos=$query->fetchAll();
        
        // si la consulta devuelve valores, es decir NO está vacia, es que el usuairo logueado es correcto             
        if(!empty($this->objetos)){
            // guardo el nivel que tiene ese jugador id_card
            $sql="SELECT * FROM tblusuario WHERE id_usuario=:id_card";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':id_card'=>$id_card));
            $this->objetos=$query->fetchAll();
            foreach($this->objetos as $objeto){
                $nivel=$objeto->us_nivel;
                //echo $nivel;
            }
            if($nivel<6){
                $nivel=$nivel+1;
                //echo $nivel;
                $sql="UPDATE tblusuario SET us_nivel=:nivel WHERE id_usuario=:id_card";
                $query=$this->acceso->prepare($sql);
                $query->execute(array(':id_card'=>$id_card,':nivel'=>$nivel)); 
                echo 'nivelSubido';
            }
        }else{
            echo 'no_nivelSubido';
        }
    }


    /* FUNCION */
    /* BAJAR nivel Usuario */
    /* busca el usuario cuyo id coincide con el que se le pasa por parámtero y modifica su registro */
    /* Devuelve String confirmando la actualización del registro */
    function bajarNivel($id_usuario,$pass,$id_card){
        // compruebo que la contraseña que introduce Usuario logueado es correcta
        $sql="SELECT id_usuario FROM tblusuario WHERE id_usuario=:id_usuario AND contrasena=:pass";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':id_usuario'=>$id_usuario,':pass'=>$pass));
        $this->objetos=$query->fetchAll();
        
        // si la consulta devuelve valores, es decir NO está vacia, es que el usuairo logueado es correcto             
        if(!empty($this->objetos)){
            // guardo el nivel que tiene ese jugador id_card
            $sql="SELECT * FROM tblusuario WHERE id_usuario=:id_card";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':id_card'=>$id_card));
            $this->objetos=$query->fetchAll();
            foreach($this->objetos as $objeto){
                $nivel=$objeto->us_nivel;
                //echo $nivel;
            }
            if($nivel>0){
                $nivel=$nivel-1;
                //echo $nivel;
                $sql="UPDATE tblusuario SET us_nivel=:nivel WHERE id_usuario=:id_card";
                $query=$this->acceso->prepare($sql);
                $query->execute(array(':id_card'=>$id_card,':nivel'=>$nivel)); 
                echo 'nivelBajado';
            }
        }else{
            echo 'no_nivelBajado';
        }
    }


    /* FUNCION */
    /* CREAR Usuario */
    /* busca que NO exista ya un Usuario en la BBDD con ese DNI y crea el nuevo Usuario*/
    /* dependiendo devuelve el String correspondiente */
    function crear($nombre,$apellidos,$edad,$dni,$pass,$avatar,$rol,$nivel){
        /* compruebo que el DNI es diferente a los ya guardados en la BBDD */
        /* busco algun usuario en la tabla que tenga el mismo DNI */
        $sql="SELECT id_usuario FROM tblusuario WHERE dni=:dni";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':dni'=>$dni));
        $this->objetos=$query->fetchAll();

        /* si existe algun usuario con ese DNI tiene que haber enviado algun dato la query */
        if(!empty($this->objetos)){
            echo 'noadd';
        }else{
            $sql="INSERT INTO tblusuario(nombre,apellidos,edad,dni,contrasena,avatar,us_rol,us_nivel) 
                VALUES (:nombre,:apellidos,:edad,:dni,:pass,:avatar,:rol,:nivel)";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(
                ':nombre'=>$nombre,
                ':apellidos'=>$apellidos,
                ':edad'=>$edad,
                ':dni'=>$dni,
                ':pass'=>$pass,
                ':avatar'=>$avatar,
                ':rol'=>$rol,
                ':nivel'=>$nivel
                ));
            echo 'add';
        }
    }


}
?>