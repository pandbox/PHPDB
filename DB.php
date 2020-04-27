<?php
namespace PHPDB;

include 'Model.php';
use PHPDB\Model;
/**
 * Clase manejadora de consultas
 * 
 * @package PHPDB
 * @author Alejandro Moreno <alejandromj92@nauta.cu>
 * @version 0.0.1
 * @license MIT
 */
class DB extends Model
{
    /**
     * Constructor
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     **/
    public function __construct()
    {
        require_once 'config.php';
        if(is_readable ('config.php')){
            self::$dsn = DRIVER.":host=".HOST.";dbname=".NAME.";charset=".CHARSET;
        }else{
            die("<p>El archivo <b><i><u>config.php</u></i></b> no se encuentra en el directorio raíz o no es legible. Este archivo contiene las configuraciones de su base de datos. Puede solucionar esto rellenando la información de la base de datos en un archivo de configuración con el nombre de <b><i><u>config.php</u></i></b>, solicítale los datos de ajustes a tu proveedor de alojamiento web.</p>");
        }
    }

    /**
     * Crear un nuevo registro en la base de datos
     *
     * @param string $table Tabla a modificar
     * @param array $array Datos a insertar
     * @return bool
     * @throws conditon
     **/
    public function new(string $table, array $array=[])
    {
        if (is_string($table) && !empty($table)) {
            if (is_array($array) && !empty($array)) {
                $sign = str_repeat('?,', count($array));
                $sign[strlen($sign)-1] = ' ';
            
                $this->query = "INSERT INTO $table VALUE($sign)";
                $this->bindValue = array_values($array);
                return $this->_set();
            } else {
                die('Sentencia <b>INSERT</b> incorrecta. Especifique los valores a insertar.');
            }
        } else {
            die('Sentencia <b>INSERT</b> incorrecta. Especifique la tabla a trabajar.');
        }
    }

    /**
     * Visualizar registros de manera dinamica
     *
     * @param string $table Tabla a trabajar
     * @param array $val Parametros de la consulta
     * @return bool
     * @throws conditon
     **/
    public function show(string $table, array $val=[])
    {
        if (is_string($table) && !empty($table)) {
            if (is_array($val) && !empty($val)) {

                $str=implode("=? AND ",array_keys($val));
                $str.='=?';
                
                $this->query = "SELECT * FROM $table WHERE $str";
                $this->bindValue = array_values($val);
            } else {
                $this->query = "SELECT * FROM $table";
            }
            
            return $this->_get();
        } else {
            die('Sentencia <b>SELECT</b> incorrecta. Especifique la tabla a trabajar.');
        }
    }

    /**
     * Actualizar registro
     *
     * @param string $table Tabla a trabajar
     * @param array $array Parametros de la consulta
     * @return bool
     * @throws conditon
     **/
    public function update(string $table, array $array=[])
    {
        if (is_string($table) && !empty($table)) {
            if (is_array($array) && !empty($array)) {
                //Crear la clausula WHERE
                $field=current(array_keys($array));
                $field_value=current($array);
            
                $where = " WHERE $field = '$field_value'";
            
                //Eliminar primer registro de array
                $val=array_slice($array, 1);
            
                $str=implode("=?, ",array_keys($val));
                $str.='=?';
            
                $this->query = "UPDATE $table SET $str $where";
                $this->bindValue = array_values($val);
                return $this->_set();
            } else {
                die('Sentencia <b>UPDATE</b> incorrecta. Especifique los valores a modificar.');
            }
        } else {
            die('Sentencia <b>UPDATE</b> incorrecta. Especifique la tabla a trabajar.');
        }
    }
    
    /**
     * Eliminar registro
     *
     * En caso de no especificar los campos a borrar se borrara toda la tabla
     *
     * @param string $table Tabla a trabajar
     * @param array $array Parametros de la consulta
     * @return bool
     * @throws conditon
     **/
    public function delete(string $table, array $array=[])
    {
        if (is_string($table) && !empty($table)) {
            if (is_array($array) && !empty($array)) {
                $where = " WHERE ";
                $val=[];
                foreach ($array as $key => $value) {
                    $where.= $key."='".$value."',";
                    array_push($val, $value);
                }
                $where=rtrim($where, ',');
            
                $this->query = "DELETE FROM $table $where";
                $this->bindValue = array_values($val);
                return $this->_set();
            } else {
                $this->query = "DELETE FROM $table";
                return $this->_set();
            }
        } else {
            die('Sentencia <b>DELETE</b> incorrecta. Especifique la tabla a trabajar.');
        }
    }
}
