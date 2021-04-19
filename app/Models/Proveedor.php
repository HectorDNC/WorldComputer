<?php

namespace App\Models;

use Exception;
use PDO;

class Proveedor extends Persona{

    public function getProveedores () {
        try{
            $consulta = parent::connect()->prepare("SELECT * FROM proveedores ORDER BY estatus ='ACTIVO', created_at DESC");
            $consulta->execute();
            
            return $consulta->fetchAll(PDO::FETCH_OBJ);
            
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }

    public function listar(){
        try{
            $consulta = parent::connect()->prepare("SELECT * FROM proveedores ORDER BY estatus, created_at DESC");
            $consulta->execute();
            
            return $consulta->fetchAll(PDO::FETCH_OBJ);
            
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }

    public function registrar(Proveedor $proveedor){
        try{
            $consulta = parent::connect()->prepare("INSERT INTO proveedores(documento, razon_social, direccion, telefono, email, estatus) "
                . "VALUES (:documento, :razon_social, :direccion, :telefono, :email, :estatus)");
        
            //$id = $u->getId();
            $documento= $proveedor->getTipoDocumento()."-".$proveedor->getDocumento();
            $razon_social = $proveedor->getNombre();
            $direccion = $proveedor->getDireccion();
            $telefono = $proveedor->getTelefono();
            $email = $proveedor->getEmail();
            $estatus = $proveedor->getEstatus();
            
            $consulta->bindParam(":documento", $documento);
            $consulta->bindParam(":razon_social", $razon_social);
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

    public function actualizar(Proveedor $proveedor){
        try{
            $consulta = parent::connect()->prepare("UPDATE proveedores SET documento=:documento, razon_social=:razon_social, direccion=:direccion, telefono=:telefono, email=:email, estatus=:estatus WHERE id=:id");


            $id = $proveedor->getId();
            $documento= $proveedor->getTipoDocumento()."-".$proveedor->getDocumento();
            $razon_social = $proveedor->getNombre();
            $direccion = $proveedor->getDireccion();
            $telefono = $proveedor->getTelefono();
            $email = $proveedor->getEmail();
            $estatus = "ACTIVO";
            
            $consulta->bindParam(":id", $id);
            $consulta->bindParam(":documento", $documento);
            $consulta->bindParam(":razon_social", $razon_social);
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