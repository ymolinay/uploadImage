<?php

session_start();
require_once __DIR__.'/../model/dao/carreraDAO.php';
require_once __DIR__.'/../model/dao/gridDAO.php';

$objCursoDAO = new CarreraDAO();
$objGridDAO = new GridDAO();

$action = $_GET["action"];

if ($action == 'combobox') {
    
    $cbx = array();
    $combo = $objCursoDAO->SearchAllData();
    foreach ($combo as $key => $val) {
        $cbx[$key] = array("idCarrera" => $val->idCarrera, "carDescripcion" => $val->carDescripcion, "carPeriodos" => $val->carPeriodos, "carMeses" => $val->carMeses, "idCosto" => $val->idCosto);
    }
    echo json_encode($cbx);
}
if ($action == 'find') {
    $idCarrera = base64_decode($_GET['idCarrera']);
    $objCursoDAO->objCarrera->setIdCarrera($idCarrera);
    $carrera = $objCursoDAO->ExecuteSearch($objCursoDAO->objCarrera);
    $carrera = $carrera[0];

    $jsonCarrera = array("idCarrera" => $carrera->idCarrera, "descripcion" => $carrera->carDescripcion, "periodos" => $carrera->carPeriodos, "meses" => $carrera->carMeses, "idCosto" => $carrera->idCosto);
    echo json_encode($jsonCarrera);
}

if ($action == 'save') {
    $error = TRUE;
    $idCarrera = $_GET['inputIdCarrera'];
    $descripcion = $_GET['inputDescripcion'];
    $periodos = $_GET['inputPeriodos'];
    $meses = $_GET['inputMeses'];
    $objCursoDAO->objCarrera->setIdCarrera($idCarrera);
    $objCursoDAO->objCarrera->setDescripcion($descripcion);
    $objCursoDAO->objCarrera->setPeriodos($periodos);
    $objCursoDAO->objCarrera->setMeses($meses);
    $objCursoDAO->objCarrera->setIdCosto(1); // VERIFICAR

    if ($idCarrera != '') {
        $result = $objCursoDAO->ExecuteUpdate($objCursoDAO->objCarrera);
    } else {
        $result = $objCursoDAO->ExecuteSave($objCursoDAO->objCarrera);
    }

    $error = ($result !== TRUE) ? TRUE : FALSE;

    echo ($error) ? 'fail':'success';
}