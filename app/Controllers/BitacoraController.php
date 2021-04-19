<?php

namespace App\Controllers;
use PDO;
use App\Models\Usuario;
use App\Traits\Utility;
use System\Core\Controller;
use System\Core\View;

class BitacoraController extends Controller{

    private $usuario;

    use Utility;

    public function __construct(){
        $this->usuario = new Usuario;
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
        $usuarios = $this->usuario->getAll("usuarios", "1");
        foreach ($usuarios as $usuario) {
            $usuario->id = $this->encriptar($usuario->id);
        }
        return View::getView('Bitacora.index',
            [
                'usuarios'=>$usuarios
            ]
        );
    }

    public function listar($param = NULL){
        
        $method = $_SERVER['REQUEST_METHOD'];

        if( $method != 'POST'){
        http_response_code(404);
        return false;
        }
        if (isset($param)) {
            $b = explode('&',$param);
        }
        if (isset($b[0]) && $b[0]!="" || isset($b[1]) && $b[1]!="" || isset($b[2]) && $b[2]!="") {
            $first = false;
            if (isset($b[0]) && $b[0]!="") {
                $cond1 = "b.fecha BETWEEN '".$b[0]." 00:00:00' AND '".$b[0]." 23:59:59' ";
                $first = true;
            }
            if (isset($b[1]) && $b[1]!="") {
                $usuario_id = $this->desencriptar($b[1]);
                if (!$first) {
                    $cond2 = " b.usuario_id = ".$usuario_id." ";
                    $first = true;
                }
                else{
                    $cond2 = " AND b.usuario_id = ".$usuario_id." ";
                }
            }
            if (isset($b[2]) && $b[2]!="") {
                if (!$first) {
                    $cond3 = " b.modulo LIKE '%".$b[2]."%' ";
                    $first = true;
                }
                else{
                    $cond3 = " AND b.modulo LIKE '%".$b[2]."%' ";
                }
            }
            $sql = "SELECT b.*, Date_format(b.fecha, '%d/%m/%Y - %H:%i') as fecha, 
                CONCAT(u.nombre,' ',u.apellido) AS usuario FROM bitacora b INNER JOIN usuarios u ON b.usuario_id=u.id
                WHERE ";
            if (isset($cond1)) {
                $sql.=$cond1;
            }
            if (isset($cond2)) {
                $sql.=$cond2;
            }
            if (isset($cond3)) {
                $sql.=$cond3;
            }
            $sql .= " ORDER BY b.fecha DESC";
            
            $query = $this->usuario->query($sql);
        }
        else{
            $query = $this->usuario->query("SELECT b.*, Date_format(b.fecha, '%d/%m/%Y - %H:%i') as fecha, 
            CONCAT(u.nombre,' ',u.apellido) AS usuario FROM bitacora b INNER JOIN usuarios u ON b.usuario_id=u.id
            ORDER BY b.fecha DESC");
        }        
       
        $bitacora = $query->fetchAll(PDO::FETCH_OBJ);
        foreach($bitacora as $b){
            $b->button = 
            "<a href='bitacora/mostrar/". $this->encriptar($b->id) ."' class='mostrar btn btn-info'><i class='fas fa-search'></i></a>";
        }

        http_response_code(200);

        echo json_encode([
        'data' => $bitacora
        ]);
    }
    public function mostrar($param)
    {
        $param = $this->desencriptar($param);
        $query = $this->usuario->query("SELECT b.modulo, b.accion, b.descripcion, date_format(b.fecha,'%d/%m/%Y') AS fecha, 
            date_format(b.fecha,'%H:%i') AS hora, CONCAT(u.nombre,' ', u.apellido) AS usuario_nombre, u.documento as usuario_documento, u.usuario as usuario_username,
            r.nombre AS usuario_rol FROM bitacora b INNER JOIN usuarios u ON b.usuario_id=u.id 
            INNER JOIN roles r ON u.rol_id=r.id
            WHERE b.id=$param");
        $actividad = $query->fetch(PDO::FETCH_OBJ);
        http_response_code(200);

        echo json_encode([
            'data' => $actividad
        ]);

        exit();
    }
}