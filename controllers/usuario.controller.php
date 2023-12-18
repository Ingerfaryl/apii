<?php
require_once '../models/usuarios.php';
if(isset($_GET['tarea'])){
    $usuario = new Usuarios();
    if($_GET['tarea']=='listar'){
        $resultado = $usuario ->getAll();
        echo json_encode($resultado);
    }
}
