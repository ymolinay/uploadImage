<?php

session_start();
require_once __DIR__.'/../model/dao/tipoEquipoDAO.php';
require_once __DIR__.'/../model/dao/gridDAO.php';

$objTipoEquipoDAO = new TipoModeloDAO();
$objGridDAO = new GridDAO();

$action = $_GET["action"];

if ($action == "combobox") {
    $cbx = array();
    $combo = $objTipoEquipoDAO->ExecuteCompleteCombobox();
    foreach ($combo as $key => $val) {
        $cbx[$key] = array("idTipoEquipo"=>$val->idTipoEquipo,"descripcion"=>$val->descripcionTipoEquipo);
    }
    echo json_encode($cbx);
}