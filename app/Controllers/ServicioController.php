<?php

namespace App\Controllers;

use App\Models\Servicio;
use App\Models\Cliente;
use App\Models\Empleado;
use App\Models\Venta;
use App\Models\DetalleVenta;
use App\Models\Producto;

use App\Models\Compra;
use App\Models\Entrada;
use App\Models\Proveedor;

use App\Traits\Utility;
use System\Core\Controller;
use System\Core\View;

class ServicioController extends Controller{

  use Utility;

  private $servicio;

  public function __construct() {
      $this->cliente = new Cliente;
      $this->servicio = new Servicio;
      $this->empleado = new Empleado;
      $this->producto = new Producto;
      $this->venta = new Venta;
      $this->detalleVenta = new DetalleVenta;
  }

  public function index(){
    return View::getView('Servicio.index');
  }


  public function ProvidedServices () {

    $empleados = $this->empleado->listarCargo('TECNICO');
    $ventas = $this->venta->listar();
    $servicios = $this->servicio->listar();

    return View::getView('Servicio.providedServices');
  }

  public function listarPrestados(){

    $method = $_SERVER['REQUEST_METHOD'];

        if( $method != 'POST'){
        http_response_code(404);
        return false;
        }

        $servicios = $this->servicio->listarPrestados();

        foreach($servicios as $servicio){

        $servicio->button = 
                "<a href='/WorldComputer/Servicio/mostrarPrestado/". $this->encriptar($servicio->id) ."' class='mostrar btn btn-info'><i class='fas fa-search'></i></a>".
                "<a href='/WorldComputer/Servicio/servicioPrestadoPDF/". $this->encriptar($servicio->id) ."' class='pdf btn btn-danger m-1'><i class='fas fa-file-pdf'></i></a>";

    }

    http_response_code(200);

    echo json_encode([
    'data' => $servicios
    ]);

}

  public function create(){

    $clientes = $this->cliente->getAll('clientes', "estatus = 'ACTIVO'");
    $productos = $this->producto->getAll('v_inventario', "estatus = 'ACTIVO' AND stock > 0 AND precio_venta != 'null'");
    $servicios = $this->servicio->listar();
    $empleados = $this->empleado->listarCargo('TECNICO');
    $iva = $this->servicio->getValorColumna('impuestos','valor','id = 2');

    return View::getView('Servicio.create', 
        [ 
            'clientes' => $clientes,
            'servicios' => $servicios,
            'productos' => $productos,
            'empleados' => $empleados,
            'iva' => $iva
        ]);
  }

  // CRUD Servicios Prestados

    public function agregarPrestado(){
      #=== VENTA ===#
 
      if (isset($_POST['productos'])) {
        $venta = new Venta;
        $num_documento = $this->venta->formatoDocumento($this->venta->ultimoDocumento());
        $venta->setNumeroDocumento($num_documento);
        $venta->setPersonaId($_POST['cliente']);
        $venta->setTotal($_POST['total']);
        $lastId = $venta->registrar($venta);

        $productos = $_POST['productos'];
        $cantidad = $_POST['cantidades'];
        $precio = $_POST['precios'];
        $contador = 0;
        foreach($productos AS $producto){

            $detalleVenta = new DetalleVenta();
            $detalleVenta->setProductoId($productos[$contador]);
            $detalleVenta->setVentaId($lastId);
            $detalleVenta->setCantidad($cantidad[$contador]);
            $detalleVenta->setPrecio($precio[$contador]);

            $this->detalleVenta->registrar($detalleVenta);

            $contador++;
        }
      }
      
      #=== DETALLES SERVICIO ===#
      $servicio = new Servicio();
      $num_documento = $this->servicio->formatoDocumento($this->servicio->ultimoDocumento());
      $servicio->setCodigo($num_documento);
      $servicio->setCliente_id($_POST['cliente']);
      $servicio->setEmpleado_id($_POST['empleado']);
      if (isset($lastId)) {
        $servicio->setVenta_id($lastId);
      }      
      $servicio->setServicios_id($_POST['servicios']);
      $servicio->setServicios_precio($_POST['servicios_precio']);
      $result = $this->servicio->registrarPrestado($servicio);

      if ($result) {
        http_response_code(200);

        echo json_encode([
          'titulo' => 'Servicio Prestado Registrado!',
          'mensaje' => 'Se ha registrado correctamente el servicio prestado',
          'tipo' => 'success'
        ]);
      }
      else{
        http_response_code(200);

        echo json_encode([
          'titulo' => 'Error al Registrar!',
          'mensaje' => 'Ocurrió un error inesperado al registrar el servicio prestado',
          'tipo' => 'error'
        ]);
      }

      
    }

    public function mostrarPrestado($param){
    
      $param = $this->desencriptar($param);

      $servicio = $this->servicio->getOne('detalle_servicio', $param);

      http_response_code(200);

      echo json_encode([
      'data' => $servicio
      ]);
    }
    // CRUD Servicios

