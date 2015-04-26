<?php

session_start();
require_once __DIR__.'/../model/dao/inscripcionDAO.php';
require_once __DIR__.'/../model/dao/gridDAO.php';

$objInscripcionDAO = new InscripcionDAO();
$objGridDAO = new GridDAO();

$action = $_GET["action"];

if ($action == "searchData") {
    $idInscripcion = $_GET['id'];
    $objInscripcionDAO->objInscripcion->setIdInscripcion($idInscripcion);
    $inscripcion = $objInscripcionDAO->ExecuteSearch($objInscripcionDAO->objInscripcion);
    $inscripcion = $inscripcion[0];
    echo json_encode($inscripcion);
}