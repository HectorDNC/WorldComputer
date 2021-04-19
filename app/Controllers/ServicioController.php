<?php

namespace App\Controllers;

use App\Models\Servicio;
use App\Models\Cliente;
use App\Models\Empleado;
use App\Models\Venta;
use App\Models\Salida;
use App\Models\Producto;

use App\Models\Compra;
use App\Models\Entrada;
use App\Models\Proveedor;
use App\Models\Configuracion;
use PDO;
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
      $this->salida = new Salida;
  }

  public function index(){
    $band = false;
    foreach ($_SESSION['permisos'] as $p):
        if ($p->permiso == "Servicios") {     
        $band = true;
    }endforeach;   
    if (!$band) {
        header("Location: ".ROOT);
        return false;
    }
    return View::getView('Servicio.index');
  }


  public function ProvidedServices () {
    $band = false;
    foreach ($_SESSION['permisos'] as $p):
        if ($p->permiso == "Servicios Prestados") {     
        $band = true;
    }endforeach;   
    if (!$band) {
        header("Location: ".ROOT);
        return false;
    }
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

    $eliminar = false;            
    foreach ($_SESSION['permisos'] as $p):
        if ($p->permiso == "Anular Servicios Prestados") {     
        $eliminar = true;
    }endforeach;

    foreach($servicios as $servicio){
        if ($eliminar) {
            if($servicio->estatus == 'ACTIVO'){
                $servicio->estado = "<a href='" . $this->encriptar($servicio->id) . "' class='btn btn-success estatus'><i class='fas fa-check-circle'></i> Activa</a>";
            }else{
                $servicio->estado = "<a href='" . $this->encriptar($servicio->id) . "' class='btn btn-danger estatus'><i class='fas fa-window-close'></i> Anulada</a>";
            }
        }
        else{
            $servicio->estado=$servicio->estatus;
        }                
        $servicio->button = 
        "<a href='mostrarPrestado/". $this->encriptar($servicio->id) ."' class='mostrar btn btn-info mr-1 mb-1'><i class='fas fa-search'></i></a>".
        "<a href='servicioPrestadoPDF/". $this->encriptar($servicio->id) ."' class='pdf btn btn-danger mr-1 mb-1'><i class='fas fa-file-pdf'></i></a>";
    
    }      

    http_response_code(200);

    echo json_encode([
      'data' => $servicios
    ]);

}

  public function create(){
    $band = false;
    foreach ($_SESSION['permisos'] as $p):
        if ($p->permiso == "Registrar Servicios Prestados") {     
        $band = true;
    }endforeach;   
    if (!$band) {
        header("Location: ".ROOT);
        return false;
    }
    $clientes = $this->cliente->getAll('clientes', "estatus = 'ACTIVO'");
    $productos = $this->producto->getAll('v_inventario', "estatus = 'ACTIVO' AND stock > 0 AND precio_venta != 'null'");
    $servicios = $this->servicio->listar();
    $empleados = $this->empleado->listarCargo('TECNICO');
    $config = new Configuracion;
    $dolar = $config->obtenerDolar();
    $iva = $config->obtenerIva();

    return View::getView('Servicio.create', 
        [ 
            'clientes' => $clientes,
            'servicios' => $servicios,
            'productos' => $productos,
            'empleados' => $empleados,
            'iva' => $iva,
            'dolar' => $dolar
        ]);
  }


    public function agregarPrestado(){
      #=== VENTA ===#
 
      if (isset($_POST['productos'])) {
        $venta = new Venta;
        $num_documento = $this->venta->formatoDocumento($this->venta->ultimoDocumento());
        $venta->setNumeroDocumento($num_documento);
        $venta->setPersonaId($_POST['cliente']);
        $venta->setTotal($_POST['total']);
        $venta->setDolar($_POST['dolar']);
        $venta->setIva($_POST['iva']);
        $lastId = $venta->registrar($venta);

        $productos = $_POST['productos'];
        $cantidad = $_POST['cantidades'];
        $precio = $_POST['precios'];
        $contador = 0;
        foreach($productos AS $producto){

            $salida = new Salida();
            $salida->setProductoId($productos[$contador]);
            $salida->setVentaId($lastId);
            $salida->setCantidad($cantidad[$contador]);
            $salida->setPrecio($precio[$contador]);

            $this->salida->registrar($salida);

            $contador++;
        }
      }
      
      #=== DETALLES SERVICIO ===#
      $servicio = new Servicio();
      $num_documento = $this->servicio->formatoDocumento($this->servicio->ultimoDocumento());
      $servicio->setCodigo($num_documento);
      $servicio->setCliente_id($_POST['cliente']);
      $servicio->setEmpleado_id($_POST['empleado']);
      $servicio->setDolar($_POST['dolar']);
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

    public function cambiarEstatus($param){
      $id = $this->desencriptar($param);
      $servicio = $this->servicio->getOne("servicios_prestados", $id);
      $estatus = $this->servicio->cambiarEstatus('servicios_prestados', $id);
      if ($servicio->venta_id!=NULL) {
        $this->servicio->cambiarEstatus('ventas',$servicio->venta_id);
      }

      if($estatus){
          http_response_code(200);

          echo json_encode([
              'titulo' => 'Estatus actualizado',
              'mensaje' => 'Estatus del servicio prestado actualizado correctamente',
              'tipo' => 'success'
          ]);

          exit();
      }else {
          http_response_code(200);

          echo json_encode([
              'titulo' => 'Error al Cambiar estatus',
              'mensaje' => 'Ocurrió un error al intentar cambiar el estatus',
              'tipo' => 'error'
          ]);

          exit();
      }
  }
  public function mostrarPrestado($param){
    //Servicio Prestado
    $idServicio = $this->desencriptar($param);
    $query0 = $this->servicio->query("SELECT s.id, s.codigo,s.venta_id,Date_format(s.fecha,'%d/%m/%Y') AS fecha, Date_format(s.fecha,'%H:%i') AS hora,
      CONCAT(e.nombre,' ',e.apellido) as empleado, e.documento AS empleado_documento, e.direccion as empleado_direccion,
      CONCAT(c.nombre,' ',c.apellido) as cliente, c.documento AS cliente_documento, c.direccion as cliente_direccion, s.dolar 
      FROM servicios_prestados s INNER JOIN empleados e ON s.empleado_id=e.id 
      INNER JOIN clientes c ON s.cliente_id=c.id
      WHERE s.id=$idServicio");
    $servicioPrestado = $query0->fetch(PDO::FETCH_OBJ);
    //Servicios
    $query01 = $this->servicio->query("SELECT s.id, s.nombre, s.descripcion, d.precio FROM detalle_servicio d
      INNER JOIN servicios s ON d.servicio_id=s.id
      WHERE d.servicio_prestado_id=$servicioPrestado->id");
    $servicios = $query01->fetchAll(PDO::FETCH_OBJ);
    //Venta
    if ($servicioPrestado->venta_id != NULL) {
      $idVenta = $servicioPrestado->venta_id;

      $query = $this->venta->query("SELECT v.id, v.codigo, Date_format(v.fecha,'%d/%m/%Y') AS fecha, Date_format(v.fecha,'%H:%i') AS hora, c.documento AS rif_cliente, c.nombre AS cliente, c.direccion, v.estatus, v.dolar, v.impuesto FROM
          ventas v
              LEFT JOIN
          clientes c
              ON v.cliente_id = c.id
          WHERE v.id = '$idVenta' AND v.estatus='ACTIVO' OR v.id = '$idVenta' AND v.estatus='INACTIVADO' LIMIT 1");

      $query2 = $this->venta->query("SELECT v.id, p.codigo, p.nombre, dv.cantidad, dv.precio FROM 
          productos p 
              JOIN
          detalle_venta dv
              ON p.id = dv.producto_id
              JOIN
          ventas v 
              ON dv.venta_id = v.id
          WHERE v.id = '$idVenta'");
          
      // Encabezado Venta
      $venta = $query->fetch(PDO::FETCH_OBJ);

      // Detalles Venta
      $productos = $query2->fetchAll(PDO::FETCH_OBJ);
      if ($venta == false) {
        $venta = NULL;
      }
      http_response_code(200);

      echo json_encode([
          'servicio_prestado'=>$servicioPrestado,
          'servicios'=>$servicios,
          'venta' => $venta,
          'productos' => $productos,
      ]);
    }
    else{
      http_response_code(200);

      echo json_encode([
          'servicio_prestado'=>$servicioPrestado,
          'servicios'=>$servicios
      ]);
    }

    exit();
}
public function servicioPrestadoPDF($param){

  //Servicio Prestado
  $idServicio = $this->desencriptar($param);
  $query0 = $this->servicio->query("SELECT s.id, s.codigo,s.venta_id,s.dolar,Date_format(s.fecha,'%d/%m/%Y') AS fecha, 
    CONCAT(e.nombre,' ',e.apellido) as empleado, e.documento AS empleado_documento, e.direccion as empleado_direccion,
    CONCAT(c.nombre,' ',c.apellido) as cliente, c.documento AS cliente_documento, c.direccion as cliente_direccion 
    FROM servicios_prestados s INNER JOIN empleados e ON s.empleado_id=e.id 
    INNER JOIN clientes c ON s.cliente_id=c.id
    WHERE s.id=$idServicio");
  $servicioPrestado = $query0->fetch(PDO::FETCH_OBJ);
  //Servicios
  $query01 = $this->servicio->query("SELECT s.id, s.nombre, s.descripcion, d.precio FROM detalle_servicio d
    INNER JOIN servicios s ON d.servicio_id=s.id
    WHERE d.servicio_prestado_id=$servicioPrestado->id");
  $servicios = $query01->fetchAll(PDO::FETCH_OBJ);
  //Venta
  if ($servicioPrestado->venta_id != NULL) {
    $idVenta = $servicioPrestado->venta_id;

    $query = $this->venta->query("SELECT v.id, v.codigo, v.dolar,v.impuesto as iva,Date_format(v.fecha,'%d/%m/%Y') AS fecha, Date_format(v.fecha,'%H:%i') AS hora, c.documento AS rif_cliente, c.nombre AS cliente, c.direccion, v.estatus FROM
        ventas v
            LEFT JOIN
        clientes c
            ON v.cliente_id = c.id
        WHERE v.id = '$idVenta' AND v.estatus='ACTIVO' OR v.id = '$idVenta' AND v.estatus='INACTIVADO' LIMIT 1");

    $query2 = $this->venta->query("SELECT v.id, p.codigo, p.nombre, dv.cantidad, dv.precio FROM 
      productos p 
          JOIN
      detalle_venta dv
          ON p.id = dv.producto_id
          JOIN
      ventas v 
          ON dv.venta_id = v.id
      WHERE v.id = '$idVenta'");
        
    // Encabezado Venta
    $venta = $query->fetch(PDO::FETCH_OBJ);

    // Detalles Venta
    $productos = $query2->fetchAll(PDO::FETCH_OBJ);
    if ($venta == false) {
      $venta = NULL;
    }
    ob_start();

    View::getViewPDF('FormatosPDF.Servicio', [
      'servicio_prestado'=>$servicioPrestado,
        'servicios'=>$servicios,
        'venta' => $venta,
        'productos' => $productos,
    ]);
  }
  else{
    ob_start();

    View::getViewPDF('FormatosPDF.Servicio', [
      'servicio_prestado'=>$servicioPrestado,
      'servicios'=>$servicios
    ]);
  }

  

  $html = ob_get_clean();

  $this->crearPDF($html);

}
    // CRUD Servicios

    public function listar(){

      $method = $_SERVER['REQUEST_METHOD'];
  
      if( $method != 'POST'){
      http_response_code(404);
      return false;
      }

      $servicios = $this->servicio->listar();
      $config = new Configuracion;
      $dolar = $config->obtenerDolar();

      $editar = false;
      $eliminar = false;
      foreach ($_SESSION['permisos'] as $p):
          if ($p->permiso == "Editar Servicios") {     
          $editar = true;
      }endforeach;
      foreach ($_SESSION['permisos'] as $p):
          if ($p->permiso == "Eliminar Servicios") {     
          $eliminar = true;
      }endforeach;
      foreach($servicios as $servicio){

          $servicio->button = 
          "<a href=".ROOT."servicio/mostrar/". $this->encriptar($servicio->id) ."' class='mostrar btn btn-info mr-1 mb-1' title='Consultar'><i class='fas fa-search'></i></a>";
          if ($editar) {
              $servicio->button .= "<a href=".ROOT."servicio/mostrar/". $this->encriptar($servicio->id) ."' class='editar btn btn-warning mr-1 mb-1' title='Editar'><i class='fas fa-pencil-alt'></i></a>";
          }
          if ($eliminar) {
              if($servicio->estatus == "ACTIVO"){
                  $servicio->button .= "<a href='". $this->encriptar($servicio->id) ."' class='eliminar btn btn-danger mr-1 mb-1' title='Eliminar'><i class='fas fa-trash-alt'></i></a>";
              }
              else{
                  $servicio->button .= "<a href='". $this->encriptar($servicio->id) ."' class='estatusAnulado btn btn-outline-info mr-1 mb-1' title='Activar'><i class='fas fa-trash'></i></a>";
              }
          }
          $servicio->precioBss = $servicio->precio * $dolar;
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

      if( $method != 'POST'){
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
    public function habilitar($id){

      $method = $_SERVER['REQUEST_METHOD'];
  
      if( $method != 'POST'){
        http_response_code(404);
        return false;
      }
  
      $id = $this->desencriptar($id);
  
      if($this->servicio->habilitar("servicios", $id)){
  
        http_response_code(200);
  
        echo json_encode([
          'titulo' => 'Registro habilitado!',
          'mensaje' => 'Registro habilitado en nuestro sistema',
          'tipo' => 'success'
        ]);
      }else{
        http_response_code(404);
  
        echo json_encode([
          'titulo' => 'Ocurio un error!',
          'mensaje' => 'No se pudo habilitar el registro',
          'tipo' => 'error'
        ]);
      }
      
  
  }
}
