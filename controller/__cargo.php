<?php

session_start();
require_once __DIR__.'/../model/dao/cargoDAO.php';
require_once __DIR__.'/../model/dao/gridDAO.php';

$objCargoDAO = new CargoDAO();
$objGridDAO = new GridDAO();

$action = $_GET["action"];

if ($action == "combobox") {
    $cbx = '';
    $sep = '';
    $combo = $objCargoDAO->ExecuteCompleteCombobox();
    foreach ($combo as $key => $val) {
        $cbx.=$sep . $val->idCargo . ';' . $val->descripcion;
        $sep = ';;';
    }
    echo $cbx;
}