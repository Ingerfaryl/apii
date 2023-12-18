<?php
require_once 'Conexion.php';


//Devuelve la lista completa de marcas
class Marca extends Conexion{
    private $pdo;
    public function __CONSTRUCT(){
        $this ->pdo = parent :: getConexion();
        
    }
    public function getAll(){
        try{
            $consulta = $this->pdo->prepare("CALL spu_vehiculos_listar()");
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        }
        catch(Exception $e){
            die($e->getMessage());
        }
    }
}
/* $marca = new Marca();
$resultado = $marca -> getAll();
echo json_encode($resultado); */
