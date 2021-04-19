<?php

namespace App\Models;

use PDO;
use Exception;
use System\Core\Model;

class Entrada extends Model{

    private $compra_id;
    private $producto_id;
    private $cantidad;
    private $costo;

    public function getCompraId(){
        return $this->compra_id;
    }

    public function setCompraId($compra_id){
        $this->compra_id = $compra_id;
    }

    public function getProductoId(){
        return $this->producto_id;
    }

    public function setProductoId($producto_id){
        $this->producto_id = $producto_id;
    }

    public function getCantidad(){
        return $this->cantidad;
    }

    public function setCantidad($cantidad){
        $this->cantidad = $cantidad;
    }

    public function getCosto(){
        return $this->costo;
    }

    public function setCosto($costo){
        $this->costo = $costo;
    }

    public function registrar(Entrada $entrada){
        try{
            $consulta = parent::connect()->prepare("INSERT INTO detalle_compra(compra_id, producto_id, cantidad, costo) VALUES 
                                                                     (:compra_id, :producto_id, :cantidad, :costo)");

            $compra_id = $entrada->getCompraId();
            $producto_id = $entrada->getProductoId();
            $cantidad = $entrada->getCantidad();
            $costo = $entrada->getCosto();

            $consulta->bindParam(":compra_id", $compra_id);
            $consulta->bindParam(":producto_id", $producto_id);
            $consulta->bindParam(":cantidad", $cantidad);
            $consulta->bindParam(":costo", $costo);

            $consulta->execute();

            return true;

        }catch(Exception $ex){
            return $ex->getMessage();
        }
    }
}