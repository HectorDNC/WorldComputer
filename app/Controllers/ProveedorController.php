<?php

namespace App\Controllers;

use App\Models\Proveedor;
use App\Traits\Utility;
use System\Core\Controller;
use System\Core\View;

class ProveedorController extends Controller{
    private $proveedor;

    use Utility;

    public function __construct(){
        $this->proveedor = new Proveedor;
    }

    public function index(){
      $band = false;
      foreach ($_SESSION['permisos'] as $p):
          if ($p->permiso == "Proveedores") {     
          $band = true;
      }endforeach;   
      if (!$band) {
          header("Location: ".ROOT);
          return false;
      }
      return View::getView('Proveedor.index');
    }

    public function mostrar($param){

        $param = $this->desencriptar($param);
        
        $proveedor = $this->proveedor->getOne('proveedores', $param);

        http_response_code(200);

        echo json_encode([
            'data' => $proveedor
        ]);
    }

    public function listar(){

        $method = $_SERVER['REQUEST_METHOD'];

        if( $method != 'POST'){
        http_response_code(404);
        return false;
        }

        $proveedores = $this->proveedor->listar();

        $editar = false;
        $eliminar = false;
        foreach ($_SESSION['permisos'] as $p):
            if ($p->permiso == "Editar Proveedores") {     
            $editar = true;
        }endforeach;
        foreach ($_SESSION['permisos'] as $p):
            if ($p->permiso == "Eliminar Proveedores") {     
            $eliminar = true;
        }endforeach;
        foreach($proveedores as $proveedor){

            $proveedor->button = 
            "<a href=".ROOT."proveedor/mostrar/". $this->encriptar($proveedor->id) ."' class='mostrar btn btn-info mr-1 mb-1' title='Consultar'><i class='fas fa-search'></i></a>";
            if ($editar) {
                $proveedor->button .= "<a href=".ROOT."proveedor/mostrar/". $this->encriptar($proveedor->id) ."' class='editar btn btn-warning mr-1 mb-1' title='Editar'><i class='fas fa-pencil-alt'></i></a>";
            }
            if ($eliminar) {
                if($proveedor->estatus == "ACTIVO"){
                    $proveedor->button .= "<a href='". $this->encriptar($proveedor->id) ."' class='eliminar btn btn-danger mr-1 mb-1' title='Eliminar'><i class='fas fa-trash-alt'></i></a>";
                }
                else{
                    $proveedor->button .= "<a href='". $this->encriptar($proveedor->id) ."' class='estatusAnulado btn btn-outline-info mr-1 mb-1' title='Activar'><i class='fas fa-trash'></i></a>";
                }
            }
        }

        http_response_code(200);

        echo json_encode([
        'data' => $proveedores
        ]);

    }

    public function guardar(){

        $method = $_SERVER['REQUEST_METHOD'];
    
        if( $method != 'POST'){
          http_response_code(404);
          return false;
        }
    
        $proveedor = new Proveedor();
    
        $proveedor->setId($_POST['id']);
        $proveedor->setTipoDocumento($_POST['inicial_documento']);
        $proveedor->setDocumento($_POST['documento']);
        $proveedor->setNombre(strtoupper($this->limpiaCadena($_POST['nombre'])));
        $proveedor->setDireccion(strtoupper($this->limpiaCadena($_POST['direccion'])));
        $proveedor->setTelefono(strtoupper($this->limpiaCadena($_POST['telefono'])));
        $proveedor->setEmail(strtoupper($this->limpiaCadena($_POST['correo'])));
        $proveedor->setEstatus("ACTIVO");
    
    
        $documento = $proveedor->getTipoDocumento()."-".$proveedor->getDocumento();
    
        $consultaDocumento = $this->proveedor->query("SELECT * FROM proveedores WHERE documento='$documento'" ); // Verifica inexistencia de cedula, sies igual a la actual no la toma en cuenta puesto que si registramos un cambio en el nombre se mantiene la misma cedula y afectaria la consulta.
    
        if ($consultaDocumento->rowCount() >= 1) {
    
          http_response_code(200);
          
          echo json_encode([
            'titulo' => 'Documento Registrado',
            'mensaje' => $documento . ' Se encuentra registrado en nuestro sistema',
            'tipo' => 'error'
          ]);
    
          return false;
    
        }else {

          if($this->proveedor->registrar($proveedor)) {
              http_response_code(200);

              echo json_encode([
              'titulo' => 'Registro Exitoso',
              'mensaje' => 'Proveedor registrado en nuestro sistema',
              'tipo' => 'success'
              ]);    
          } else{

              echo json_encode([
              'titulo' => 'Error',
              'mensaje' => $this->proveedor->getError(),
              'tipo' => 'error'
              ]);  
          }
      }  
        
    
    
    }

    public function actualizar(){

        $proveedor = new Proveedor();
    
        $proveedor->setId($_POST['id']);
        $proveedor->setTipoDocumento($_POST['inicial_documento']);
        $proveedor->setDocumento($_POST['documento']);
        $proveedor->setNombre(strtoupper($this->limpiaCadena($_POST['nombre'])));
        $proveedor->setDireccion(strtoupper($this->limpiaCadena($_POST['direccion'])));
        $proveedor->setTelefono(strtoupper($this->limpiaCadena($_POST['telefono'])));
        $proveedor->setEmail(strtoupper($this->limpiaCadena($_POST['correo'])));
        $proveedor->setEstatus("ACTIVO");
    
        if($this->proveedor->actualizar($proveedor)){
          http_response_code(200);
    
          echo json_encode([
            'titulo' => 'Actualizacion Exitosa',
            'mensaje' => 'Registro actualizado en nuestro sistema',
            'tipo' => 'success'
          ]);
        }else{    
          echo json_encode([
            'titulo' => 'Error al Actualizar',
            'mensaje' => $this->proveedor->getError(),
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
  
      if($this->proveedor->eliminar("proveedores", $id)){
  
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
  
      if($this->proveedor->habilitar("proveedores", $id)){
  
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