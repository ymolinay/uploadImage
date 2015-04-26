<?php

session_start();
require_once __DIR__.'/../model/dao/cicloDAO.php';
require_once __DIR__.'/../model/dao/gridDAO.php';

$objCicloDAO = new CicloDAO();
$objGridDAO = new GridDAO();

$action = $_GET["action"];

if ($action == "combobox") {
    $cbx = array();
    $combo = $objCicloDAO->ExecuteCompleteCombobox();
    foreach ($combo as $key => $val) {
        $cbx[$key] = array("idCiclo" => $val->idCiclo, "cloDescripcion" => $val->cloDescripcion);
    }
    echo json_encode($cbx);
}
if ($action == "comboboxMax") {
    $max = $_GET['maxCiclo'];
    $cbx = array();
    $combo = $objCicloDAO->ExecuteCompleteComboboxMax($max);
    foreach ($combo as $key => $val) {
        $cbx[$key] = array("idCiclo" => $val->idCiclo, "cloDescripcion" => $val->cloDescripcion);
    }
    echo json_encode($cbx);
}