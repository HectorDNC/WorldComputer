<?php

namespace app\Controllers;

use App\Models\Rol;
use App\Models\Usuario;
use App\Models\Asistencia;
use App\Traits\Utility;
use System\Core\Controller;
use System\Core\View;


class UsuarioController extends Controller{

    use Utility;
    
    private $usuario;
    private $rol;
    private $asistencia;
    
    public function __construct() {
        
        $this->usuario = new Usuario;
        $this->rol = new Rol();
    }

    public function index(){
        $band = false;
        foreach ($_SESSION['permisos'] as $p):
            if ($p->permiso == "Usuarios") {     
            $band = true;
        }endforeach;   
        if (!$band) {
            header("Location: ".ROOT);
            return false;
        }
        $roles = $this->rol->listar();
        
        return View::getView('Usuario.index', 'roles', $roles);
    }

    public function listar(){

        $method = $_SERVER['REQUEST_METHOD'];

        if( $method != 'POST'){
            http_response_code(404);
            return false;
        }

        $usuarios = $this->usuario->listar();
        $editar = false;
        $eliminar = false;
        foreach ($_SESSION['permisos'] as $p):
            if ($p->permiso == "Editar Usuarios") {     
            $editar = true;
        }endforeach;
        foreach ($_SESSION['permisos'] as $p):
            if ($p->permiso == "Eliminar Usuarios") {     
            $eliminar = true;
        }endforeach;
        foreach($usuarios as $usuario){

            $usuario->button = 
            "<a href=".ROOT."usuario/mostrar/". $this->encriptar($usuario->id) ."' class='mostrar btn btn-info mr-1 mb-1' title='Consultar'><i class='fas fa-search'></i></a>";
            if ($editar && $usuario->id != 1) {
                $usuario->button .= "<a href=".ROOT."usuario/mostrar/". $this->encriptar($usuario->id) ."' class='editar btn btn-warning mr-1 mb-1' title='Editar'><i class='fas fa-pencil-alt'></i></a>";
            }
            if ($eliminar && $usuario->id != 1) {
                if($usuario->estatus == "ACTIVO"){
                    $usuario->button .= "<a href='". $this->encriptar($usuario->id) ."' class='eliminar btn btn-danger mr-1 mb-1' title='Eliminar'><i class='fas fa-trash-alt'></i></a>";
                }
                else{
                    $usuario->button .= "<a href='". $this->encriptar($usuario->id) ."' class='estatusAnulado btn btn-outline-info mr-1 mb-1' title='Activar'><i class='fas fa-trash'></i></a>";
                }
            }
        }
        

        http_response_code(200);

        echo json_encode([
        'data' => $usuarios
        ]);

    }

    public function guardar(){

        $method = $_SERVER['REQUEST_METHOD'];

        if( $method != 'POST'){
            http_response_code(404);
            return false;
        }

        $contrasena = $this->encriptar($this->limpiaCadena($_POST['contrasena']));

        $usuario = new Usuario();

        $usuario->setId($_POST['id']);
        $usuario->setTipoDocumento($_POST['inicial_documento']);
        $usuario->setDocumento($_POST['documento']);
        $usuario->setNombre(strtoupper($this->limpiaCadena($_POST['nombre'])));
        $usuario->setApellido(strtoupper($this->limpiaCadena($_POST['apellido'])));
        $usuario->setDireccion(strtoupper($this->limpiaCadena($_POST['direccion'])));
        $usuario->setTelefono(strtoupper($this->limpiaCadena($_POST['telefono'])));
        $usuario->setEmail(strtoupper($this->limpiaCadena($_POST['correo'])));
        $usuario->setEstatus("ACTIVO");
        $usuario->setUsuario(strtoupper($this->limpiaCadena($_POST['usuario'])));
        $usuario->setPassword($contrasena);
        $usuario->setRolId(strtoupper($this->limpiaCadena($_POST['rolUsuario'])));

        $documento = $usuario->getTipoDocumento()."-".$usuario->getDocumento();

        $consultaDocumento = $this->usuario->query("SELECT * FROM usuarios WHERE documento='$documento'" ); // Verifica inexistencia de cedula, sies igual a la actual no la toma en cuenta puesto que si registramos un cambio en el nombre se mantiene la misma cedula y afectaria la consulta.

        if ($consultaDocumento->rowCount() >= 1) {

        http_response_code(200);

        echo json_encode([
            'titulo' => 'Documento Registrado',
            'mensaje' => $documento . ' Se encuentra registrado en nuestro sistema',
            'tipo' => 'error'
        ]);

        return false;

        } else {

            if($this->usuario->registrar($usuario)) {
                http_response_code(200);

                echo json_encode([
                'titulo' => 'Registro Exitoso',
                'mensaje' => 'Cliente registrado en nuestro sistema',
                'tipo' => 'success'
                ]);    
            } else{

                echo json_encode([
                'titulo' => 'Error',
                'mensaje' => $this->usuario->getError(),
                'tipo' => 'error'
                ]);  
            }
        }


    }

