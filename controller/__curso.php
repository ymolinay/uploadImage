<?php

session_start();
require_once __DIR__.'/../model/dao/cursoDAO.php';
require_once __DIR__.'/../model/dao/gridDAO.php';

$objCursoDAO = new CursoDAO();
$objGridDAO = new GridDAO();

$action = $_GET["action"];

if ($action == 'find') {
    $idCurso = base64_decode($_GET['idCurso']);
    $objCursoDAO->objCurso->setidCurso($idCurso);
    $curso = $objCursoDAO->ExecuteSearch($objCursoDAO->objCurso);
    $curso = $curso[0];

    $jsonCurso = array("idCurso" => $curso->idCurso, "nombre" => $curso->crsNombre);
    echo json_encode($jsonCurso);
}

if ($action == 'save') {
    $error = TRUE;
    $idCurso = $_GET['inputIdCurso'];
    $nombre = $_GET['inputNombre'];
    $indicador = 1;
    $objCursoDAO->objCurso->setIdCurso($idCurso);
    $objCursoDAO->objCurso->setNombre($nombre);
    $objCursoDAO->objCurso->setIndicador($indicador);

    if ($idCurso != '') {
        $result = $objCursoDAO->ExecuteUpdate($objCursoDAO->objCurso);
    } else {
        $result = $objCursoDAO->ExecuteSave($objCursoDAO->objCurso);
    }

    $error = ($result !== TRUE) ? TRUE : FALSE;

    echo ($error) ? 'fail' : 'success';
}

if ($action == "combobox") {
    $cbx = array();
    $combo = $objCursoDAO->ExecuteCompleteCombobox();
    foreach ($combo as $key => $val) {
        $cbx[$key] = array("idCurso" => $val->idCurso, "crsNombre" => $val->crsNombre);
    }
    echo json_encode($cbx);
}