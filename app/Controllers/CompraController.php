<?php

namespace App\Controllers;


use App\Models\Compra;
use App\Models\Entrada;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\Configuracion;
use App\Traits\Utility;
use PDO;
use System\Core\Controller;
use System\Core\View;

class CompraController extends Controller{

    private $producto;
    private $proveedor;
    private $compra;
    private $entrada;

    use Utility;

    public function __construct(){
        $this->producto = new Producto;
        $this->proveedor = new Proveedor;
        $this->compra = new Compra;
        $this->entrada = new Entrada;
    }

    public function index(){
        $band = false;
        foreach ($_SESSION['permisos'] as $p):
            if ($p->permiso == "Compras") {     
            $band = true;
        }endforeach;   
        if (!$band) {
            header("Location: ".ROOT);
            return false;
        }
        return View::getView('Compra.index');
    }

    public function create(){
        $band = false;
        foreach ($_SESSION['permisos'] as $p):
            if ($p->permiso == "Registrar Compras") {     
            $band = true;
        }endforeach;   
        if (!$band) {
            header("Location: ".ROOT);
            return false;
        }
        $num_documento = $this->compra->formatoDocumento($this->compra->ultimoDocumento());
        $proveedores = $this->proveedor->getAll('proveedores', "estatus = 'ACTIVO'");
        $productos = $this->producto->getAll('v_inventario', "estatus = 'ACTIVO'");
        $config = new Configuracion;
        $dolar = $config->obtenerDolar();
        return View::getView('Compra.create', 
            [ 
                'productos' => $productos, 
                'proveedores' => $proveedores,
                'numeroDocumento' => $num_documento,
                'dolar' => $dolar
            ]);
    }

    public function listar(){

        $method = $_SERVER['REQUEST_METHOD'];

        if( $method != 'POST'){
        http_response_code(404);
        return false;
        }

        $compras = $this->compra->listar();
        
        $eliminar = false;            
        foreach ($_SESSION['permisos'] as $p):
            if ($p->permiso == "Anular Compras") {     
            $eliminar = true;
        }endforeach;

        foreach($compras as $compra){
            if ($eliminar) {
                if($compra->estatus == 'ACTIVO'){
                    $compra->estado = "<a href='" . $this->encriptar($compra->id) . "' class='btn btn-success estatus'><i class='fas fa-check-circle'></i> Activa</a>";
                }else{
                    $compra->estado = "<a href='" . $this->encriptar($compra->id) . "' class='btn btn-danger estatus'><i class='fas fa-window-close'></i> Anulada</a>";
                }
            }
            else{
                $compra->estado=$compra->estatus;
            }                

            $compra->button = 
            "<a href='compra/mostrar/". $this->encriptar($compra->id) ."' class='mostrar btn btn-info mr-1 mb-1'><i class='fas fa-search'></i></a>".
            "<a href='compra/compraPDF/". $this->encriptar($compra->id) ."' class='pdf btn btn-danger mr-1 mb-1'><i class='fas fa-file-pdf'></i></a>";
        }

        http_response_code(200);

        echo json_encode([
        'data' => $compras
        ]);

    }

