<?php

session_start();
require_once __DIR__ . '/../model/dao/matriculaDAO.php';
require_once __DIR__ . '/../model/dao/matriculaDetalleDAO.php';
require_once __DIR__ . '/../model/dao/matriculaNotasDAO.php';
require_once __DIR__ . '/../model/dao/tipoBeneficioDAO.php';
require_once __DIR__ . '/../model/dao/gridDAO.php';

$objMatriculaDAO = new MatriculaDAO();
$objMatriculaDetalleDAO = new MatriculaDetalleDAO();
$objMatriculaNotasDAO = new MatriculaNotasDAO();
$objTipoBeneficioDAO = new TipoBeneficioDAO();
$objGridDAO = new GridDAO();

$action = $_GET["action"];

if ($action == "save") {
    $error = TRUE;
    $idMatricula = $_GET['idMatricula'];
    $Fecha = date('Y-m-d');
    $Hora = date('H:i:s');
    $idUsuarioCarrera = $_GET['idUsuarioCarrera'];
    $idCiclo = $_GET['idCiclo'];
    $idSeccion = $_GET['idSeccion'];
    $idSede = $_GET['idSede'];
    $idTipoBeneficio = $_GET['idTipoBeneficio'];
    $idEstadoMatricula = 1;
    $Indicador = 1;

    $objMatriculaDAO->objMatricula->setIdMatricula($idMatricula);
    $objMatriculaDAO->objMatricula->setFecha($Fecha);
    $objMatriculaDAO->objMatricula->setHora($Hora);
    $objMatriculaDAO->objMatricula->setIdUsuarioCarrera($idUsuarioCarrera);
    $objMatriculaDAO->objMatricula->setIdCiclo($idCiclo);
    $objMatriculaDAO->objMatricula->setIdSeccion($idSeccion);
    $objMatriculaDAO->objMatricula->setIdSede($idSede);
    $objMatriculaDAO->objMatricula->setIdTipoBeneficio($idTipoBeneficio);
    $objMatriculaDAO->objMatricula->setIdEstadoMatricula($idEstadoMatricula);
    $objMatriculaDAO->objMatricula->setIndicador($Indicador);

    if ($idMatricula != '') {
        $matricula = $objMatriculaDAO->ExecuteUpdate($objMatriculaDAO->objMatricula);
    } else {
        $matricula = $objMatriculaDAO->ExecuteSave($objMatriculaDAO->objMatricula);
        $idMatricula = $matricula[1];
    }

    if ($matricula[0] !== TRUE) {
        $error = TRUE;
    } else {
        $error = TRUE;
        $objMatriculaDetalleDAO2 = new MatriculaDetalleDAO();
        $objMatriculaDetalleDAO2->objMatriculaDetalle->setIdMatricula($idMatricula);
        $deleteMatriculaDetalle = $objMatriculaDetalleDAO2->UpdateDeleteMatriculaDetalle($objMatriculaDetalleDAO2->objMatriculaDetalle);
        if ($deleteMatriculaDetalle !== TRUE) {
            $result2[0] === FALSE;
        } else {
            foreach ($_GET['_gridCheckBox'] as $key => $val) {
                $objMatriculaDetalleDAO->objMatriculaDetalle->setIdMatricula($idMatricula);
                $objMatriculaDetalleDAO->objMatriculaDetalle->setIdPlanEstudio(base64_decode($val));
                $objMatriculaDetalleDAO->objMatriculaDetalle->setIndicador($Indicador);
                $result2 = $objMatriculaDetalleDAO->ExecuteSave($objMatriculaDetalleDAO->objMatriculaDetalle);

                /* Creación de datos en tabla matriculanotas */
                $u1Ev1 = $u1Ev2 = $u1Ev3 = $u1Ev4 = $u1PromPract = $u1ExParcial = $u1Promedio = $u2Ev1 = $u2Ev2 = $u2Ev3 = $u2Ev4 = $u2PromPract = $u2Trabajo = $u2ExFinal = $u2Promedio = $susti = $promedioFinal = 0;
                $indicadorNotas = 1;
                $objMatriculaNotasDAO->objMatriculaNotas->setU1Ev1($u1Ev1);
                $objMatriculaNotasDAO->objMatriculaNotas->setU1Ev2($u1Ev2);
                $objMatriculaNotasDAO->objMatriculaNotas->setU1Ev3($u1Ev3);
                $objMatriculaNotasDAO->objMatriculaNotas->setU1Ev4($u1Ev4);
                $objMatriculaNotasDAO->objMatriculaNotas->setU1PromPract($u1PromPract);
                $objMatriculaNotasDAO->objMatriculaNotas->setU1ExParcial($u1ExParcial);
                $objMatriculaNotasDAO->objMatriculaNotas->setU1Promedio($u1Promedio);
                $objMatriculaNotasDAO->objMatriculaNotas->setU2Ev1($u2Ev1);
                $objMatriculaNotasDAO->objMatriculaNotas->setU2Ev2($u2Ev2);
                $objMatriculaNotasDAO->objMatriculaNotas->setU2Ev3($u2Ev3);
                $objMatriculaNotasDAO->objMatriculaNotas->setU2Ev4($u2Ev4);
                $objMatriculaNotasDAO->objMatriculaNotas->setU2PromPract($u2PromPract);
                $objMatriculaNotasDAO->objMatriculaNotas->setU2Trabajo($u2Trabajo);
                $objMatriculaNotasDAO->objMatriculaNotas->setU2ExFinal($u2ExFinal);
                $objMatriculaNotasDAO->objMatriculaNotas->setU2Promedio($u2Promedio);
                $objMatriculaNotasDAO->objMatriculaNotas->setSusti($susti);
                $objMatriculaNotasDAO->objMatriculaNotas->setPromedioFinal($promedioFinal);
                $objMatriculaNotasDAO->objMatriculaNotas->setIdMatriculaDetalle($result2[1]);
                $objMatriculaNotasDAO->objMatriculaNotas->setIndicador($indicadorNotas);
                $objMatriculaNotasDAO->ExecuteSave($objMatriculaNotasDAO->objMatriculaNotas);
                /* Creación de datos en tabla matriculanotas - FIN */
            }
        }

        $error = ($result2[0] === TRUE) ? FALSE : TRUE;
    }
    echo ($error) ? 'fail' : 'success';
}

