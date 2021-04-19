<?php

namespace App\Models;

use Exception;
use PDO;
use System\Core\Model;

class Rol extends Model {
    
    private $id;
    private $nombre;
    private $descripcion;
    private $permisos = [];

    public function __construct(){
    }

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function setNombre($nombre){
        $this->nombre = $nombre;
    }
    public function getDescripcion(){
        return $this->descripcion;
    }

    public function setDescripcion($descripcion){
        $this->descripcion = $descripcion;
    }

    public function getPermisos(){
        return $this->permisos;
    }

    public function setPermisos($permiso){
        $this->permisos = $permiso;
    }

    public function listar(){
        try{

            $conexion = parent::connect();

            $query = $conexion->prepare("SELECT * FROM roles ORDER BY estatus");
            $query->execute();

            return $query->fetchAll(PDO::FETCH_OBJ);

        }catch(Exception $ex){
            die($ex->getMessage());
        }
    }

    public function registrar(Rol $r){
        try{
            $dbh = parent::connect();
            $consulta = $dbh->prepare("INSERT INTO roles(nombre, descripcion) "
                . "VALUES (:nombre, :descripcion)");
        
            //$id = $u->getId();
            $nombre = $r->getNombre();
            $descripcion = $r->getDescripcion();
            $permisos = $r->getPermisos();
            
            $consulta->bindParam(":nombre", $nombre);
            $consulta->bindParam(":descripcion", $descripcion);

            $consulta->execute();
            $lastId = $dbh->lastInsertId();
            foreach ($permisos as $permiso) {
                $consulta = $dbh->prepare("INSERT INTO rol_permiso(rol_id, permiso_id) "
                    . "VALUES ($lastId, $permiso)");
                $consulta->execute();
            }
           
            return true;
            
        } catch (Exception $ex) {
            $this->error = $ex->getMessage();
            return false;
        }
    }
    public function mostrar($id)
    {
        $sql = "SELECT r.id, r.nombre, r.descripcion, rp.permiso_id, p.nombre as permiso FROM roles r 
            INNER JOIN rol_permiso rp ON r.id = rp.rol_id INNER JOIN permisos p ON rp.permiso_id=p.id WHERE r.id = $id
            ORDER BY rp.permiso_id";
        $consulta = parent::connect()->prepare($sql);
        $consulta->execute();
        $rol = $consulta->fetchAll(PDO::FETCH_OBJ);
        foreach($rol as $r){
            $r->permiso = ucwords($r->permiso);
        }
        
        return $rol;
    }
    public function actualizar(Rol $r){
        try{
            $dbh = parent::connect();
            $consulta = $dbh->prepare("UPDATE roles SET nombre=:nombre, 
                descripcion=:descripcion, estatus=:estatus WHERE id=:id");

            $id = $r->getId();
            $nombre = $r->getNombre();
            $descripcion = $r->getDescripcion();
            $permisos = $r->getPermisos();
            $estatus = "ACTIVO";
            
            $consulta->bindParam(":id", $id);
            $consulta->bindParam(":nombre", $nombre);
            $consulta->bindParam(":descripcion", $descripcion);
            $consulta->bindParam(":estatus", $estatus);
            $consulta->execute();

            $consulta = $dbh->prepare("DELETE FROM rol_permiso WHERE rol_id = $id");
            $consulta->execute();
            foreach ($permisos as $permiso) {
                $consulta = $dbh->prepare("INSERT INTO rol_permiso(rol_id, permiso_id) "
                    . "VALUES ($id, $permiso)");
                $consulta->execute();
            }
            return true;
                    
        } catch (Exception $ex) {            
            $this->error = $ex->getMessage();
            return false;
        }
    }
}