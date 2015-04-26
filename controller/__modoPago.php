<?php

session_start();
require_once __DIR__ . '/../model/dao/modoPagoDAO.php';

$objModoPagoDAO = new ModoPagoDAO();

$action = $_GET["action"];

if ($action == "save") {
    $error = TRUE;
    $idModoPago = $_GET['idModoPago'];
    $Descripcion = $_GET['Descripcion'];
    $Indicador = 1;

    $objModoPagoDAO->objModoPago->setIdModoPago($idModoPago);
    $objModoPagoDAO->objModoPago->setDescripcion($Descripcion);
    $objModoPagoDAO->objModoPago->setIndicador($Indicador);

    if ($idModoPago != '') {
        $modoPago = $objModoPagoDAO->ExecuteUpdate($objModoPagoDAO->objModoPago);
    } else {
        $modoPago = $objModoPagoDAO->ExecuteSave($objModoPagoDAO->objModoPago);
        $idModoPago = $modoPago[1];
    }
    
    $error = ($modoPago[0] !== TRUE) ? TRUE : FALSE;
    echo ($error) ? 'fail' : 'success';
}

if ($action == "searchDuplicate") {
    $idCiclo = $_GET['_idCiclo'];
    $idCiclo = (!empty($idCiclo)) ? $idCiclo : FALSE;
    $idUsuarioCarrera = $_GET['_idUsuarioCarrera'];
    $idUsuarioCarrera = (!empty($idUsuarioCarrera)) ? $idUsuarioCarrera : FALSE;
    if ($idCiclo && $idUsuarioCarrera) {
        $estadoModoPago = 1;
        $objModoPagoDAO->objModoPago->setIdCiclo($idCiclo);
        $objModoPagoDAO->objModoPago->setIdUsuarioCarrera($idUsuarioCarrera);
        $objModoPagoDAO->objModoPago->setIdEstadoModoPago($estadoModoPago);
        $duplicateModoPago = $objModoPagoDAO->DuplicateModoPago($objModoPagoDAO->objModoPago);
    } else {
        $duplicateModoPago = FALSE;
    }

    $duplicateModoPago = array('count' => count($duplicateModoPago));
    echo json_encode($duplicateModoPago);
}

if ($action == "findModoPago") {

    $jsonModoPago = array();
    $idModoPago = base64_decode($_GET['_id']);
    $idModoPago = (!empty($idModoPago)) ? $idModoPago : FALSE;
    if ($idModoPago) {
        $objModoPagoDAO->objModoPago->setIdModoPago($idModoPago);
        $jsonModoPago = $objModoPagoDAO->SearchModoPagoID($objModoPagoDAO->objModoPago);
        $jsonModoPago = $jsonModoPago[0];
    } else {
        $jsonModoPago = FALSE;
    }

    echo json_encode($jsonModoPago);
}

if ($action == "delete") {
    $error = TRUE;
    $idModoPago = base64_decode($_GET['idModoPago']);
    $code = $_GET['code'];
    $indicador = 1;
    if ($code == '1234') {
        $objModoPagoDAO->objModoPago->setIdModoPago($idModoPago);
        $objModoPagoDAO->objModoPago->setIndicador($indicador);
        $matricula = $objModoPagoDAO->ExecuteDelete($objModoPagoDAO->objModoPago);
        $error = ($matricula !== TRUE) ? TRUE : FALSE;
        echo ($error) ? 'fail' : 'success';
    } else {
        echo 'errorCode';
    }
}

if ($action == 'combobox') {
    $cbx = array();
    $combo = $objModoPagoDAO->ExecuteCompleteCombobox($objModoPagoDAO->objModoPago);
    foreach ($combo as $key => $val) {
        $cbx[$key] = array(
			"idModoPago" => $val->idModoPago,
			"mdpDescripcion" => $val->mdpDescripcion
		);
    }
    echo json_encode($cbx);
}
