<?php

namespace System\Core;

use PDO;

class Database {
    private $driver = 'mysql';
    private $host = 'localhost';
    private $dbname = 'world_computer';
    private $user = 'root';
    private $password = 'informatica';

    public function __construct(){
        $this->connect();
    }

    public function connect(){
        $connection = new PDO("$this->driver:host=$this->host; dbname=$this->dbname", $this->user, $this->password);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connection->exec("SET CHARACTER SET utf8;");//Para poder enviar caracteres especiales UTF8 a la DB. Está sentencia no es válida en todos los gestores de DB
        if (isset($_SESSION['id'])) {
            $connection->exec("SET @usuario_id = ".$_SESSION['id'].";");
        }
        
        // echo 'Conexion exitosa';
        return $connection;
    }
}