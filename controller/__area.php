<?php

session_start();
require_once __DIR__.'/../model/dao/areaDAO.php';
require_once __DIR__.'/../model/dao/gridDAO.php';

$objAreaDAO = new AreaDAO();
$objGridDAO = new GridDAO();

$action = $_GET["action"];

if ($action == "combobox") {
    $idCuenta = base64_decode($_GET['idCuenta']);

    $cbx = array();
    $combo = $objAreaDAO->ExecuteCompleteCombobox($idCuenta);
    foreach ($combo as $key => $val) {
        $cbx[$key] = array("idArea"=>$val->idArea,"descripcion"=>$val->descripcion);
    }
    echo json_encode($cbx);
}