<?php

session_start();
require_once __DIR__ . '/../model/dao/tipoPagoDAO.php';

$objTipoPagoDAO = new TipoPagoDAO();

$action = $_GET["action"];

if ($action == "save") {
    $error = TRUE;
    $idTipoPago = $_GET['idTipoPago'];
    $Descripcion = $_GET['Descripcion'];
    $Monto = $_GET['Monto'];
    $Indicador = 1;

    $objTipoPagoDAO->objTipoPago->setIdTipoPago($idTipoPago);
    $objTipoPagoDAO->objTipoPago->setDescripcion($Descripcion);
    $objTipoPagoDAO->objTipoPago->setMonto($Monto);
    $objTipoPagoDAO->objTipoPago->setIndicador($Indicador);

    if ($idTipoPago != '') {
        $tipoPago = $objTipoPagoDAO->ExecuteUpdate($objTipoPagoDAO->objTipoPago);
    } else {
        $tipoPago = $objTipoPagoDAO->ExecuteSave($objTipoPagoDAO->objTipoPago);
        $idTipoPago = $tipoPago[1];
    }
    
    $error = ($tipoPago[0] !== TRUE) ? TRUE : FALSE;
    echo ($error) ? 'fail' : 'success';
}

if ($action == "searchDuplicate") {
    $idCiclo = $_GET['_idCiclo'];
    $idCiclo = (!empty($idCiclo)) ? $idCiclo : FALSE;
    $idUsuarioCarrera = $_GET['_idUsuarioCarrera'];
    $idUsuarioCarrera = (!empty($idUsuarioCarrera)) ? $idUsuarioCarrera : FALSE;
    if ($idCiclo && $idUsuarioCarrera) {
        $estadoTipoPago = 1;
        $objTipoPagoDAO->objTipoPago->setIdCiclo($idCiclo);
        $objTipoPagoDAO->objTipoPago->setIdUsuarioCarrera($idUsuarioCarrera);
        $objTipoPagoDAO->objTipoPago->setIdEstadoTipoPago($estadoTipoPago);
        $duplicateTipoPago = $objTipoPagoDAO->DuplicateTipoPago($objTipoPagoDAO->objTipoPago);
    } else {
        $duplicateTipoPago = FALSE;
    }

    $duplicateTipoPago = array('count' => count($duplicateTipoPago));
    echo json_encode($duplicateTipoPago);
}

if ($action == "findTipoPago") {

    $jsonTipoPago = array();
    $idTipoPago = base64_decode($_GET['_id']);
    $idTipoPago = (!empty($idTipoPago)) ? $idTipoPago : FALSE;
    if ($idTipoPago) {
        $objTipoPagoDAO->objTipoPago->setIdTipoPago($idTipoPago);
        $jsonTipoPago = $objTipoPagoDAO->SearchTipoPagoID($objTipoPagoDAO->objTipoPago);
        $jsonTipoPago = $jsonTipoPago[0];
    } else {
        $jsonTipoPago = FALSE;
    }

    echo json_encode($jsonTipoPago);
}

if ($action == "delete") {
    $error = TRUE;
    $idTipoPago = base64_decode($_GET['idTipoPago']);
    $code = $_GET['code'];
    $indicador = 1;
    if ($code == '1234') {
        $objTipoPagoDAO->objTipoPago->setIdTipoPago($idTipoPago);
        $objTipoPagoDAO->objTipoPago->setIndicador($indicador);
        $matricula = $objTipoPagoDAO->ExecuteDelete($objTipoPagoDAO->objTipoPago);
        $error = ($matricula !== TRUE) ? TRUE : FALSE;
        echo ($error) ? 'fail' : 'success';
    } else {
        echo 'errorCode';
    }
}

if ($action == 'combobox') {
    $cbx = array();
    $combo = $objTipoPagoDAO->ExecuteCompleteCombobox($objTipoPagoDAO->objTipoPago);
    foreach ($combo as $key => $val) {
        $cbx[$key] = array(
			"idTipoPago" => $val->idTipoPago,
			"tppDescripcion" => $val->tppDescripcion,
			"tppMonto" => $val->tppMonto
		);
    }
    echo json_encode($cbx);
}
