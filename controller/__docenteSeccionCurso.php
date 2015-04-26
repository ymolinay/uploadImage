<?php

session_start();
require_once __DIR__ . '/../model/dao/docenteSeccionCursoDAO.php';
require_once __DIR__ . '/../model/dao/gridDAO.php';

$objDocenteSeccionCursoDAO = new DocenteSeccionCursoDAO();
$objGridDAO = new GridDAO();

$action = $_GET["action"];

if ($action == 'save') {
    $error = TRUE;
    $idDocenteSeccionCurso = $_GET[''];
    $idSeccion = $_GET['idSeccion'];
    $idUsuario = $_GET['idDocente'];
    $idPlanEstudio = $_GET['idPlanEstudioCursos'];
    $indicador = '1';
    $objDocenteSeccionCursoDAO->objDocenteSeccionCurso->setIdDocenteSeccionCurso($idDocenteSeccionCurso);
    $objDocenteSeccionCursoDAO->objDocenteSeccionCurso->setIdSeccion($idSeccion);
    $objDocenteSeccionCursoDAO->objDocenteSeccionCurso->setIdUsuario($idUsuario);
    $objDocenteSeccionCursoDAO->objDocenteSeccionCurso->setIdPlanEstudio($idPlanEstudio);
    $objDocenteSeccionCursoDAO->objDocenteSeccionCurso->setIndicador($indicador);
    if ($idDocenteSeccionCurso != '') {
        $resultDocenteSeccionCurso = $objDocenteSeccionCursoDAO->ExecuteUpdate($objDocenteSeccionCursoDAO->objDocenteSeccionCurso);
    } else {
        $resultDocenteSeccionCurso = $objDocenteSeccionCursoDAO->ExecuteSave($objDocenteSeccionCursoDAO->objDocenteSeccionCurso);
    }
    $error = ($resultDocenteSeccionCurso !== TRUE) ? TRUE : FALSE;
    echo ($error) ? 'fail' : 'success';
}

if ($action == "comboboxDocente") {
    $idPerfil = $_SESSION['sessionIdPerfil'];
    /* if ($idPerfil == 4) {
      $idUsuario = $_SESSION['sessionIdUsuario'];
      } else if ($idPerfil == 3 || $idPerfil == 1) {
      $idUsuario = '';
      } */
    $idUsuario = ($idPerfil == 4) ? $_SESSION['sessionIdUsuario'] : (($idPerfil == 3 || $idPerfil == 1) ? '' : 'undefined');
    $objDocenteSeccionCursoDAO->objDocenteSeccionCurso->setIdUsuario($idUsuario);
    $cbx = false;
    $combo = array();
    $combo = $objDocenteSeccionCursoDAO->CompleteComboboxDocente($objDocenteSeccionCursoDAO->objDocenteSeccionCurso);
    foreach ($combo as $key => $val) {
        $cbx[$key] = array("idDocenteSeccionCurso" => $val->idDocenteSeccionCurso, "idUsuario" => $val->idUsuario, "prsNombre" => $val->prsNombre, "prsApellidoPaterno" => $val->prsApellidoPaterno, "prsApellidoMaterno" => $val->prsApellidoMaterno, "prsDNI" => $val->prsDNI);
    }
    echo json_encode($cbx);
}

if ($action == "comboboxCarrera") {
    $idDocenteSeccionCurso = $_GET['_idDoc'];
    $idUsuario = $_GET['_idUsu'];
    //$objDocenteSeccionCursoDAO->objDocenteSeccionCurso->setIdDocenteSeccionCurso($idDocenteSeccionCurso);
    $objDocenteSeccionCursoDAO->objDocenteSeccionCurso->setIdUsuario($idUsuario);
    $cbx = false;
    $combo = array();
    $combo = $objDocenteSeccionCursoDAO->CompleteComboboxCarrera($objDocenteSeccionCursoDAO->objDocenteSeccionCurso);
    foreach ($combo as $key => $val) {
        $cbx[$key] = array("idCarrera" => $val->idCarrera, "carDescripcion" => $val->carDescripcion, "carPeriodos" => $val->carPeriodos);
    }
    echo json_encode($cbx);
}

if ($action == "comboboxCiclo") {
    $idDocenteSeccionCurso = $_GET['_idDoc'];
    $idCarrera = $_GET['_idCar'];
    $idUsuario = $_GET['_idUsu'];
    //$objDocenteSeccionCursoDAO->objDocenteSeccionCurso->setIdDocenteSeccionCurso($idDocenteSeccionCurso);
    $objDocenteSeccionCursoDAO->objDocenteSeccionCurso->setIdUsuario($idUsuario);
    $cbx = false;
    $combo = array();
    $combo = $objDocenteSeccionCursoDAO->CompleteComboboxCarreraCiclo($objDocenteSeccionCursoDAO->objDocenteSeccionCurso, $idCarrera);
    foreach ($combo as $key => $val) {
        $cbx[$key] = array("idCiclo" => $val->idCiclo, "cloDescripcion" => $val->cloDescripcion);
    }
    echo json_encode($cbx);
}

if ($action == "comboboxCursos") {
    $idDocenteSeccionCurso = $_GET['_idDoc'];
    $idCarrera = $_GET['_idCar'];
    $idUsuario = $_GET['_idUsu'];
    $idCiclo = $_GET['_idCil'];
    //$objDocenteSeccionCursoDAO->objDocenteSeccionCurso->setIdDocenteSeccionCurso($idDocenteSeccionCurso);
    $objDocenteSeccionCursoDAO->objDocenteSeccionCurso->setIdUsuario($idUsuario);
    $cbx = false;
    $combo = array();
    $combo = $objDocenteSeccionCursoDAO->CompleteComboboxCarreraCicloCurso($objDocenteSeccionCursoDAO->objDocenteSeccionCurso, $idCarrera, $idCiclo);
    foreach ($combo as $key => $val) {
        $cbx[$key] = array("idPlanEstudio" => $val->idPlanEstudio, "idCurso" => $val->idCurso, "crsNombre" => $val->crsNombre);
    }
    echo json_encode($cbx);
}

if ($action == "comboboxSecciones") {
    $idDocenteSeccionCurso = $_GET['_idDoc'];
    $idCarrera = $_GET['_idCar'];
    $idUsuario = $_GET['_idUsu'];
    $idCiclo = $_GET['_idCil'];
    $idTurno = $_GET['_idTur'];
    $idPlanEstudio = $_GET['_idPla'];
    //$objDocenteSeccionCursoDAO->objDocenteSeccionCurso->setIdDocenteSeccionCurso($idDocenteSeccionCurso);
    $objDocenteSeccionCursoDAO->objDocenteSeccionCurso->setIdUsuario($idUsuario);
    $objDocenteSeccionCursoDAO->objDocenteSeccionCurso->setIdPlanEstudio($idPlanEstudio);
    $cbx = false;
    $combo = array();
    $combo = $objDocenteSeccionCursoDAO->CompleteComboboxCarreraCicloCursoSeccion($objDocenteSeccionCursoDAO->objDocenteSeccionCurso, $idCarrera, $idCiclo, $idTurno);
    foreach ($combo as $key => $val) {
        $cbx[$key] = array("idSeccion" => $val->idSeccion, "scnDescripcion" => $val->scnDescripcion, "scnCantMaxima" => $val->scnCantMaxima, "scnInicio" => $val->scnInicio, "scnFin" => $val->scnFin);
    }
    echo json_encode($cbx);
}