    public function mostrar($param){

        $idCompra = $this->desencriptar($param);

        $query = $this->compra->query("SELECT c.id, c.codigo, Date_format(c.fecha,'%d/%m/%Y') AS fecha, Date_format(c.fecha,'%H:%i') AS hora, p.documento AS rif_proveedor, p.razon_social AS proveedor, IF(c.cod_ref = null OR c.cod_ref = '', 'N/A', c.cod_ref) AS referencia, p.direccion, c.estatus,c.dolar 
            FROM compras c
                LEFT JOIN
            proveedores p
                ON c.proveedor_id = p.id
            WHERE c.id = '$idCompra' LIMIT 1");

        $query2 = $this->compra->query("SELECT c.id, p.codigo, p.nombre, dc.cantidad, dc.costo FROM 
            productos p 
                JOIN
            detalle_compra dc
                ON p.id = dc.producto_id
                JOIN
            compras c 
                ON dc.compra_id = c.id
            WHERE c.id = '$idCompra'");
            
        // Encabezado Compra
        $compra = $query->fetch(PDO::FETCH_OBJ);

        // Detalles Compra
        $productos = $query2->fetchAll(PDO::FETCH_OBJ);

        http_response_code(200);

        echo json_encode([
            'compra' => $compra,
            'productos' => $productos,
        ]);

        exit();
    }

    public function guardar(){

        $compra = new Compra;

        $num_documento = $this->compra->formatoDocumento($this->compra->ultimoDocumento());

        $compra->setNumeroDocumento($num_documento);
        $compra->setDocumentoReferencia($this->limpiaCadena($_POST['documentoReferencia']));
        $compra->setPersonaId($_POST['proveedor']);
        $compra->setTotal($_POST['total']);
        $compra->setDolar($_POST['dolar']);

        $lastId = $compra->registrar($compra);

        $productos = $_POST['productos'];
        $cantidad = $_POST['cantidades'];
        $precio = $_POST['precios'];


        $contador = 0;
        foreach($productos AS $producto){

            $entrada = new Entrada();
            
            $entrada->setProductoId($productos[$contador]);
            $entrada->setCompraId($lastId);
            $entrada->setCantidad($cantidad[$contador]);
            $entrada->setCosto($precio[$contador]);

            $this->entrada->registrar($entrada);

            $contador++;
        }

        http_response_code(200);
          
        echo json_encode([
          'titulo' => 'Compra Registrada!',
          'mensaje' => 'Se ha registrado correctamente la compra',
          'tipo' => 'success'
        ]);
  
        exit();

    }

    public function cambiarEstatus($param){
        $id = $this->desencriptar($param);

        $estatus = $this->compra->cambiarEstatus('compras', $id);

        if($estatus){
            http_response_code(200);

            echo json_encode([
                'titulo' => 'Estatus actualizado',
                'mensaje' => 'Estatus de la compra actualizado correctamente',
                'tipo' => 'success'
            ]);

            exit();
        }else {
            http_response_code(200);

            echo json_encode([
                'titulo' => 'Error al Cambiar estatus',
                'mensaje' => 'Ocurrio un error al intentar cambiar el estatus',
                'tipo' => 'error'
            ]);

            exit();
        }
    }

    public function compraPDF($param){

        $idCompra = $this->desencriptar($param);

        $query = $this->compra->query("SELECT c.id, c.codigo,c.dolar, Date_format(c.fecha,'%d/%m/%Y') AS fecha, Date_format(c.fecha,'%H:%i') AS hora, p.documento AS rif_proveedor, p.razon_social AS proveedor, IF(c.cod_ref = null OR c.cod_ref = '', 'N/A', c.cod_ref) AS referencia, p.direccion, c.estatus FROM
            compras c
                LEFT JOIN
            proveedores p
                ON c.proveedor_id = p.id
            WHERE c.id = '$idCompra' LIMIT 1");

        $query2 = $this->compra->query("SELECT c.id, p.codigo, p.nombre, dc.cantidad, dc.costo FROM 
            productos p 
                JOIN
            detalle_compra dc
                ON p.id = dc.producto_id
                JOIN
            compras c 
                ON dc.compra_id = c.id
            WHERE c.id = '$idCompra'");
            
        // Encabezado Compra
        $compra = $query->fetch(PDO::FETCH_OBJ);

        // Detalles Compra
        $productos = $query2->fetchAll(PDO::FETCH_OBJ);

        ob_start();

        View::getViewPDF('FormatosPDF.Compra', [
            'compra' => $compra,
            'productos' => $productos
        ]);

        $html = ob_get_clean();

        $this->crearPDF($html);

    }
}