<?php

namespace App\Controllers;
use PDO;
use App\Models\Usuario;
use System\Core\Controller;
use System\Core\View;

class HomeController extends Controller{

    private $usuario;

    public function __construct(){
        $this->usuario = new Usuario;
    }

    public function index(){
        $query = $this->usuario->connect()->prepare("SELECT v.codigo as codigo, Date_format(v.fecha,'%d/%m/%Y %r') as fecha, CONCAT(c.nombre,' ',c.apellido) as cliente FROM ventas v LEFT JOIN clientes c ON v.cliente_id=c.id WHERE v.estatus='ACTIVO' ORDER BY v.fecha DESC LIMIT 10");
        $query->execute();
        $ventas = $query->fetchAll(PDO::FETCH_OBJ);
        $query1 = $this->usuario->connect()->prepare("SELECT s.codigo as codigo, Date_format(s.fecha,'%d/%m/%Y %r') as fecha, CONCAT(c.nombre,' ',c.apellido) as cliente FROM servicios_prestados s LEFT JOIN clientes c ON s.cliente_id=c.id WHERE s.estatus='ACTIVO' ORDER BY s.fecha DESC LIMIT 10");
        $query1->execute();
        $servicios = $query1->fetchAll(PDO::FETCH_OBJ);
        return View::getView('Home.index', [
            'clientes' => $this->usuario->contar('clientes'),
            'productos' => $this->usuario->contar('productos'),
            'compras' => $this->usuario->contar('compras'),
            'ventas' => $this->usuario->contar('ventas'),
            'servicios' => $this->usuario->contar('servicios'),
            'servicios_prestados' => $this->usuario->contar('servicios_prestados'),
            'ventasD' => $ventas,
            'serviciosD' => $servicios
        ]);
    }
}