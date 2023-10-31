<?php

/* incluyo la Clase Conexion para poder generar un objeto de esta Clase */
include_once "Conexion.php";

class Reserva{
    var $objetos;
    var $acceso;
    public function __construct(){
        $db=new Conexion();
        $this->acceso=$db->pdo;
    }

    /* FUNCION */
    /* READ Reserva */
    /* devuelve Objetos Reservas coinciden con la fecha y hora pasados por parametro */
    function consultarReservas($fecha,$hora){
        /* $sql="SELECT * FROM tblreserva INNER JOIN tblusuario ON us_tipo=id_tipo_us WHERE dni_us='$dni' AND contrasena_us='$pass'"; */
        $sql="SELECT * FROM tblreserva INNER JOIN tblusuario ON jugador=id_usuario WHERE fecha=:fecha AND hora=:hora";
        /* SELECT * FROM tblreserva INNER JOIN tblusuario ON jugador=id_usuario INNER JOIN tblnivel ON us_nivel=id_nivel 
        WHERE fecha="1-11-2023" AND hora="10:00"; */
        $sql="SELECT * FROM tblreserva INNER JOIN tblusuario ON jugador=id_usuario INNER JOIN tblnivel ON us_nivel=id_nivel 
        WHERE fecha=:fecha AND hora=:hora";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':fecha'=>$fecha,':hora'=>$hora));

        $this->objetos=$query->fetchAll();
        return "si";
        return $this->objetos;
    }


    /* FUNCION */
    /* READ Reserva */
    /* devuelve el Estado de las Pistas */
    function estadoPistas($formato_fecha,$hora){
        // CONTROLAR cantidad de plazas reservadas en esa pista (fecha, hora y pista cuantos Registros tiene)

        // PISTA A
        //SELECT COUNT(id_reserva) FROM tblreserva WHERE pista="A" AND fecha="20-9-2023" AND hora="10:00"
        $sql="SELECT COUNT(id_reserva) FROM tblreserva WHERE pista=:pista AND fecha=:fecha AND hora=:hora";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':pista'=>'A',':fecha'=>$formato_fecha,':hora'=>$hora));
        $contReservasPistaA=$query->fetchColumn();
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':pista'=>'B',':fecha'=>$formato_fecha,':hora'=>$hora));
        $contReservasPistaB=$query->fetchColumn();
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':pista'=>'C',':fecha'=>$formato_fecha,':hora'=>$hora));
        $contReservasPistaC=$query->fetchColumn();
        
        $array = array(
            "contReservasPistaA" => $contReservasPistaA,
            "contReservasPistaB" => $contReservasPistaB,
            "contReservasPistaC" => $contReservasPistaC
        );
        return $array;
    }


    /* FUNCION */
    /* DELETE Reserva */
    // FUNCION DELETE Reserva: Borra Reservas
    function borrarReserva($id_usuario,$formato_fecha,$hora){
        // Compruebo si el Usuario tiene Reserva en esa fecha y hora
        $sql="SELECT COUNT(id_reserva) FROM tblreserva WHERE jugador=:id_usuario AND fecha=:fecha AND hora=:hora";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':id_usuario'=>$id_usuario,':fecha'=>$formato_fecha,':hora'=>$hora));
        $contReserva=$query->fetchColumn();

        if($contReserva==0){
            echo "no_tienes_reserva";
        }else{
            $sql="DELETE FROM tblreserva WHERE jugador=:id_usuario AND fecha=:fecha AND hora=:hora";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':id_usuario'=>$id_usuario,':fecha'=>$formato_fecha,':hora'=>$hora));
            echo "tienes_reserva";
        }
    }


    /* FUNCION */
    /* INSERT Reserva */
    // Comprueba que ese Usuario NO tiene reserva en esa fecha y hora e Inserta la Reserva
    function insertarReserva($id_usuario,$formato_fecha,$hora,$pista){
        // CONTROLAR que NO existe reserva de este mismo usuario en esa fecha y hora (usuario, fecha y hora no tiene ningun otro Registro)
        //SELECT COUNT(id_reserva) FROM tblreserva WHERE jugador=1 AND fecha="20-9-2023" AND hora="10:00"
        $sql="SELECT COUNT(id_reserva) FROM tblreserva WHERE jugador=:id AND fecha=:fecha AND hora=:hora";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_usuario,':fecha'=>$formato_fecha,':hora'=>$hora));
        $contReservasUsuario=$query->fetchColumn();

        // CONTROLAR que existe plaza en esa pista (fecha, hora y pista tienen menos de 4 Registros)
        //SELECT COUNT(id_reserva) FROM tblreserva WHERE pista="A" AND fecha="20-9-2023" AND hora="10:00"
        $sql="SELECT COUNT(id_reserva) FROM tblreserva WHERE pista=:pista AND fecha=:fecha AND hora=:hora";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':pista'=>$pista,':fecha'=>$formato_fecha,':hora'=>$hora));
        $contReservasPista=$query->fetchColumn();
        //echo $contReservasPista;

        if($contReservasPista==4){
            echo 'pista_completa';
        }
        if($contReservasUsuario>0){
            echo 'existe_reserva';
        }elseif($contReservasUsuario==0){ 
            // Inserta Reserva Usuario
            $sql="INSERT INTO tblreserva(pista,fecha,hora,jugador) VALUES (:pista,:fecha,:hora,:jugador)";
                $query=$this->acceso->prepare($sql);
                $query->execute(array(
                    ':pista'=>$pista,
                    ':fecha'=>$formato_fecha,
                    ':hora'=>$hora,
                    ':jugador'=>$id_usuario
                ));
                echo 'reservada';
        }
    }

}
?>