    public function actualizar(){
        $method = $_SERVER['REQUEST_METHOD'];

        if( $method != 'POST'){
            http_response_code(404);
            return false;
        }
        $usuario = new Usuario();
        
        $usuario->setId($_POST['id']);
        $usuario->setTipoDocumento($_POST['inicial_documento']);
        $usuario->setDocumento($_POST['documento']);
        $usuario->setNombre(strtoupper($this->limpiaCadena($_POST['nombre'])));
        $usuario->setApellido(strtoupper($this->limpiaCadena($_POST['apellido'])));
        $usuario->setDireccion(strtoupper($this->limpiaCadena($_POST['direccion'])));
        $usuario->setTelefono(strtoupper($this->limpiaCadena($_POST['telefono'])));
        $usuario->setEmail(strtoupper($this->limpiaCadena($_POST['correo'])));
        $usuario->setUsuario(strtoupper($this->limpiaCadena($_POST['usuario'])));
        $usuario->setEstatus("ACTIVO");
        if ($_POST['contrasena']!="") {
            $contrasena = $this->encriptar($this->limpiaCadena($_POST['contrasena']));
            $usuario->setPassword($contrasena);
        }
        if(isset($_POST['rolUsuario']) && $_POST['rolUsuario']!=""){
            $usuario->setRolId(strtoupper($this->limpiaCadena($_POST['rolUsuario'])));
        }
        else{
            $usuario->setRolId(strtoupper($this->limpiaCadena($_POST['rolUsuarioN'])));
        }
        if (isset($_POST['perfil']) && $_POST['perfil']!="") {
            if ($usuario->getId()==1 && $usuario->getRolId()!=1) {
                http_response_code(200);

                echo json_encode([
                    'titulo' => 'Alerta',
                    'mensaje' => 'Este usuario no puede perder el rol de "Super Administrador"',
                    'tipo' => 'error'
                ]);
                return false;
            }
        }
        
        if ($usuario->getRolId()!="1") {
            $admin = $this->usuario->query("SELECT id FROM usuarios WHERE rol_id=1 AND estatus='ACTIVO'")->rowCount();
            if($admin == 1){
                $usu = $this->usuario->getOne("usuarios",$usuario->getId());
                if($usu->rol_id=="1"){
                    echo json_encode([
                        'titulo' => 'Ocurrió un error!',
                        'mensaje' => "El Sistema debe tener como mínimo un usuario de tipo Super Administrador",
                        'tipo' => 'error'
                    ]);
                    return false;
                } 
            }
        }
        if($this->usuario->actualizar($usuario)){
            if (isset($_POST['perfil']) && $_POST['perfil']!="") {
                $_SESSION['usuario'] = $usuario->getUsuario();
                $_SESSION['id'] = $usuario->getId();
                $_SESSION['rol'] = $usuario->getRolId();
                $this->usuario->setRolId($usuario->getRolId());
                $permisos = $this->usuario->obtenerPermisos($this->usuario);
                $_SESSION['permisos'] = $permisos;
            }
            http_response_code(200);

            echo json_encode([
                'titulo' => 'Actualizacion Exitosa',
                'mensaje' => 'Registro actualizado en nuestro sistema',
                'tipo' => 'success'
            ]);
        }else{

            echo json_encode([
                'titulo' => 'Error al Actualizar',
                'mensaje' => $this->usuario->getError(),
                'tipo' => 'error'
            ]);
        }

    }

    public function mostrar($param){
    
    $param = $this->desencriptar($param);

    $usuario = $this->usuario->getOne('usuarios', $param);

    http_response_code(200);

    echo json_encode([
    'data' => $usuario
    ]);
    }

