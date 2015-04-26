<?php

session_start();
require_once __DIR__.'/../model/dao/modeloDAO.php';
require_once __DIR__.'/../model/dao/gridDAO.php';

$objTipoEquipoDAO = new ModeloDAO();
$objGridDAO = new GridDAO();

$action = $_GET["action"];

if ($action == "combobox") {
    $cbx = array();
    $combo = $objTipoEquipoDAO->ExecuteCompleteCombobox();
    foreach ($combo as $key => $val) {
        $cbx[$key] = array("idModelo"=>$val->idModelo,"descripcion"=>$val->descripcionModelo);
    }
    echo json_encode($cbx);
}