    public function listar(){

      $method = $_SERVER['REQUEST_METHOD'];
  
          if( $method != 'POST'){
          http_response_code(404);
          return false;
          }
  
          $servicios = $this->servicio->listar();
  
          foreach($servicios as $servicio){
  
          $servicio->button = 
          "<a href='/WorldComputer/Servicio/mostrar/". $this->encriptar($servicio->id) ."' class='mostrar btn btn-info'><i class='fas fa-search'></i></a>".
          "<a href='/WorldComputer/Servicio/mostrar/". $this->encriptar($servicio->id) ."' class='editar btn btn-warning m-1'><i class='fas fa-pencil-alt'></i></a>".
          "<a href='". $this->encriptar($servicio->id) ."' class='eliminar btn btn-danger'><i class='fas fa-trash-alt'></i></a>";
  
      }
  
      http_response_code(200);
  
      echo json_encode([
      'data' => $servicios
      ]);
  
  }
    public function guardar(){

      $method = $_SERVER['REQUEST_METHOD'];
  
      if( $method != 'POST'){
        http_response_code(404);
        return false;
      }
  
      $servicio = new Servicio();
  
      $servicio->setNombre(strtoupper($this->limpiaCadena($_POST['nombre'])));
      $servicio->setPrecio($_POST['precio']);

      if($_POST['descripcion'] != ''){
          $servicio->setDescripcion(strtoupper($this->limpiaCadena($_POST['descripcion'])));
      }else{
          $servicio->setDescripcion('N/A');
      }
  

      $nombre = $servicio->getNombre();

      $consulta = $this->servicio->query("SELECT * FROM servicios WHERE nombre='$nombre'" ); // Verifica inexistencia de categoría, si es igual a la actual no la toma en cuenta puesto que si registramos un cambio en el nombre se mantiene la misma cedula y afectaria la consulta.
  
      if ($consulta->rowCount() >= 1) {
  
        http_response_code(200);
        
        echo json_encode([
          'titulo' => 'Servicio Registrado',
          'mensaje' => $nombre . ' Se encuentra registrado en nuestro sistema',
          'tipo' => 'error'
        ]);
  
        return false;
  
      }
  
      if($this->servicio->registrar($servicio)){
          http_response_code(200);
      
          echo json_encode([
            'titulo' => 'Registro Exitoso',
            'mensaje' => 'Servicio registrado en nuestro sistema',
            'tipo' => 'success'
          ]);
      }else{
          http_response_code(200);
      
          echo json_encode([
            'titulo' => 'Error Inesperado',
            'mensaje' => 'Ocurrio un error durante la operacion!',
            'tipo' => 'error'
          ]);
      }
  
  
  
  }
    public function mostrar($param){
    
      $param = $this->desencriptar($param);

      $servicio = $this->servicio->getOne('servicios', $param);

      http_response_code(200);

      echo json_encode([
      'data' => $servicio
      ]);
    }
    public function actualizar(){

      $method = $_SERVER['REQUEST_METHOD'];
    
        if( $method != 'POST'){
          http_response_code(404);
          return false;
        }
    
        $servicio = new Servicio();
        $servicio->setId($_POST['id']);
    
        $servicio->setNombre(strtoupper($this->limpiaCadena($_POST['nombre'])));
        $servicio->setPrecio($_POST['precio']);

        if($_POST['descripcion'] != ''){
            $servicio->setDescripcion(strtoupper($this->limpiaCadena($_POST['descripcion'])));
        }else{
            $servicio->setDescripcion('N/A');
        }

        $id = $servicio->getId(); 
        $nombre = $servicio->getNombre();
    
        $consulta = $this->servicio->query("SELECT * FROM servicios WHERE nombre='$nombre' AND id<>$id");

        if( $consulta->rowCount() >= 1 ){
          http_response_code(200);
    
          echo json_encode([
            'titulo' => "Servicio $nombre ya existe!",
            'mensaje' => 'Por favor intente de nuevo',
            'tipo' => 'error'
          ]);

          return false;
        }

        if($this->servicio->actualizar($servicio)){
          http_response_code(200);
    
          echo json_encode([
            'titulo' => 'Actualización Exitosa',
            'mensaje' => 'Registro actualizado en nuestro sistema',
            'tipo' => 'success'
          ]);
        }else{
          http_response_code(200);
    
          echo json_encode([
            'titulo' => 'Error al Actualizar',
            'mensaje' => 'Ocurrio un error durante la actualización',
            'tipo' => 'error'
          ]);
        }
    
    }

    public function eliminar($id){
    
      $method = $_SERVER['REQUEST_METHOD'];

      if( $method != 'DELETE'){
      http_response_code(404);
      return false;
      }
      $id = $this->desencriptar($id);

      
      if($this->servicio->eliminar("servicios", $id)){

          http_response_code(200);

          echo json_encode([
              'titulo' => 'Registro eliminado!',
              'mensaje' => 'Registro eliminado en nuestro sistema',
              'tipo' => 'success'
          ]);
      }else{
          http_response_code(404);

          echo json_encode([
              'titulo' => 'Ocurio un error!',
              'mensaje' => 'No se pudo eliminar el registro',
              'tipo' => 'error'
          ]);
      }
    }
}
