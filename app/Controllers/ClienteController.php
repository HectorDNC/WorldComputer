<?php

namespace App\Controllers;

use App\Models\Cliente;
use App\Traits\Utility;
use System\Core\Controller;
use System\Core\View;


class ClienteController extends Controller{

  use Utility;

  private $cliente;

  public function __construct() {
      $this->cliente = new Cliente;
  }

  public function index(){
    $band = false;
    foreach ($_SESSION['permisos'] as $p):
        if ($p->permiso == "Clientes") {     
        $band = true;
    }endforeach;   
    if (!$band) {
        header("Location: ".ROOT);
        return false;
    }
    return View::getView('Cliente.index');
  }
  
  public function listar(){

    $method = $_SERVER['REQUEST_METHOD'];

    if( $method != 'POST'){
      http_response_code(404);
      return false;
    }

    $clientes = $this->cliente->listar();

    $editar = false;
    $eliminar = false;
    foreach ($_SESSION['permisos'] as $p):
        if ($p->permiso == "Editar Clientes") {     
        $editar = true;
    }endforeach;
    foreach ($_SESSION['permisos'] as $p):
        if ($p->permiso == "Eliminar Clientes") {     
        $eliminar = true;
    }endforeach;
    foreach($clientes as $cliente){

        $cliente->button = 
        "<a href=".ROOT."cliente/mostrar/". $this->encriptar($cliente->id) ."' class='mostrar btn btn-info mr-1 mb-1' title='Consultar'><i class='fas fa-search'></i></a>";
        if ($editar) {
            $cliente->button .= "<a href=".ROOT."cliente/mostrar/". $this->encriptar($cliente->id) ."' class='editar btn btn-warning mr-1 mb-1' title='Editar'><i class='fas fa-pencil-alt'></i></a>";
        }
        if ($eliminar) {
            if($cliente->estatus == "ACTIVO"){
                $cliente->button .= "<a href='". $this->encriptar($cliente->id) ."' class='eliminar btn btn-danger mr-1 mb-1' title='Eliminar'><i class='fas fa-trash-alt'></i></a>";
            }
            else{
                $cliente->button .= "<a href='". $this->encriptar($cliente->id) ."' class='estatusAnulado btn btn-outline-info mr-1 mb-1' title='Activar'><i class='fas fa-trash'></i></a>";
            }
        }
    }

    http_response_code(200);

    echo json_encode([
      'data' => $clientes
    ]);

  }

  public function guardar(){

    $method = $_SERVER['REQUEST_METHOD'];

    if( $method != 'POST'){
      http_response_code(404);
      return false;
    }

    $cliente = new Cliente();

    $cliente->setId($_POST['id']);
    $cliente->setTipoDocumento($_POST['inicial_documento']);
    $cliente->setDocumento($_POST['documento']);
    $cliente->setNombre(strtoupper($this->limpiaCadena($_POST['nombre'])));
    $cliente->setApellido(strtoupper($this->limpiaCadena($_POST['apellido'])));
    $cliente->setDireccion(strtoupper($this->limpiaCadena($_POST['direccion'])));
    $cliente->setTelefono(strtoupper($this->limpiaCadena($_POST['telefono'])));
    $cliente->setEmail(strtoupper($this->limpiaCadena($_POST['correo'])));
    $cliente->setEstatus("ACTIVO");


    $documento = $cliente->getTipoDocumento()."-".$cliente->getDocumento();

    $consultaDocumento = $this->cliente->query("SELECT * FROM clientes WHERE documento='$documento'" ); // Verifica inexistencia de cedula, sies igual a la actual no la toma en cuenta puesto que si registramos un cambio en el nombre se mantiene la misma cedula y afectaria la consulta.

    if ($consultaDocumento->rowCount() >= 1) {

      http_response_code(200);
      
      echo json_encode([
        'titulo' => 'Documento Registrado',
        'mensaje' => $documento . ' Se encuentra registrado en nuestro sistema',
        'tipo' => 'error'
      ]);

      return false;

    }

    $this->cliente->registrar($cliente);

    http_response_code(200);

    echo json_encode([
      'titulo' => 'Registro Exitoso',
      'mensaje' => 'Cliente registrado en nuestro sistema',
      'tipo' => 'success'
    ]);


  }

  public function actualizar(){

    $cliente = new Cliente();

    $cliente->setId($_POST['id']);
    $cliente->setTipoDocumento($_POST['inicial_documento']);
    $cliente->setDocumento($_POST['documento']);
    $cliente->setNombre(strtoupper($this->limpiaCadena($_POST['nombre'])));
    $cliente->setApellido(strtoupper($this->limpiaCadena($_POST['apellido'])));
    $cliente->setDireccion(strtoupper($this->limpiaCadena($_POST['direccion'])));
    $cliente->setTelefono(strtoupper($this->limpiaCadena($_POST['telefono'])));
    $cliente->setEmail(strtoupper($this->limpiaCadena($_POST['correo'])));
    $cliente->setEstatus("ACTIVO");

    if($this->cliente->actualizar($cliente)){
      http_response_code(200);

      echo json_encode([
        'titulo' => 'Actualizacion Exitosa',
        'mensaje' => 'Registro actualizado en nuestro sistema',
        'tipo' => 'success'
      ]);
    }else{

      echo json_encode([
        'titulo' => 'Error al Actualizar',
        'mensaje' => $this->cliente->getError(),
        'tipo' => 'error'
      ]);
    }

  }

  public function mostrar($param){

    $param = $this->desencriptar($param);
    
    $cliente = $this->cliente->getOne('clientes', $param);

    http_response_code(200);

    echo json_encode([
      'data' => $cliente
    ]);
  }

  public function eliminar($id){

    $method = $_SERVER['REQUEST_METHOD'];

    if( $method != 'POST'){
      http_response_code(404);
      return false;
    }

    $id = $this->desencriptar($id);

    if($this->cliente->eliminar("clientes", $id)){

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

    if($this->cliente->habilitar("clientes", $id)){

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
