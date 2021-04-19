<?php

namespace App\Models;

use PDO;
use Exception;
use System\Core\Model;

class Servicio extends Model{

    private $id;
    private $descripcion;
    private $nombre;
    private $precio;
    private $dolar;
    
    private $codigo;
    private $cliente_id;
    private $empleado_id;
    private $venta_id;
    private $servicios_id;
    private $servicios_precio;
    private $estatus;
    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getProductoId(){
        return $this->descripcion;
    }

    public function setProductoId($descripcion){
        $this->descripcion = $descripcion;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function setNombre($nombre){
        $this->nombre = $nombre;
    }

    public function getPrecio(){
        return $this->precio;
    }

    public function setPrecio($precio){
        $this->precio = $precio;
    }
    public function getDolar(){
        return $this->dolar;
    }

    public function setDolar($dolar){
        $this->dolar = $dolar;
    }
    public function getDescripcion(){
        return $this->descripcion;
    }

    public function setDescripcion($descripcion){
        $this->descripcion = $descripcion;
    }
    //Funciones de Servicios Prestados
    public function getCodigo(){
        return $this->codigo;
    }
    public function setCodigo($codigo){
        $this->codigo = $codigo;
    }
    public function getCliente_id(){
        return $this->cliente_id;
    }

    public function setCliente_id($cliente_id){
        $this->cliente_id = $cliente_id;
    }
    public function getEmpleado_id(){
        return $this->empleado_id;
    }
    public function setEmpleado_id($empleado_id){
        $this->empleado_id = $empleado_id;
    }
    public function getVenta_id(){
        return $this->venta_id;
    }
    public function setVenta_id($venta_id){
        $this->venta_id = $venta_id;
    }
    public function getServicios_id(){
        return $this->servicios_id;
    }
    public function setServicios_id($servicios_id){
        $this->servicios_id = $servicios_id;
    }
    public function getServicios_precio(){
        return $this->servicios_precio;
    }
    public function setServicios_precio($servicios_precio){
        $this->servicios_precio = $servicios_precio;
    }

    public function formatoDocumento($ultimoDocumento){
       
        $ultimoDocumento += 1;
        $result = str_pad($ultimoDocumento, 9,'0',STR_PAD_LEFT);
        
        return $result;
    }
    public function ultimoDocumento(){
        try {
            $consulta = parent::connect()->prepare("SELECT codigo FROM servicios_prestados ORDER BY id DESC LIMIT 1");
            $consulta->execute();
            return $consulta->fetch(PDO::FETCH_COLUMN);
        } catch (Exception $ex){
            return $ex->getMessage();
        }
    }

    public function getServicios () {
        try{
            $consulta = parent::connect()->prepare("SELECT id, nombre, descripcion, precio, estatus, created_at FROM servicios WHERE estatus='ACTIVO'ORDER BY created_at DESC");
            $consulta->execute();
            
            return $consulta->fetchAll(PDO::FETCH_OBJ);
            
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }

    // Servicios
    public function listar(){
        try{
            $consulta = parent::connect()->prepare("SELECT id, nombre, descripcion, precio, estatus, created_at FROM servicios ORDER BY estatus, created_at DESC");
            $consulta->execute();
            
            return $consulta->fetchAll(PDO::FETCH_OBJ);
            
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }

    public function registrar(Servicio $servicio){
        try{
            $consulta = parent::connect()->prepare("INSERT INTO servicios(nombre, descripcion, precio) "
                . "VALUES (:nombre, :descripcion, :precio)");
        
        
            $nombre = $servicio->getNombre();
            $descripcion = $servicio->getDescripcion();
            $precio = $servicio->getPrecio();
            
            $consulta->bindParam(":nombre", $nombre);
            $consulta->bindParam(":descripcion", $descripcion);
            $consulta->bindParam(":precio", $precio);
            
            return $consulta->execute();
            
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
    public function actualizar(Servicio $servicio){
        try{
            $consulta = parent::connect()->prepare("UPDATE servicios SET nombre=:nombre, descripcion=:descripcion, precio=:precio,estatus=:estatus WHERE id=:id");


            $id = $servicio->getId();
            $nombre = $servicio->getNombre();
            $descripcion = $servicio->getDescripcion();
            $precio = $servicio->getPrecio();
            $estatus = "ACTIVO";
            
            $consulta->bindParam(":id", $id);
            $consulta->bindParam(":nombre", $nombre);
            $consulta->bindParam(':descripcion', $descripcion);
            $consulta->bindParam(':precio', $precio);
            $consulta->bindParam(":estatus", $estatus);

            return $consulta->execute();
                    
        } catch (Exception $ex) {
            return $ex->getMessage();            
        }
    }
    // Servicios Prestados
    public function registrarPrestado(Servicio $s)
    {
        try {
            $dbh = parent::connect();
            $consulta = $dbh->prepare("INSERT INTO servicios_prestados (codigo, empleado_id, cliente_id, venta_id, usuario_id, dolar)
                VALUES (:codigo, :empleado_id, :cliente_id, :venta_id, :usuario_id, :dolar)");

            $codigo = $s->getCodigo();
            $empleado_id = $s->getEmpleado_id();
            $cliente_id = $s->getCliente_id();
            $venta_id = $s->getVenta_id();
            $dolar = $s->getDolar();
            
            $consulta->bindParam(':codigo', $codigo);
            $consulta->bindParam(':empleado_id', $empleado_id);
            $consulta->bindParam(':cliente_id', $cliente_id);
            $consulta->bindParam(':venta_id', $venta_id);
            $consulta->bindParam(':dolar', $dolar);
            $consulta->bindParam(":usuario_id", $_SESSION['id']);
            $consulta->execute();
            $lastId = $dbh->lastInsertId();

            $servicios_id = $s->getServicios_id();
            $servicios_precio = $s->getServicios_precio();
            $i = 0;
            foreach ($servicios_id as $s) {
                $consulta = $dbh->prepare("INSERT INTO detalle_servicio 
                    (servicio_prestado_id, servicio_id, precio)
                    VALUES (:servicio_prestado_id, :servicio_id, :precio)");
                $consulta->bindParam(':servicio_prestado_id',$lastId);
                $consulta->bindParam(':servicio_id',$servicios_id[$i]);
                $consulta->bindParam(':precio',$servicios_precio[$i]);
                $consulta->execute();
                $i++;
            }
            return true;
        } catch (Exception $ex) {
            return $ex->getMessage(); 
        }
    }
    public function listarPrestados(){
        try{
            $consulta = parent::connect()->prepare("SELECT s.id, s.codigo, Date_format(s.fecha,'%d/%m/%Y') AS fecha, s.estatus, 
                CONCAT(e.nombre,' ',e.apellido) as empleado, CONCAT(c.nombre,' ',c.apellido) as cliente
                FROM servicios_prestados s INNER JOIN clientes c ON s.cliente_id=c.id INNER JOIN empleados e
                ON s.empleado_id=e.id ORDER BY s.created_at DESC");
            $consulta->execute();
            
            return $consulta->fetchAll(PDO::FETCH_OBJ);
            
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }
    public function cambiarEstatus($tabla,$id){
        $conexion = parent::connect();

        try {
            $conexion->beginTransaction();

            $query = $conexion->prepare("SELECT estatus FROM $tabla WHERE id = '$id' LIMIT 1");
            $query->execute();

            $estatus = $query->fetch(PDO::FETCH_COLUMN);

            if($estatus == 'ACTIVO'){
                $query2 = $conexion->prepare("UPDATE $tabla SET estatus = 'INACTIVADO' WHERE id = '$id'");
                // $query3 = $conexion->prepare("UPDATE $tabla2 SET estatus = 'INACTIVO' WHERE $referencia = '$id'");

                $query2->execute();
                // $query3->execute();

                $conexion->commit();

                return true;

            }elseif($estatus == 'INACTIVADO'){
                $query2 = $conexion->prepare("UPDATE $tabla SET estatus = 'ACTIVO' WHERE id = '$id'");
                // $query3 = $conexion->prepare("UPDATE $tabla2 SET estatus = 'ACTIVO' WHERE $referencia = '$id'");

                $query2->execute();
                // $query3->execute();

                $conexion->commit();

                return true;


            }else {
                return false;
            }

        } catch (Exception $e) {
            $conexion->rollBack();
            return $e->getMessage();
        }
    }

}