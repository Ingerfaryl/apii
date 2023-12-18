<?php
require_once '../models/Marca.php';
//1) recibe la solitud
//2) realiza proceso
//3) entrega resultado

if(isset($_GET['tarea'])){
    $marca = new Marca();
    if($_GET['tarea']=='listar'){
        $resultado = $marca ->getAll(); 
        echo json_encode($resultado);
    }
}