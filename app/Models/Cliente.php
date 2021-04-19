<?php

namespace App\Models;

use Exception;
use PDO;

class Cliente extends Persona{

    public function getClientes() {
        try{
            $consulta = parent::connect()->prepare("SELECT id, documento, CONCAT(nombre, ' ', apellido) AS nombre, telefono, estatus, created_at FROM clientes WHERE estatus='ACTIVO' ORDER BY estatus, created_at DESC");
            $consulta->execute();
            
            return $consulta->fetchAll(PDO::FETCH_OBJ);
            
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }

    public function listar(){
        try{
            $consulta = parent::connect()->prepare("SELECT id, documento, CONCAT(nombre, ' ', apellido) AS nombre, telefono, estatus, created_at FROM clientes ORDER BY estatus, created_at DESC");
            $consulta->execute();
            
            return $consulta->fetchAll(PDO::FETCH_OBJ);
            
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }
    
    public function registrar(Cliente $c){
        try{
            $consulta = parent::connect()->prepare("INSERT INTO clientes(documento, nombre, apellido, direccion, telefono, email, estatus) "
                . "VALUES (:documento, :nombre, :apellido, :direccion, :telefono, :email, :estatus)");
        
            //$id = $u->getId();
            $documento= $c->getTipoDocumento()."-".$c->getDocumento();
            $nombre = $c->getNombre();
            $apellido = $c->getApellido();
            $direccion = $c->getDireccion();
            $telefono = $c->getTelefono();
            $email = $c->getEmail();
            $estatus = $c->getEstatus();
            
            $consulta->bindParam(":documento", $documento);
            $consulta->bindParam(":nombre", $nombre);
            $consulta->bindParam(":apellido", $apellido);
            $consulta->bindParam(":direccion", $direccion);
            $consulta->bindParam(":telefono", $telefono);
            $consulta->bindParam(":email", $email);
            $consulta->bindParam(":estatus", $estatus);

            return $consulta->execute();                      
        } catch (Exception $ex) {
            $this->error = $ex->getMessage();
            return false;
        }
    }

    public function actualizar(Cliente $c){
        try{
            $consulta = parent::connect()->prepare("UPDATE clientes SET documento=:documento, nombre=:nombre, apellido=:apellido, direccion=:direccion, telefono=:telefono, email=:email, estatus=:estatus WHERE id=:id");


            $id = $c->getId();
            $documento= $c->getTipoDocumento()."-".$c->getDocumento();
            $nombre = $c->getNombre();
            $apellido = $c->getApellido();
            $direccion = $c->getDireccion();
            $telefono = $c->getTelefono();
            $email = $c->getEmail();
            $estatus = "ACTIVO";
            
            $consulta->bindParam(":id", $id);
            $consulta->bindParam(":documento", $documento);
            $consulta->bindParam(":nombre", $nombre);
            $consulta->bindParam(":apellido", $apellido);
            $consulta->bindParam(":direccion", $direccion);
            $consulta->bindParam(":telefono", $telefono);
            $consulta->bindParam(":email", $email);
            $consulta->bindParam(":estatus", $estatus);

            return $consulta->execute();
                    
        } catch (Exception $ex) {
            $this->error = $ex->getMessage();
            return false;
        }
    }

}