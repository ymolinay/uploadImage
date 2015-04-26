<?php

session_start();
require_once __DIR__.'/../model/dao/tipoBeneficioDAO.php';
require_once __DIR__.'/../model/dao/gridDAO.php';

$objTipoBeneficioDAO = new TipoBeneficioDAO();
$objGridDAO = new GridDAO();

$action = $_GET["action"];

if ($action == 'combobox') {
    $cbx = array();
    $combo = $objTipoBeneficioDAO->SearchAllData();
    foreach ($combo as $key => $val) {
        $cbx[$key] = array("idTipoBeneficio" => $val->idTipoBeneficio, "tboDescripcion" => $val->tboDescripcion, "tboDescuentoPorcentaje" => $val->tboDescuentoPorcentaje);
    }
    echo json_encode($cbx);
}