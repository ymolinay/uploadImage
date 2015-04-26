<?php

session_start();
require_once __DIR__.'/../model/dao/areaTempDAO.php';
require_once __DIR__.'/../model/dao/gridDAO.php';

$objAreaTempDAO = new AreaTempDAO();
$objGridDAO = new GridDAO();

$action = $_GET["action"];

if ($action == "save") {
    $idAcceso = $_SESSION["sessionIdAcceso"];
    $sede = $_GET['txtSedeTemp'];
    $area = $_GET['txtArea'];
    $indicador = '1';

    $objAreaTempDAO->objAreaTemp->setIdAcceso($idAcceso);
    $objAreaTempDAO->objAreaTemp->setDescripcion($area);
    $objAreaTempDAO->objAreaTemp->setIdSedeTemp($sede);
    $objAreaTempDAO->objAreaTemp->setIndicador($indicador);

    $result = $objAreaTempDAO->ExecuteSave($objAreaTempDAO->objAreaTemp);

    if ($result == "1") {
        echo "success";
    } else {
        echo "failed";
    }
}

if ($action == "combobox") {
    $idAcceso = $_SESSION["sessionIdAcceso"]; //Yrving no quiere subirlo >.<
    $cbx = array();
    $sep = '';

    $objAreaTempDAO->objAreaTemp->setIdAcceso($idAcceso);
    $combo = $objAreaTempDAO->ExecuteCompleteCombobox($objAreaTempDAO->objAreaTemp);
    foreach ($combo as $key => $val) {
        $cbx[$key] = array("idAreaTemp" => $val->idAreaTemp, "descripcion" => $val->descripcion);
    }
    echo json_encode($cbx);
}
if ($action == "delete") {
    $idAreaTemp = base64_decode($_GET['id']);
    $objAreaTempDAO->objAreaTemp->setIdSedeTemp($idAreaTemp);
    $result = $objAreaTempDAO->ExecuteDeleteItem($objAreaTempDAO->objAreaTemp);

    if ($result == "1") {
        echo "success";
    } else {
        echo "failed";
    }
}
if ($action == "clear") {
    $idAcceso = $_SESSION["sessionIdAcceso"];
    $objAreaTempDAO->objAreaTemp->setIdAcceso($idAcceso);
    $result = $objAreaTempDAO->ExecuteDelete($objAreaTempDAO->objAreaTemp);

    if ($result == "1") {
        echo "success";
    } else {
        echo "failed";
    }
}