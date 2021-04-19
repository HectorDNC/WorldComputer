<?php

namespace App\Models;

use Exception;
use PDO;

class Empleado extends Persona{
    private $cargo;

    public function setCargo($cargo){
        $this->cargo = $cargo;
    }
    public function getCargo(){
        return $this->cargo;
    }

    public function getTecnicos(){
        try{
            $consulta = parent::connect()->prepare("SELECT id, documento, CONCAT(nombre, ' ', apellido) AS nombre, telefono, cargo, estatus, created_at FROM empleados WHERE cargo ='TECNICO' AND estatus='ACTIVO'");
            $consulta->execute();
            
            return $consulta->fetchAll(PDO::FETCH_OBJ);
            
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }

    //CRUD
    public function listar(){
        try{
            $consulta = parent::connect()->prepare("SELECT id, documento, CONCAT(nombre, ' ', apellido) AS nombre, telefono, cargo, estatus, created_at FROM empleados ORDER BY estatus, created_at DESC");
            $consulta->execute();
            
            return $consulta->fetchAll(PDO::FETCH_OBJ);
            
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }

    public function listarCargo( $cargo ){
        try{
            $consulta = parent::connect()->prepare("SELECT id, documento, CONCAT(nombre, ' ', apellido) AS nombre, telefono, cargo, estatus, created_at FROM empleados WHERE estatus='ACTIVO' AND cargo = :cargo ORDER BY created_at DESC");
            $consulta->bindParam(":cargo", $cargo);
            $consulta->execute();
            
            return $consulta->fetchAll(PDO::FETCH_OBJ);
            
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }
    
    public function registrar(Empleado $c){
        try{
            $consulta = parent::connect()->prepare("INSERT INTO empleados(documento, nombre, apellido, direccion, telefono, email, cargo, estatus) "
                . "VALUES (:documento, :nombre, :apellido, :direccion, :telefono, :email, :cargo, :estatus)");
        
            //$id = $u->getId();
            $documento= $c->getTipoDocumento()."-".$c->getDocumento();
            $nombre = $c->getNombre();
            $apellido = $c->getApellido();
            $direccion = $c->getDireccion();
            $telefono = $c->getTelefono();
            $email = $c->getEmail();
            $cargo = $c->getCargo();
            $estatus = $c->getEstatus();
            
            $consulta->bindParam(":documento", $documento);
            $consulta->bindParam(":nombre", $nombre);
            $consulta->bindParam(":apellido", $apellido);
            $consulta->bindParam(":direccion", $direccion);
            $consulta->bindParam(":telefono", $telefono);
            $consulta->bindParam(":email", $email);
            $consulta->bindParam(":cargo", $cargo);
            $consulta->bindParam(":estatus", $estatus);

            return $consulta->execute();          
        
            
        } catch (Exception $ex) {
            
            $this->error = $ex->getMessage();
            return false;
        }
    }

    public function actualizar(Empleado $c){
        try{
            $consulta = parent::connect()->prepare("UPDATE empleados SET documento=:documento, nombre=:nombre, apellido=:apellido, direccion=:direccion, telefono=:telefono, email=:email, cargo=:cargo, estatus=:estatus WHERE id=:id");

            $id = $c->getId();
            $documento= $c->getTipoDocumento()."-".$c->getDocumento();
            $nombre = $c->getNombre();
            $apellido = $c->getApellido();
            $direccion = $c->getDireccion();
            $telefono = $c->getTelefono();
            $email = $c->getEmail();
            $cargo = $c->getCargo();
            $estatus = "ACTIVO";
            
            $consulta->bindParam(":id", $id);
            $consulta->bindParam(":documento", $documento);
            $consulta->bindParam(":nombre", $nombre);
            $consulta->bindParam(":apellido", $apellido);
            $consulta->bindParam(":direccion", $direccion);
            $consulta->bindParam(":telefono", $telefono);
            $consulta->bindParam(":email", $email);
            $consulta->bindParam(":cargo", $cargo);
            $consulta->bindParam(":estatus", $estatus);

            return $consulta->execute();
                    
        } catch (Exception $ex) {
            $this->error = $ex->getMessage();
            return false;
        }
    }

}