    public function eliminar($id){
        
        $method = $_SERVER['REQUEST_METHOD'];

        if( $method != 'POST'){
        http_response_code(404);
        return false;
        }
        $id = $this->desencriptar($id);
        
        $usu = $this->usuario->getOne("usuarios",$id);
       
        if ($usu->rol_id=="1") {
            $admin = $this->usuario->query("SELECT id FROM usuarios WHERE rol_id=1 AND estatus='ACTIVO'")->rowCount();
            if($admin == 1){
                echo json_encode([
                    'titulo' => 'Ocurrió un error!',
                    'mensaje' => "El Sistema debe tener como mínimo un usuario de tipo Super Administrador",
                    'tipo' => 'error'
                ]);
                return false;
            }
        }
        if($this->usuario->eliminar("usuarios", $id)){

            http_response_code(200);

            echo json_encode([
                'titulo' => 'Registro eliminado!',
                'mensaje' => 'Registro eliminado en nuestro sistema',
                'tipo' => 'success'
            ]);
        }else{
            http_response_code(404);

            echo json_encode([
                'titulo' => 'Ocurrió un error!',
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
    
        if($this->usuario->habilitar("usuarios", $id)){
    
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

    // Asistencias
    public function listarAsistencia($fecha){
        $this->asistencia = new Asistencia;
        $method = $_SERVER['REQUEST_METHOD'];

        if( $method != 'POST'){
        http_response_code(404);
        return false;
        }
        
        $usuarios = $this->usuario->listarActivos();

        
        $asistencias = $this->asistencia->listarAsistenciaUsuario($fecha);
        
        foreach($usuarios as $usuario){
            
            $usuario->fecha = "Inasistente"; 
            $usuario->button =      
                "<a href='". $this->encriptar($usuario->id) ."' class='asistencia btn btn-info' title='Marcar Asistencia'><i class='fas fa-clipboard-check'></i></a>";
        }
        foreach($asistencias as $asistencia){        
            foreach($usuarios as $usuario){
                if ($usuario->fecha == "Inasistente" && $usuario->id == $asistencia->usuario_id) {
                    $usuario->fecha = $asistencia->fecha;
                    $usuario->button =      
                        "<a href='". $this->encriptar($asistencia->asistencia_id) ."' class='inasistencia btn btn-warning' title='Marcar Inasistencia'><i class='fas fa-clipboard'></i></a>";
                }          
            }
        }
        
        http_response_code(200);

        echo json_encode([
        'data' => $usuarios
        ]);
    }    

    public function marcarInasistencia($param){
        $this->asistencia = new Asistencia;
        $asistencia = new Asistencia;
        $method = $_SERVER['REQUEST_METHOD'];
    
        if( $method != 'DELETE'){
          http_response_code(404);
          return false;
        }
    
        $id = $this->desencriptar($param);
        $asistencia->setId($id);
        $result = $this->asistencia->inasistenciaUsuario($asistencia);
        if($result){
    
          http_response_code(200);
    
          echo json_encode([
            'titulo' => 'Usuario inasistente!',
            'mensaje' => "El Usuario ha sido marcado como inasistente",
            'tipo' => 'success'
          ]);
        }else{
          http_response_code(404);
    
          echo json_encode([
            'titulo' => 'Ocurio un error!',
            'mensaje' => $result,
            'tipo' => 'error'
          ]);
        }
        
    
    }
    public function marcarAsistencia(){
        $this->asistencia = new Asistencia;
        $asistencia = new Asistencia;
        $method = $_SERVER['REQUEST_METHOD'];

        if( $method != 'POST'){
            http_response_code(404);
            return false;
        }

        $id = $this->desencriptar($_POST['id']);
        $fecha = $_POST['fecha'];
        $asistencia->setPersona_id($id);
        $asistencia->setFecha($fecha);
        $result = $this->asistencia->asistenciaUsuario($asistencia);
        if($result){

            http_response_code(200);

            echo json_encode([
            'titulo' => 'Usuario asistente!',
            'mensaje' => "El Usuario ha sido marcado como asistente",
            'tipo' => 'success'
            ]);
        }else{
            http_response_code(404);

            echo json_encode([
            'titulo' => 'Ocurio un error!',
            'mensaje' => $result,
            'tipo' => 'error'
            ]);
        }
        
    
    }

}
