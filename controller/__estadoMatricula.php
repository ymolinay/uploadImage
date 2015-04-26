<?php

session_start();
require_once __DIR__ . '/../model/dao/estadoMatriculaDAO.php';
require_once __DIR__ . '/../model/dao/gridDAO.php';

$objEstadoMatriculaDAO = new EstadoMatriculaDAO();
$objGridDAO = new GridDAO();

$action = $_GET["action"];

if ($action == 'combobox') {
    $cbx = array();
    $combo = $objEstadoMatriculaDAO->SearchAllData();
    foreach ($combo as $key => $val) {
        $cbx[$key] = array("idEstado" => $val->idEstadoMatricula, "descripcion" => $val->etmDescripcion);
    }
    echo json_encode($cbx);
}