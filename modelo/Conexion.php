<?php

/* Utilizo PDO para realizar la conexion a la BBDD  mysql */
class Conexion{
    private $servidor="localhost";
    /*nombre asignada a la BBDD */
    private $db="padel";
    /* puerto que utiliza mysql para conectarse a la BBDD */
    private $puerto=3306;
    /* tipos de datos en español */
    private $charset="utf8";
    private $usuario="root";
    private $contrasena="";
    public $pdo=null;

    /* asigno que fuerce los nombres de las columnas a minusculas */
    /* asigno que nos reporte errores para poder implementar try catch */
    /* asigno que las cadenas vacias las reporte como null */
    /* asigno que el método de búsqueda que devuelve sea de tipo Objeto */
    private $atributos=[PDO::ATTR_CASE=>PDO::CASE_LOWER,
                        PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_ORACLE_NULLS=>PDO::NULL_EMPTY_STRING,
                        PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_OBJ];

    /* CONSTRUCTOR */
    function __construct(){
        $this->pdo=new PDO("mysql:dbname={$this->db};host={$this->servidor};port={$this->puerto};charset={$this->charset}",
        $this->usuario,$this->contrasena,$this->atributos);
    }
}

?>