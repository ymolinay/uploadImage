<?php

session_start();

require_once __DIR__.'/../model/dao/proyectoDAO.php';
require_once __DIR__.'/../model/dao/gridDAO.php';

$objProyectoDAO = new ProyectoDAO();
$objGridDAO = new GridDAO();

$action = $_GET["action"];

if ($action == 'save') {
    $idProyecto = $_GET['txtIdProyecto'];
    $codigo = $_GET['txtCodigo'];
    $nombre = $_GET['txtProyecto'];

    $temp = str_replace('/', '-', $_GET['txtFechaInicio']);
    $fechaIni = date('Y-m-d', strtotime($temp));

    $temp = str_replace('/', '-', $_GET['txtFechaFin']);
    $fechaFin = date('Y-m-d', strtotime($temp));

    $idJefeProyecto = $_GET['txtJefeProyecto'];
    $idSupervisor = $_GET['txtSupervisor'];
    $idAsistenteProyecto = $_GET['txtAsistente'];
    $idCategoriaProyecto = $_GET['txtCategoria'];
    $idCuenta = $_GET['txtCuenta'];
    $idEstadoProyecto = '1';
    $observacion = $_GET['txtObservacion'];
    $indicador = '1';

    $objProyectoDAO->objProyecto->setIdProyecto($idProyecto);
    $objProyectoDAO->objProyecto->setCodigo($codigo);
    $objProyectoDAO->objProyecto->setNombre($nombre);
    $objProyectoDAO->objProyecto->setFechaIni($fechaIni);
    $objProyectoDAO->objProyecto->setFechaFin($fechaFin);
    $objProyectoDAO->objProyecto->setJefeProyecto($idJefeProyecto);
    $objProyectoDAO->objProyecto->setSupervisorProyecto($idSupervisor);
    $objProyectoDAO->objProyecto->setAsistenteProyecto($idAsistenteProyecto);
    $objProyectoDAO->objProyecto->setIdCategoriaProyecto($idCategoriaProyecto);
    $objProyectoDAO->objProyecto->setIdCuenta($idCuenta);
    $objProyectoDAO->objProyecto->setIdEstadoProyecto($idEstadoProyecto);
    $objProyectoDAO->objProyecto->setObservacion($observacion);
    $objProyectoDAO->objProyecto->setIndicador($indicador);

    if ($idProyecto != '') {
        $proyecto = $objProyectoDAO->ExecuteUpdate($objProyectoDAO->objProyecto);
    } else {
        $proyecto = $objProyectoDAO->ExecuteSave($objProyectoDAO->objProyecto);
    }

    if ($proyecto === TRUE) {
        echo 'success';
    } else {
        echo 'fail';
    }
}

if ($action == 'code') {
    $count = $objProyectoDAO->GenerateProjectCode();
    $number = str_pad($count + 1, 10, "0", STR_PAD_LEFT);
    $prefix = 'PRJ';
    $code = $prefix . $number;

    $project = new stdClass();
    $project->code = $code;

    echo json_encode($project);
}

if ($action == 'combobox') {
    //$idPerfil = $_GET['perfil'];
    //$objUsuarioDAO->objUsuario->setIdPerfil($idPerfil);
    $cbx = array();
    //$combo = $objPersonalDAO->ExecuteCompleteCombobox($objUsuarioDAO->objUsuario);
    $combo = $objProyectoDAO->ExecuteCompleteCombobox();
    foreach ($combo as $key => $val) {
        $cbx[$key] = array("idProyecto" => $val->idProyecto, "nombre" => $val->nombre, "codigo" => $val->codigo);
    }
    echo json_encode($cbx);
}

if ($action == 'find') {
    $id = base64_decode($_GET['idProyecto']);

    $objProyectoDAO->objProyecto->setIdProyecto($id);
    $proyecto = $objProyectoDAO->ExecuteFind($objProyectoDAO->objProyecto);
    $proyecto = $proyecto[0];

    echo json_encode($proyecto);
}