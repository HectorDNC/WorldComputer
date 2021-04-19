<?php

namespace App\Controllers;

use App\Models\Rol;
use App\Traits\Utility;
use System\Core\Controller;
use System\Core\View;

class RolController extends Controller {

	private $rol;
	
	use Utility;

	public function __construct(){
		$this->rol = new Rol;
    }
    
    public function index(){
        $band = false;
        foreach ($_SESSION['permisos'] as $p):
            if ($p->permiso == "Roles") {     
            $band = true;
        }endforeach;   
        if (!$band) {
            header("Location: ".ROOT);
            return false;
        }
        return View::getView('Rol.index');
    }

	public function listar(){

        $roles = $this->rol->listar();
        
        $editar = false;
        $eliminar = false;
        foreach ($_SESSION['permisos'] as $p):
            if ($p->permiso == "Editar Roles") {     
            $editar = true;
        }endforeach;
        foreach ($_SESSION['permisos'] as $p):
            if ($p->permiso == "Eliminar Roles") {     
            $eliminar = true;
        }endforeach;
        foreach($roles as $rol){

            $rol->button = 
            "<a href=".ROOT."rol/mostrar/". $this->encriptar($rol->id) ."' class='mostrar btn btn-info mr-1 mb-1' title='Consultar'><i class='fas fa-search'></i></a>";
            if ($editar && $rol->id != 1) {
                $rol->button .= "<a href=".ROOT."rol/mostrar/". $this->encriptar($rol->id) ."' class='editar btn btn-warning mr-1 mb-1' title='Editar'><i class='fas fa-pencil-alt'></i></a>";
            }
            if ($eliminar && $rol->id != 1) {
                if($rol->estatus == "ACTIVO"){
                    $rol->button .= "<a href='". $this->encriptar($rol->id) ."' class='eliminar btn btn-danger mr-1 mb-1' title='Eliminar'><i class='fas fa-trash-alt'></i></a>";
                }
                else{
                    $rol->button .= "<a href='". $this->encriptar($rol->id) ."' class='estatusAnulado btn btn-outline-info mr-1 mb-1' title='Activar'><i class='fas fa-trash'></i></a>";
                }
            }
        }

		echo json_encode([
			'data' => $roles
		]);

		exit();
		
    }
    public function guardar()
    {
        $band = false;
        foreach ($_SESSION['permisos'] as $p):
            if ($p->permiso == "Registrar Roles") {     
            $band = true;
        }endforeach;   
        if (!$band) {
            http_response_code(200);

            echo json_encode([
            'titulo' => 'Error',
            'mensaje' => 'No tiene permisos para realizar está acción',
            'tipo' => 'error'
            ]);
            exit();
        }
        $method = $_SERVER['REQUEST_METHOD'];

        if( $method != 'POST'){
            http_response_code(404);
            return false;
        }

        $rol = new Rol();
        $rol->setNombre($_POST['nombre']);
        $rol->setDescripcion($_POST['descripcion']);
        $rol->setPermisos($_POST['permisos']);
        if($this->rol->registrar($rol)) {
            http_response_code(200);

            echo json_encode([
            'titulo' => 'Registro Exitoso',
            'mensaje' => 'Rol registrado en nuestro sistema',
            'tipo' => 'success'
            ]);    
        } else{

            echo json_encode([
            'titulo' => 'Error',
            'mensaje' => $this->rol->getError(),
            'tipo' => 'error'
            ]);  
        }
    }
    public function mostrar($param){
    
        $param = $this->desencriptar($param);
    
        $rol = $this->rol->mostrar($param);
    
        http_response_code(200);
    
        echo json_encode([
            'data' => $rol
        ]);
    }

    public function actualizar(){

        $rol = new rol();

        $rol->setId($_POST['id']);
        $rol->setNombre($_POST['nombre']);
        $rol->setDescripcion($_POST['descripcion']);
        $rol->setPermisos($_POST['permisos']);

        if($this->rol->actualizar($rol)){
        http_response_code(200);

        echo json_encode([
            'titulo' => 'Actualizacion Exitosa',
            'mensaje' => 'Registro actualizado en nuestro sistema',
            'tipo' => 'success'
        ]);
        }else{
        http_response_code(404);

        echo json_encode([
            'titulo' => 'Error',
            'mensaje' => $this->usuario->getError(),
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

        
        if($this->rol->eliminar("roles", $id)){

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
    
        if($this->rol->habilitar("roles", $id)){
    
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