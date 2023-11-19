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


    /* FUNCION */
    /* READ Reserva */
    // Devuelve array ejemplo: ['1', '0', '0', '1', '1', '1', '0', '0', '1', '1', '1', '0', '0', '1', '1']
    // valores de cantidad de reservas realizadas por pista y hora
    /* ['PISTA A 10:00', 'PISTA A 11:30', 'PISTA A 16:00', 'PISTA A 17:30', 'PISTA A 19:00', 
        'PISTA B 10:00', 'PISTA B 11:30', 'PISTA B 16:00', 'PISTA B 17:30', 'PISTA B 19:00',
        'PISTA C 10:00', 'PISTA C 11:30', 'PISTA C 16:00', 'PISTA C 17:30', 'PISTA C 19:00',] */
    function reservasHoy($desfase){
        $fecha_actual = date("d-m-Y");
        $fecha_desfasada=date("d-m-Y",strtotime($fecha_actual."+ ".$desfase." days"));

        $dia=substr($fecha_desfasada,0,2);
        $mes=substr($fecha_desfasada,3,2);
        $year=substr($fecha_desfasada,6,4);

/*         $dia=$fecha_desfasada['mday'];
        $mes=$fecha_desfasada['mon'];
        $year=$fecha_desfasada['year']; */
    
        // formato fehca en la BBDD "YYY-MM-DD"
        $anio_mes_dia=$year."-".$mes."-".$dia;
        $horas=array("10:00","11:30","16:00","17:30","19:00");
        $pistas=array("A","B","C");

        $devuelve=array();

        //SELECT COUNT(jugador) FROM `tblreserva` WHERE fecha="13-11-2023" AND hora="10:00" AND pista="A"
        $sql="SELECT COUNT(jugador) FROM `tblreserva` WHERE fecha=:anio_mes_dia AND hora=:hora AND pista=:pista";
        $query=$this->acceso->prepare($sql);

        for($i = 0; $i < count($pistas); $i++) {
            for ($j = 0; $j < count($horas); $j++) {
                $query->execute(array(':anio_mes_dia'=>$anio_mes_dia,':hora'=>$horas[$j],':pista'=>$pistas[$i]));
                $this->objetos=$query->fetchColumn();
                array_push($devuelve, $this->objetos);
            }  
        }
        return $devuelve;
    }


    function reservasAnualesPasadas(){

        /*         $fecha_actual = getdate();
        $dia=$fecha_actual['mday'];
        $mes=$fecha_actual['mon'];
        $year=$fecha_actual['year'];
        $dia_mes_ano=$dia."-".$mes."-".$year;
        echo $dia_mes_ano; */

        $anio = getdate();
        $anio_actual=$anio['year'];

        $horas=array("10:00","11:30","16:00","17:30","19:00");
        $pistas=array("A","B","C");
        $devuelve=array();

        //SELECT COUNT(jugador) FROM `tblreserva` WHERE fecha="13-11-2023" AND hora="10:00" AND pista="A"
        $sql="SELECT COUNT(jugador) FROM `tblreserva` WHERE fecha=:anio_mes_dia AND hora=:hora AND pista=:pista";
        $query=$this->acceso->prepare($sql);

        $fecha_actual = date("d-m-Y");
        $fecha_desfasada = date("d-m-Y");
        for($d = 0; $fecha_desfasada>"01-01-".$anio_actual; $d++) {
            $fecha_desfasada=date("d-m-Y",strtotime($fecha_actual."- ".$d." days"));
            $dia=substr($fecha_desfasada,0,2);
            $mes=substr($fecha_desfasada,3,2);
            $year=substr($fecha_desfasada,6,4);
            
            // formato fehca en la BBDD "YYY-MM-DD"
            $anio_mes_dia=$year."-".$mes."-".$dia;
            for($i = 0; $i < count($pistas); $i++) {
                for ($j = 0; $j < count($horas); $j++) {
                    $query->execute(array(':anio_mes_dia'=>$anio_mes_dia,':hora'=>$horas[$j],':pista'=>$pistas[$i]));
                    $this->objetos=$query->fetchColumn();
                    array_push($devuelve, $this->objetos);
                }  
            }
        }   
        return $devuelve;
    }

    
    function reservasAnualesFuturas(){

/*         $fecha_actual = date("d-m-Y");
        $fecha_desfasada=0;
        for($i = 0; $fecha_desfasada<"31-12-2023"; $i++) {
          $fecha_desfasada=date("d-m-Y",strtotime($fecha_actual."+ ".$i." days"));
          echo $fecha_desfasada."//";
        } */

        $anio = getdate();
        $anio_actual=$anio['year'];

        $horas=array("10:00","11:30","16:00","17:30","19:00");
        $pistas=array("A","B","C");
        $devuelve=array();

        //SELECT COUNT(jugador) FROM `tblreserva` WHERE fecha="13-11-2023" AND hora="10:00" AND pista="A"
        $sql="SELECT COUNT(jugador) FROM `tblreserva` WHERE fecha=:anio_mes_dia AND hora=:hora AND pista=:pista";
        $query=$this->acceso->prepare($sql);

        $fecha_actual = date("d-m-Y");
        $fecha_desfasada = date("d-m-Y");
        for($d = 0; $fecha_desfasada<"31-12-".$anio_actual; $d++) {
            $fecha_desfasada=date("d-m-Y",strtotime($fecha_actual."+ ".$d." days"));
            $dia=substr($fecha_desfasada,0,2);
            $mes=substr($fecha_desfasada,3,2);
            $year=substr($fecha_desfasada,6,4);

            // formato fehca en la BBDD "YYY-MM-DD"
            $anio_mes_dia=$year."-".$mes."-".$dia;
            for($i = 0; $i < count($pistas); $i++) {
                for ($j = 0; $j < count($horas); $j++) {
                    $query->execute(array(':anio_mes_dia'=>$anio_mes_dia,':hora'=>$horas[$j],':pista'=>$pistas[$i]));
                    $this->objetos=$query->fetchColumn();
                    array_push($devuelve, $this->objetos);
                }  
            }
        } 
        return $devuelve;
    }   


    /* FUNCION */
    /* READ Reserva */
    // Devuelve todas las reservas para listarlas en "datatable"
    function buscar(){
        $sql="SELECT id_reserva,pista,fecha,hora,tblusuario.usuario as usuario, CONCAT(tblusuario.nombre,' ',tblusuario.apellidos) as nombre, 
        tblusuario.telefono as telefono, tblusuario.email as email  FROM tblreserva JOIN tblusuario on jugador=id_usuario";
        $query=$this->acceso->prepare($sql);
        $query->execute();
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }


    /* FUNCION */
    /* READ Reserva */
    // Devuelve todas las reservas para listarlas en "datatable" rol "Jugador"
    function buscar_reservas_jugador($id_usuario){
        $sql="SELECT id_reserva,pista,fecha,hora,tblusuario.usuario as usuario, CONCAT(tblusuario.nombre,' ',tblusuario.apellidos) as nombre, 
        tblusuario.telefono as telefono, tblusuario.email as email  FROM tblreserva JOIN tblusuario on jugador=id_usuario 
        WHERE id_usuario=:id_usuario";
        $query=$this->acceso->prepare($sql);
        //$query->execute();
        $query->execute(array(':id_usuario'=>$id_usuario));
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }


    /* FUNCION */
    /* READ Reservas */
    // Devuelve las reservas de una pista en concreto
    function mostrarReserva($fecha,$hora,$pista){   
        /* SELECT id_reserva, pista, fecha, hora, usuario, CONCAT(tblusuario.nombre,' ',tblusuario.apellidos) as nombre_apellidos, 
        telefono, email, avatar, nombre_rol, nombre_nivel FROM tblreserva JOIN tblusuario ON jugador=id_usuario JOIN tblrol ON us_rol=id_rol 
        JOIN tblnivel ON us_nivel=id_nivel WHERE fecha="2023-11-16" AND hora="11:30" AND pista="A";; */
        $sql="SELECT id_reserva, pista, fecha, hora, usuario, CONCAT(tblusuario.nombre,' ',tblusuario.apellidos) as nombre_apellidos, 
        telefono, email, avatar, nombre_rol, nombre_nivel FROM tblreserva JOIN tblusuario ON jugador=id_usuario JOIN tblrol ON us_rol=id_rol 
        JOIN tblnivel ON us_nivel=id_nivel WHERE fecha=:fecha AND hora=:hora AND pista=:pista";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':fecha'=>$fecha,':hora'=>$hora,':pista'=>$pista));
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }


    /* FUNCION */
    /* DELETE Reserva */
    // elimina reserva mediante el id_reserva que se le pasa por parametro
    // devuelve String si se ha podido borrar la Reserva exitosamente
    function borrarReservaID($id_reserva){
        $sql="DELETE FROM tblreserva WHERE id_reserva=:id_reserva";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':id_reserva'=>$id_reserva));
        echo "reserva_borrada";
    }


    /* FUNCION */
    /* READ Reserva */
    // Devuelve la Proxima reserva de un Usuario en concreto
    function buscarProximaReservaJugador($id_usuario){ 
        // Selecciono todas las reservas que tiene el usuario y ordenadas de forma ascendiente en fehca y hora
        $sql="SELECT id_reserva, fecha, hora, pista FROM tblreserva WHERE jugador=:id_usuario ORDER BY fecha ASC, hora ASC";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':id_usuario'=>$id_usuario));
        $reservas=$this->objetos=$query->fetchall();

        // recorro el Array y selecciono el registro que es el siguiente respecto a la fecha actual
        $fecha_actual = date("d-m-Y");
        $dia=substr($fecha_actual,0,2);
        $mes=substr($fecha_actual,3,2);
        $year=substr($fecha_actual,6,4);
        $anio_mes_dia=$year."-".$mes."-".$dia;
        $proximaReserva=array();
        for($i = 0; $i < count($reservas); $i++) {
            if($reservas[$i]->fecha>=$anio_mes_dia){
                $proximaReserva=$reservas[$i];
                break;
            }
        }

        /* teniendo la proxima reserva extraigo la fecha, hora y pista para buscar el resto de posibles reservas 
        de otros usuarios en esa fecha, hora y pista */
        $fecha_proximaReserva=$proximaReserva->fecha;
        $hora_proximaReserva=$proximaReserva->hora;
        $pista_proximaReserva=$proximaReserva->pista;
        $sql="SELECT id_reserva, pista, fecha, hora, usuario, CONCAT(tblusuario.nombre,' ',tblusuario.apellidos) as nombre_apellidos, 
        telefono, email, avatar, nombre_rol, nombre_nivel FROM tblreserva JOIN tblusuario ON jugador=id_usuario JOIN tblrol ON us_rol=id_rol 
        JOIN tblnivel ON us_nivel=id_nivel WHERE fecha=:fecha AND hora=:hora AND pista=:pista";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':fecha'=>$fecha_proximaReserva,':hora'=>$hora_proximaReserva,':pista'=>$pista_proximaReserva));
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }


}
?>