<?php

namespace App\Models;

use PDO;
use Exception;
use System\Core\Model;

class Compra extends Movimiento{

    private $documentoReferencia;

    public function getDocumentoReferencia(){
        return $this->documentoReferencia;
    }

    public function setDocumentoReferencia($documentoReferencia){
        $this->documentoReferencia = $documentoReferencia;
    }

    public function listar(){

        $conexion = parent::connect();

        try{

            $conexion->beginTransaction();

            $sql = "SELECT c.id, c.codigo, Date_format(c.fecha,'%d/%m/%Y') AS fecha, Date_format(c.fecha,'%H:%i') AS hora, p.razon_social AS proveedor, c.estatus FROM
            compras c
                LEFT JOIN
            proveedores p
                ON c.proveedor_id = p.id ORDER BY c.created_at DESC";
    
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            
            $conexion->commit();

            return $consulta->fetchAll(PDO::FETCH_OBJ);
            
        } catch (Exception $ex) {
            $conexion->rollBack();
            die($ex->getMessage());
        }
    }

    public function registrar(Compra $compra){
        try{

            $dbh = parent::connect();

            $consulta = $dbh->prepare("INSERT INTO compras(proveedor_id, codigo, cod_ref, usuario_id, dolar)" 
                                                            . "VALUES (:proveedor_id, :codigo, :cod_ref, :usuario_id, :dolar)");

            $proveedor_id = $compra->getPersonaId();
            $codigo = $compra->getNumeroDocumento();
            $documentoReferencia = $compra->getDocumentoReferencia();
            $total = $compra->getTotal();
            $dolar = $compra->getDolar();

            $consulta->bindParam(":proveedor_id", $proveedor_id);
            $consulta->bindParam(":codigo", $codigo);
            $consulta->bindParam(":cod_ref", $documentoReferencia);
            $consulta->bindParam(":usuario_id", $_SESSION['id']);
            $consulta->bindParam(":dolar", $dolar);
            // $consulta->bindParam(":total", $total);

            $consulta->execute();

            $lastId = $dbh->lastInsertId();
            
            return $lastId;

        }catch(Exception $ex){
            return $ex->getMessage();
        }
    }

    public function ultimoDocumento(){
        try {
            $consulta = parent::connect()->prepare("SELECT codigo FROM compras ORDER BY id DESC LIMIT 1");
            $consulta->execute();
            return $consulta->fetch(PDO::FETCH_COLUMN);
        } catch (Exception $ex){
            return $ex->getMessage();
        }
    }

}