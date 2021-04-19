<?php

namespace App\Controllers;
use PDO;
use App\Models\Configuracion;
use App\Traits\Utility;
use System\Core\Controller;
use System\Core\View;

class ConfiguracionController extends Controller{


    use Utility;

    public function __construct(){
    }

    public function index(){
        // $band = false;
        // foreach ($_SESSION['permisos'] as $p):
        //     if ($p->permiso == "Inventario") {     
        //     $band = true;
        // }endforeach;   
        if ($_SESSION['rol']!=1) {
            header("Location: ".ROOT);
            return false;
        }
        $config = new Configuracion;
        $query0 = $config->query("SELECT * FROM configuracion WHERE nombre = 'nombre_sistema'");
        $query1 = $config->query("SELECT * FROM configuracion WHERE nombre = 'dolar'");
        $query2 = $config->query("SELECT * FROM configuracion WHERE nombre = 'iva'");
        $nombre_sistema = $query0->fetch(PDO::FETCH_OBJ);
        $dolar = $query1->fetch(PDO::FETCH_OBJ);
        $iva = $query2->fetch(PDO::FETCH_OBJ);
        return View::getView('Configuracion.index',
            [
                'nombre_sistema' => $nombre_sistema->valor,
                'dolar' => $dolar->valor,
                'iva' => $iva->valor,
            ]
        );
    }
    public function actualizar(){
        $method = $_SERVER['REQUEST_METHOD'];

        if( $method != 'POST'){
            http_response_code(404);
            return false;
        }
        $config = new Configuracion;
        // $config->setNombre_sistema($_POST['nombre_sistema']);
        $config->setDolar($_POST['dolar']);
        $config->setIva($_POST['iva']);
        if($config->actualizar()){
            // setcookie ('title',$config->getNombre_sistema(),time()+60*60*24*365);
            http_response_code(200);

            echo json_encode([
                'titulo' => 'Actualizacion Exitosa',
                'mensaje' => 'La Configuración del Sistema se actualizó correctamente',
                'tipo' => 'success'
            ]);
        }else{

            echo json_encode([
                'titulo' => 'Error al Actualizar',
                'mensaje' => $config->getError(),
                'tipo' => 'error'
            ]);
        }

    }
    

}