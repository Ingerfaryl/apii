<?php
require_once '../models/sedes.php';

if (isset($_GET['tarea'])) {
    $sede = new Sede();

    if ($_GET['tarea'] == 'listar') {
        $resultado = $sede->getAll();
        echo json_encode($resultado);
    }
}

/* $sedes = new Sede();
$resultado = $sedes->getAll();
echo json_encode($resultado);  */