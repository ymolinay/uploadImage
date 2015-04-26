<?php

session_start();
require_once __DIR__.'/../model/dao/matriculaDetalleDAO.php';
require_once __DIR__.'/../model/dao/gridDAO.php';

$objMatriculaDetalleDAO = new MatriculaDetalleDAO();
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
    $idEstadoMatricula = 1;
    $Indicador = 1;

    $objMatriculaDetalleDAO->objMatriculaDetalle->setIdMatriculaDetalle($idMatriculaDetalle);
    $objMatriculaDetalleDAO->objMatriculaDetalle->setIdMatricula($idMatricula);
    $objMatriculaDetalleDAO->objMatriculaDetalle->setIdPlanEstudio($idPlanEstudio);
    $objMatriculaDetalleDAO->objMatriculaDetalle->setIndicador($indicador);

    if ($idMatricula != '') {
        
    } else {
        $matricula = $objMatriculaDAO->ExecuteSave($objMatriculaDAO->objMatricula);
    }

    if ($matricula[0] !== TRUE) {
        $error = TRUE;
    } else {
        $error = FALSE;
    }

    echo ($error) ? 'fail' : 'success';
}

if($action=="searchDetalleMatricula"){
    $jsonMatriculaDetalle = FALSE;
    $idMatricula = $_GET['idMatricula'];
    $idMatricula = (!empty($idMatricula)) ? $idMatricula : FALSE;
    if($idMatricula){
        $objMatriculaDetalleDAO->objMatriculaDetalle->setIdMatricula($idMatricula);
        $jsonMatriculaDetalle = $objMatriculaDetalleDAO->SearchDetalleMatricula($objMatriculaDetalleDAO->objMatriculaDetalle);
    }
    echo json_encode($jsonMatriculaDetalle);
}