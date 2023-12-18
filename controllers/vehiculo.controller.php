<?php
//Incorpora el archivo externo 1 sola vez
//Si detecta un error, se detiene
require_once '../models/vehiculo.php';
//1. Recibirá peticiones (GET - POST - REQUEST)
//2. Realizará el proceso (MODELO - CLASE)
//3. Devolver el resultado (JSON)

//KEY = VALUE
if(isset($_POST['tarea'])){
  //Instanciar la clase
  $vehiculo = new vehiculo();

  if($_POST['tarea'] == 'search'){
    $respuesta = $vehiculo ->search(["placa"=> $_POST['placa']]);
    sleep(1);
    echo json_encode($respuesta);
  }

  //nuevo proceso...
  if($_POST['tarea']=='add'){
    //almacenar los datos recibiendo de la vista en un arreglo
    $datosRecibidos = [
      "idmarca" => $_POST["idmarca"], //el idmarca de post viene del formulario 
      "modelo" =>$_POST["modelo"],
      "color" =>$_POST["color"],
      "tipocombustible" =>$_POST["tipocombustible"],
      "peso" => $_POST["peso"],
      "afabricacion" => $_POST["afabricacion"],
      "placa" => $_POST["placa"]
    ];
    //Enviamos el arreglo como parámetro del método add
    $idobtenido=$vehiculo->add($datosRecibidos);
    echo json_encode($idobtenido);
  }
}
if(isset($_GET['tarea'])){
  $vehiculo = new vehiculo();
  if($_GET['tarea']=='getTipoCombustible'){
    echo json_encode($vehiculo->getTipoCombustible());
  }
}
