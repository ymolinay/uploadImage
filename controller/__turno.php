<?php

session_start();
require_once __DIR__.'/../model/dao/turnoDAO.php';
require_once __DIR__.'/../model/dao/gridDAO.php';

$objTurnoDAO = new TurnoDAO();
$objGridDAO = new GridDAO();

$action = $_GET["action"];

if ($action == 'combobox') {
    $cbx = array();
    $combo = $objTurnoDAO->SearchAllData();
    foreach ($combo as $key => $val) {
        $cbx[$key] = array("idTurno" => $val->idTurno, "troDescripcion" => $val->troDescripcion);
    }
    echo json_encode($cbx);
}