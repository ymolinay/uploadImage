<?php

session_start();
require_once __DIR__.'/../model/dao/ubigeoDAO.php';
require_once __DIR__.'/../model/dao/gridDAO.php';

$objUbigeoDAO = new UbigeoDAO();
$objGridDAO = new GridDAO();

$action = $_GET["action"];


if ($action == "combobox") {
    $comobox = array();
    $data = $objUbigeoDAO->ExecuteCompleteCombobox();
    foreach ($data as $key => $val) {
        $comobox[$key] = array("idUbigeo"=>$val->idUbigeo,"descripcion"=>$val->departamento.", ".$val->provincia.", ".$val->distrito);
    }
    echo json_encode($comobox);
}