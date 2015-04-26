<?php

session_start();
require_once __DIR__ . '/../model/dao/pagosDAO.php';
require_once __DIR__ . '/../model/dao/matriculaDAO.php';
require_once __DIR__ . '/../model/dao/carreraDAO.php';

$objPagosDAO = new PagosDAO();
$objMatriculaDAO = new MatriculaDAO();
$objCarreraDAO = new CarreraDAO();

$action = $_GET["action"];

if ($action == "save") {
    $error = TRUE;
    $idPagos = $_GET['idPagos'];
    $idTipoPago = $_GET['idTipoPago'];
    $idModoPago = $_GET['idModoPago'];
    $TipoComprobante = $_GET['TipoComprobante'];
    $NumComprobante = $_GET['NumComprobante'];
    $Pago = $_GET['Pago'];
    $PagoDesc = $_GET['PagoDesc'];
    $Beneficio = $_GET['Beneficio'];
    $Fecha = date('Y-m-d');
    $Hora = date('H:i:s');
    $idMatricula = $_GET['idMatricula'];
    $Indicador = 1;

    $objPagosDAO->objPagos->setIdPagos($idPagos);
    $objPagosDAO->objPagos->setIdTipoPago($idTipoPago);
    $objPagosDAO->objPagos->setIdModoPago($idModoPago);
    $objPagosDAO->objPagos->setTipoComprobante($TipoComprobante);
    $objPagosDAO->objPagos->setNumComprobante($NumComprobante);
    $objPagosDAO->objPagos->setPago($Pago);
    $objPagosDAO->objPagos->setPagoDesc($PagoDesc);
    $objPagosDAO->objPagos->setBeneficio($Beneficio);
    $objPagosDAO->objPagos->setFecha($Fecha);
    $objPagosDAO->objPagos->setHora($Hora);
    $objPagosDAO->objPagos->setIdMatricula($idMatricula);
    $objPagosDAO->objPagos->setIndicador($Indicador);

    if ($idPagos != '') {
        $matricula = $objPagosDAO->ExecuteUpdate($objPagosDAO->objPagos);
    } else {
        $matricula = $objPagosDAO->ExecuteSave($objPagosDAO->objPagos);
        $idPagos = $matricula[1];
    }
    
    $error = ($matricula[0] !== TRUE) ? TRUE : FALSE;
    echo ($error) ? 'fail' : 'success';
}

if ($action == "countPago") {
    $idMatricula = $_GET['idMatricula'];
    $objPagosDAO->objPagos->setIdMatricula($idMatricula);
    $pagos = $objPagosDAO->CountPago($objPagosDAO->objPagos);
    echo json_encode($pagos);
}

if ($action == "searchDuplicate") {
    $idCiclo = $_GET['_idCiclo'];
    $idCiclo = (!empty($idCiclo)) ? $idCiclo : FALSE;
    $idUsuarioCarrera = $_GET['_idUsuarioCarrera'];
    $idUsuarioCarrera = (!empty($idUsuarioCarrera)) ? $idUsuarioCarrera : FALSE;
    if ($idCiclo && $idUsuarioCarrera) {
        $estadoMatricula = 1;
        $objPagosDAO->objPagos->setIdCiclo($idCiclo);
        $objPagosDAO->objPagos->setIdUsuarioCarrera($idUsuarioCarrera);
        $objPagosDAO->objPagos->setIdEstadoMatricula($estadoMatricula);
        $duplicateMatricula = $objPagosDAO->DuplicateMatricula($objPagosDAO->objPagos);
    } else {
        $duplicateMatricula = FALSE;
    }

    $duplicateMatricula = array('count' => count($duplicateMatricula));
    echo json_encode($duplicateMatricula);
}

if ($action == "findMatricula") {

    $jsonMatricula = array();
    $idMatricula = base64_decode($_GET['_id']);
    $idMatricula = (!empty($idMatricula)) ? $idMatricula : FALSE;
    if ($idMatricula) {
        $objPagosDAO->objPagos->setIdMatricula($idMatricula);
        $jsonMatricula = $objPagosDAO->SearchMatriculaID($objPagosDAO->objPagos);
        $jsonMatricula = $jsonMatricula[0];
    } else {
        $jsonMatricula = FALSE;
    }

    echo json_encode($jsonMatricula);
}

if ($action == "delete") {
    $error = TRUE;
    $idMatricula = base64_decode($_GET['idMatricula']);
    $code = $_GET['code'];
    $indicador = 1;
    if ($code == '1234') {
        $objPagosDAO->objPagos->setIdMatricula($idMatricula);
        $objPagosDAO->objPagos->setIndicador($indicador);
        $matricula = $objPagosDAO->ExecuteDelete($objPagosDAO->objPagos);
        $error = ($matricula !== TRUE) ? TRUE : FALSE;
        echo ($error) ? 'fail' : 'success';
    } else {
        echo 'errorCode';
    }
}

if ($action == 'combobox') {
    $cbx = array();
    $idUsuarioCarrera = $_GET['idUsuarioCarrera'];
    $idUsuarioCarrera = (!empty($idUsuarioCarrera)) ? $idUsuarioCarrera : 'undefined';
    $objPagosDAO->objPagos->setIdUsuarioCarrera($idUsuarioCarrera);
    $combo = $objPagosDAO->ExecuteCompleteCombobox($objPagosDAO->objPagos);
    foreach ($combo as $key => $val) {
		$objTipoBeneficioDAO->objTipoBeneficio->setIdTipoBeneficio($val->idTipoBeneficio);
		$arrayBeneficio = $objTipoBeneficioDAO->SearchTipoBeneficio($objTipoBeneficioDAO->objTipoBeneficio);
        $cbx[$key] = array(
			"idMatricula" => $val->idMatricula, 
			"mtcFecha" => $val->mtcFecha, 
			"mtcHora" => $val->mtcHora, 
			"idTipoBeneficio" => $val->idTipoBeneficio, 
			"tboDescripcion" => $val->tboDescripcion, 
			"idSeccion" => $val->idSeccion, 
			"scnDescripcion" => $val->scnDescripcion, 
			"idSede" => $val->idSede, 
			"sdeNombre" => $val->sdeNombre, 
			"idEstadoMatricula" => $val->idEstadoMatricula, 
			"etmDescripcion" => $val->etmDescripcion, 
			"idCiclo" => $val->idCiclo, 
			"cloDescripcion" => $val->cloDescripcion, 
			"idTurno" => $val->idTurno, 
			"troDescripcion" => $val->troDescripcion,
			"tboPagos" => $arrayBeneficio[0]->tboPagos,
			"tboPagoMensual" => $arrayBeneficio[0]->tboPagoMensual,
			"tboPaMatriculaDesc" => $arrayBeneficio[0]->tboPaMatriculaDesc,
			"tboPaMensualDesc" => $arrayBeneficio[0]->tboPaMensualDesc
		);
    }
    echo json_encode($cbx);
}
