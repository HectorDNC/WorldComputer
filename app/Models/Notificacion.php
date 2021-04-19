<?php

namespace App\Models;

use PDO;
use System\Core\Model;

class Notificacion extends Model{

 

    public function __construct(){
    }

    /**
     * METODOS
     */

    public function listar($limit) {
        try{
            $sql = 
           "SELECT * FROM notificaciones WHERE estatus = 'ACTIVO' ORDER BY created_at DESC LIMIT $limit";
      
              $consulta = parent::connect()->prepare($sql);
              $consulta->execute();
              
              return $consulta->fetchAll(PDO::FETCH_OBJ);
              
          } catch (Exception $ex) {
              die($ex->getMessage());
          }
    }

    public function crear ($usuario_id,$producto_id,$titulo,$mensaje) {
        $dbh = parent::connect();
        $consulta = $dbh->prepare("INSERT INTO notificaciones(usuario_id, producto_id, titulo, mensaje) VALUES (:usuario_id,:producto_id, :titulo, :mensaje)");

        $consulta->bindParam(":usuario_id", $usuario_id);
        $consulta->bindParam(":producto_id", $producto_id);
        $consulta->bindParam(":titulo", $titulo);
        $consulta->bindParam(":mensaje", $mensaje);

        $consulta->execute();
    }

    public function yaNotificado ($producto_id) {
        $conexion = parent::connect();

        try {
            $query = $conexion->prepare("SELECT * FROM notificaciones WHERE producto_id = :producto_id AND estatus = 'ACTIVO'");
            $query->bindParam(':producto_id',$producto_id);
            $query->execute();

            return ($query->rowCount() > 0) ? true : false;

        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function dismissNotificacion ($id) {
        $conexion = parent::connect();
        try {
            $query = $conexion->prepare("UPDATE notificaciones SET estatus = 'INACTIVO' WHERE id = :id");
            $query->bindParam(':id',$id);
            $query->execute();

            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}