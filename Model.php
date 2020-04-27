<?php
namespace PHPDB;

use PDO;
/**
 * Clase Modelo de Base de Datos
 * 
 * @package PHPDB
 * @author Alejandro Moreno <alejandromj92@nauta.cu>
 * @version 0.0.1
 * @license MIT
 */
abstract class Model
{
    /**
     * Nombre del Origen de Datos 
     * 
     * @var string DSN 
     */
    protected static $dsn;

    /**
     * Objeto con los valores de la conexion
     * 
     *  @var object connection 
     */
    private $conn;

    /**
     * Consulta a la Base de Datos
     * 
     *  @var string query db 
     */
    protected $query;

    /**
     * Valores de prametros a validar
     * 
     *  @var array bind value param
     */
    protected $bindValue = [];

    /**
     * Filas Afectadas tras la consulta
     * 
     *  @var array row affect
     */
    protected $row = [];

    /**
     * Establecer una conexion con la base de datos
     *
     * @return object Devuelve el objeto Conexion $this->conn
     **/
    protected function _connect()
    {
        $error_db = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);
        try {
            $this->conn = new PDO(self::$dsn,USER,PASSWORD,$error_db);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    /**
     * Funcion encargada de Modificar la base de datos
     *
     * @return bool
     **/
    public function _set()
    {
        $this->_connect();
        $pre_query = $this->conn->prepare($this->query);
        $result = $pre_query->execute($this->bindValue);
        $this->_disconnect();
        return $result;
    }

    /**
     * Funcion encargada de mostrar la informacion de la base de datos
     *
     * @return data
     **/
    public function _get()
    {
        $this->_connect();
        $pre_query = $this->conn->prepare($this->query);
        $pre_query->execute($this->bindValue);
        
        $result = $pre_query->fetchAll(PDO::FETCH_ASSOC);

        $pre_query->closeCursor();
        $this->_disconnect();
        while ($this->row = $result) {
            return $this->row;
        }
    }

    /**
     * Cerrar conexion con la base de datos
     *
     * @return null Anular el objeto Conexion $this->conn
     **/
    public function _disconnect()
    {
        $this->conn = NULL;
    }

    /**
     * Crear un nuevo registro en la base de datos
     **/
    abstract public function new(string $table, array $array=[]);

    /**
     * Actualizar un registro en la base de datos
     **/
    abstract public function update(string $table, array $array=[]);

    /**
     * Mostrar registros de la base de datos
     **/
    abstract public function show(string $table, array $array=[]);

    /**
     * Eliminar un registro en la base de datos
     **/
    abstract public function delete(string $table, array $array=[]);
}
