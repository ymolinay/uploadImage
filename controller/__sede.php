<?php

session_start();
require_once __DIR__.'/../model/dao/sedeDAO.php';
require_once __DIR__.'/../model/dao/gridDAO.php';

$objSedeDAO = new SedeDAO();
$objGridDAO = new GridDAO();

$action = $_GET["action"];

if ($action == "combobox") {
    $cbx = array();
    $combo = $objSedeDAO->ExecuteCompleteCombobox();
    foreach ($combo as $key => $val) {
        $cbx[$key] = array("idSede" => $val->idSede, "sdeNombre" => $val->sdeNombre, "sdeDireccion"=>$val->sdeDireccion);
    }
    echo json_encode($cbx);
}