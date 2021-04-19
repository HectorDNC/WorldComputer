<?php

namespace App\Models;

use PDO;
use Exception;
use System\Core\Model;

class Salida extends Model{

    private $venta_id;
    private $producto_id;
    private $cantidad;
    private $precio;

    public function getVentaId(){
        return $this->venta_id;
    }

    public function setVentaId($venta_id){
        $this->venta_id = $venta_id;
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

    public function getPrecio(){
        return $this->precio;
    }

    public function setPrecio($precio){
        $this->precio = $precio;
    }

    public function registrar(Salida $detalleVenta){
        try{
            $consulta = parent::connect()->prepare("INSERT INTO detalle_venta(venta_id, producto_id, cantidad, precio) VALUES 
                                                                     (:venta_id, :producto_id, :cantidad, :precio)");

            $venta_id = $detalleVenta->getVentaId();
            $producto_id = $detalleVenta->getProductoId();
            $cantidad = $detalleVenta->getCantidad();
            $precio = $detalleVenta->getPrecio();

            $consulta->bindParam(":venta_id", $venta_id);
            $consulta->bindParam(":producto_id", $producto_id);
            $consulta->bindParam(":cantidad", $cantidad);
            $consulta->bindParam(":precio", $precio);

            $consulta->execute();

            return true;

        }catch(Exception $ex){
            return $ex->getMessage();
        }
    }
}