if ($action == "currentStudents") {
    $error = TRUE;
    $idSeccion = $_GET['idSeccion'];
    $objMatriculaDAO->objMatricula->setIdSeccion($idSeccion);
    $current = $objMatriculaDAO->CurrentStudentsSeccion($objMatriculaDAO->objMatricula);
    $current = array("current" => count($current));
    echo json_encode($current);
}

if ($action == "searchDuplicate") {
    $idCiclo = $_GET['_idCiclo'];
    $idCiclo = (!empty($idCiclo)) ? $idCiclo : FALSE;
    $idUsuarioCarrera = $_GET['_idUsuarioCarrera'];
    $idUsuarioCarrera = (!empty($idUsuarioCarrera)) ? $idUsuarioCarrera : FALSE;
    if ($idCiclo && $idUsuarioCarrera) {
        $estadoMatricula = 1;
        $objMatriculaDAO->objMatricula->setIdCiclo($idCiclo);
        $objMatriculaDAO->objMatricula->setIdUsuarioCarrera($idUsuarioCarrera);
        $objMatriculaDAO->objMatricula->setIdEstadoMatricula($estadoMatricula);
        $duplicateMatricula = $objMatriculaDAO->DuplicateMatricula($objMatriculaDAO->objMatricula);
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
        $objMatriculaDAO->objMatricula->setIdMatricula($idMatricula);
        $jsonMatricula = $objMatriculaDAO->SearchMatriculaID($objMatriculaDAO->objMatricula);
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
        $objMatriculaDAO->objMatricula->setIdMatricula($idMatricula);
        $objMatriculaDAO->objMatricula->setIndicador($indicador);
        $matricula = $objMatriculaDAO->ExecuteDelete($objMatriculaDAO->objMatricula);
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
    $objMatriculaDAO->objMatricula->setIdUsuarioCarrera($idUsuarioCarrera);
    $combo = $objMatriculaDAO->ExecuteCompleteCombobox($objMatriculaDAO->objMatricula);
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
			"tboPagoMatricula" => $arrayBeneficio[0]->tboPagoMatricula,
			"tboPagoMensual" => $arrayBeneficio[0]->tboPagoMensual,
			"tboPaMatriculaDesc" => $arrayBeneficio[0]->tboPaMatriculaDesc,
			"tboPaMensualDesc" => $arrayBeneficio[0]->tboPaMensualDesc
		);
    }
    echo json_encode($cbx);
}
