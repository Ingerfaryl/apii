<?php 
require_once '../models/usuarios.php';

if(isset($_POST['tarea'])){
    //Instanciar la clase
    $usuarios = new Usuarios();
    
    if($_POST['tarea']=='add'){
        $datosRecibidos =[
            "idsede" => $_POST["idsede"],
            "apellidos"=> $_POST["apellidos"],
            "nombres"=> $_POST["nombres"],
            "ndoc"=> $_POST["ndoc"],
            "fechanac"=> $_POST["fechanac"],
            "telefono" => $_POST["telefono"]
        ];
        $idobtenido = $usuarios-> add($datosRecibidos);
        echo json_encode($idobtenido);
    }
    
    if($_POST['tarea'] == 'search'){
        $respuesta = $usuarios ->search(["ndoc"=> $_POST['ndoc']]);
        echo json_encode($respuesta);
    }
}

