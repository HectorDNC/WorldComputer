<?php

namespace App\Models;

use PDO;
use Exception;
use System\Core\Model;

class Configuracion extends Model{
    private $nombre_sistema;
    private $dolar;
    private $iva;
    public function getNombre_sistema(){
        return $this->nombre_sistema;
    }

    public function setNombre_sistema($nombre_sistema){
        $this->nombre_sistema = $nombre_sistema;
    }
    public function getDolar(){
        return $this->dolar;
    }

    public function setDolar($dolar){
        $this->dolar = $dolar;
    }
    public function getIva(){
        return $this->iva;
    }

    public function setIva($iva){
        $this->iva = $iva;
    }

    public function actualizar(){
        try{
            $connect = parent::connect();
            // $consulta = $connect->prepare("UPDATE configuracion SET valor='$this->nombre_sistema' WHERE nombre='nombre_sistema'");            
            // $consulta->execute();
            $consulta = $connect->prepare("UPDATE configuracion SET valor='$this->dolar' WHERE nombre='dolar'");            
            $consulta->execute();
            $consulta = $connect->prepare("UPDATE configuracion SET valor='$this->iva' WHERE nombre='iva'");            
            $consulta->execute();
            return true;
                    
        } catch (Exception $ex) {
            $this->error = $ex->getMessage();
            return false;            
        }
        
    }

    public function obtenerNombre_sistema()
    {   
        try {
            $config = new Configuracion;
            $query = $config->query("SELECT * FROM configuracion WHERE nombre = 'nombre_sistema'");
            $nombre_sistema = $query->fetch(PDO::FETCH_OBJ);
            return $nombre_sistema->valor;
        } catch (Exception $ex) {
            $this->error = $ex->getMessage();
            return false;            
        }
        
    }
    public function obtenerDolar()
    {   
        try {
            $config = new Configuracion;
            $query = $config->query("SELECT * FROM configuracion WHERE nombre = 'dolar'");
            $dolar = $query->fetch(PDO::FETCH_OBJ);
            return $dolar->valor;
        } catch (Exception $ex) {
            $this->error = $ex->getMessage();
            return false;            
        }
        
    }
    public function obtenerIva()
    {   
        try {
            $config = new Configuracion;
            $query = $config->query("SELECT * FROM configuracion WHERE nombre = 'iva'");
            $iva = $query->fetch(PDO::FETCH_OBJ);
            return $iva->valor;
        } catch (Exception $ex) {
            $this->error = $ex->getMessage();
            return false;            
        }
        
    }


}