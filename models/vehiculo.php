<?php
//1) primero se requiere al archivo
require 'Conexion.php';
//2) heredad sus atributos y métodos
class vehiculo extends Conexion{
	//Este objeto almacenará la conexion y se la facilitará a todos loa métodos
	private $pdo;
	//3) Almacenar la conexión en el objeto
	public function __CONSTRUCT(){
		$this -> pdo = parent::getConexion();
	}
	public function add($data=[]){
		try{
			$consulta = $this ->pdo->prepare("CALL spu_vehiculos_registrar(?,?,?,?,?,?,?)");
			$consulta->execute(
				array(
					$data['idmarca'],
					$data['modelo'],
					$data['color'],
					$data['tipocombustible'],
					$data['peso'],
					$data['afabricacion'],
					$data['placa']
				)
			);
			//ahora retorna el id vehiculo
			return $consulta->fetch(PDO::FETCH_ASSOC);
		}
		catch(Exception $e){
			die($e->getMessage());
		}
	}
	public function search($data=[]){
		try{
			//El spu requiere el número de placa
			$consulta = $this->pdo->prepare("CALL spu_vehiculos_buscar(?)");
			$consulta->execute(
				array($data['placa'])
			);
			//Devolver el registro encontrado
			//fetch()	  : Retorna la primera coincidencia (1)
			//fectchAll() : Retorna todas las coincidencias (n)
			//Fetch_ASSOC : define el resultado como un objeto
			return $consulta ->fetch(PDO::FETCH_ASSOC);
		}
		catch(Exception  $e){
			die($e->getMessage());
		}
	}
	public function getTipoCombustible(){
		try{
			$consulta = $this ->pdo->prepare("CALL spu_resumen_tipocombustible()");
			$consulta -> execute();
			return $consulta ->fetchAll(PDO::FETCH_ASSOC);
		}catch(Exception $e){

			die($e->getMessage());
		}
	}
}
//Prueba - no olvides borrar esto
/* $vehiculo = new vehiculo();
$registro = $vehiculo->search(["placa"=>"ABC-111"]);
var_dump($registro); */