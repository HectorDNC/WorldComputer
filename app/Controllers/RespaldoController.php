<?php

namespace App\Controllers;
use PDO;
use App\Traits\Utility;
use App\Models\Usuario;
use System\Core\Controller;
use System\Core\View;
class RespaldoController extends Controller{
    use Utility;
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
        return View::getView('Respaldo.index');
    }
    public function respaldar()
    {
        $method = $_SERVER['REQUEST_METHOD'];

        if( $method != 'POST'){
            http_response_code(404);
            return false;
        }
        $dir = "public/assets/respaldo/";
        $day=date("d");
        $mont=date("m");
        $year=date("Y");
        $hora=date("H-i-s");
        $fecha=$day.'_'.$mont.'_'.$year;
        $errores = false;
        $con=mysqli_connect(SERVER, USER, PASS, BD);
        $r = $con->query("SELECT NOW() AS f_actual");
        $a = $r->fetch_assoc();
        $fechaA = $a['f_actual'];
        
        $DataBASE=$fecha."_(".$hora."_hrs).sql";
        $error = 0;
        $tables=array();
        $triggers=array();
        // $result=SGBD::sql('SHOW TABLES');
        $result=mysqli_query($con, 'SET CHARACTER SET utf8');
        $result=mysqli_query($con, 'SHOW TABLES');
        
        $sql='SET FOREIGN_KEY_CHECKS=0;'."\nSET @usuario_id=1;\n\n";
        $sql.= "SET CHARACTER SET utf8; \n";
            // $sql.='CREATE DATABASE IF NOT EXISTS '.BD.";\n\n";
            // $sql.='USE '.BD.";\n\n";
        

        if($result){
            while($row=mysqli_fetch_row($result)){
            $tables[] = $row[0];
            }
            foreach($tables as $table){
                if($table[0]=='v' && $table[1]=="_"){
                    $sql.="\n";
                }else{
                    $result=mysqli_query($con,'SELECT * FROM '.$table);
                    if($result){
                        $numFields=mysqli_num_fields($result);
                        $sql.='TRUNCATE TABLE '.$table.';';
                        // $row2=mysqli_fetch_row(SGBD::sql('SHOW CREATE TABLE '.$table));
                        // $sql.="\n\n".$row2[1].";\n\n";
                        $sql.="\n";
                        for ($i=0; $i < $numFields; $i++){
                            while($row=mysqli_fetch_row($result)){
                                $sql.='INSERT INTO '.$table.' VALUES(';
                                for($j=0; $j<$numFields; $j++){
                                    $row[$j]=addslashes($row[$j]);
                                    $row[$j]=str_replace("\n","\\n",$row[$j]);
                                    if (isset($row[$j])){
                                        $sql .= '"'.$row[$j].'"' ;
                                    }
                                    else{
                                        $sql.= '""';
                                    }
                                    if ($j < ($numFields-1)){
                                        $sql .= ',';
                                    }
                                }
                                $sql.= ");\n";
                            }
                        }
                        $sql.="\n\n\n";
                    }else{
                        $error=1;
                    }
                }
            }
            if($error==1){
                $errores = true;
            }else{
                chmod($dir, 0777);
                $sql.='SET FOREIGN_KEY_CHECKS=1;';
                $sql.="\n";
                $sql.='DELETE FROM bitacora WHERE fecha > "'.$fechaA.'";';
                $handle=fopen($dir.$DataBASE,'w+');
                if(fwrite($handle, $sql)){
                    fclose($handle);
                    
                }else{
                    $errores = true;
                }
            }
        }else{
            $errores = true;
        }
        mysqli_free_result($result);
        if (!$errores) {
            echo json_encode([
                'success' => true,
                'file' => ROOT.$dir.$DataBASE
            ]);
            return 0;
        }
        else{
            echo 'Ocurrio un error inesperado al crear la copia de seguridad';
            echo json_encode([
                'success' => false,
                'message' => 'Ocurrió un error inesperado al crear la copia de seguridad'
            ]);
        }
    }
    public function restaurar()
    {
        $method = $_SERVER['REQUEST_METHOD'];

        if( $method != 'POST'){
            http_response_code(404);
            return false;
        }
        $restorePoint=$this->limpiaCadena($_POST['respaldo']);
        $restorePoint=$_POST['respaldo'];
        $sql=explode(";",file_get_contents($restorePoint));
        $totalErrors=0;
        set_time_limit (90);
        $con=mysqli_connect(SERVER, USER, PASS, BD);
        $con->query("SET FOREIGN_KEY_CHECKS=0");
        for($i = 0; $i < (count($sql)-1); $i++){
            if($con->query($sql[$i].";")){  }else{ $totalErrors++; }
        }
        $con->query("SET FOREIGN_KEY_CHECKS=1");
        $con->close();
        if($totalErrors<=0){
            echo json_encode([
                'success' => true
            ]);
            return 0;
        }else{
            echo json_encode([
                'success' => false,
                'message' => 'Ocurrió un error inesperado, no se pudo hacer la restauración completamente'
            ]);
        }
    }
    public function verificarPassword()
    {
        $usuario = new Usuario;
        $usuario->setUsuario($this->limpiaCadena($_SESSION['usuario']));
        $usuario->setPassword($this->encriptar($this->limpiaCadena($_POST['password'])));
        $response = $usuario->checkUser($usuario);
        if($response) {

            header('Content-Type: application/json');
            http_response_code(200);
            echo json_encode([
                'success' => true
            ]);
        
        } else {
            header('Content-Type: application/json');
            http_response_code(200);
            echo json_encode([
                'success' => false,
                'mensaje' => 'Contraseña Incorrecta'
            ]);
        }
    }

    public function controlarMax()
    {
        $ruta="public/assets/respaldo/";
        $nArchivos = 0;
        $maxArchivos = 10;
        if(is_dir($ruta)){
            if($aux=opendir($ruta)){
                while(($archivo = readdir($aux)) !== false){
                    if($archivo!="."&&$archivo!=".."){
                        $ruta_completa=$ruta.$archivo;
                        if(is_dir($ruta_completa)){
                        }else{
                            $nArchivos++;
                            
                        }
                    }
                }
                
                closedir($aux); 
            }
            if ($nArchivos > $maxArchivos) {
                $borrar = $nArchivos - $maxArchivos;
                $j = 0;
                if($auxB=opendir($ruta)){
                    while(($archivo = readdir($auxB)) !== false && $j < $borrar){
                        if($archivo!="."&&$archivo!=".."){
                            $ruta_completa=$ruta.$archivo;
                            if(is_dir($ruta_completa)){
                            }else{
                                unlink($ruta_completa);
                                $j++;
                            }
                        }
                        
                    }
                    
                    closedir($auxB); 
                    http_response_code(200);

                    echo json_encode([
                        'success' => true,
                        'message' => "Se eliminaron ".$borrar." archivo(s) de respaldo",
                        'deleted' => true
                    ]);
                    return 0;
                }
            }
            http_response_code(200);

            echo json_encode([
                'success' => true,
                'message' => "Revisión completa de archivos de respaldo",
                'deleted' => false
            ]);
            return 0;
        }else{
            http_response_code(200);

            echo json_encode([
                'success' => false,
                'message' => $ruta." no es ruta válida"
            ]);
            return 0;
        }
    }

}
?>