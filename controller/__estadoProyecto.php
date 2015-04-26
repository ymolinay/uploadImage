<?php

session_start();
require_once __DIR__.'/../model/dao/estadoProyectoDAO.php';
require_once __DIR__.'/../model/dao/gridDAO.php';

$objEstadoProyectoDAO = new EstadoProyectoDAO();
$objGridDAO = new GridDAO();

$action = $_GET['action'];

if ($action == "combobox") {
    $cbx = array();
    $combo = $objEstadoProyectoDAO->ExecuteCompleteCombobox();
    foreach ($combo as $key => $val) {
        $cbx[$key] = array("idEstadoProyecto"=>$val->idEstadoProyecto,"descripcion"=>$val->descripcion);
    }
    echo json_encode($cbx);
}