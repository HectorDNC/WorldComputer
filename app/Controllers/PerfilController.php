<?php

namespace app\Controllers;

use App\Models\Rol;
use App\Models\Usuario;
use App\Traits\Utility;
use System\Core\Controller;
use System\Core\View;


class PerfilController extends Controller{

    use Utility;
    
    private $usuario;
    private $rol;
    
    public function __construct() {
        
        $this->usuario = new Usuario;
        $this->rol = new Rol();
    }

    public function index(){
        $usuario = $this->usuario->getOne('usuarios', $_SESSION['id']);
        $doc = explode("-",$usuario->documento);
        $inicial_documento = $doc[0];
        $documento = $doc[1];
        $roles = $this->rol->listar();
        return View::getView('Usuario.perfil', [
            'usuario'=> $usuario,
            'documento'=> $documento,
            'inicial_documento'=>$inicial_documento,
            'roles'=>$roles
        ]);
    }
}