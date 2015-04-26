<?php

session_start();
require_once __DIR__.'/../model/dao/sedeDAO.php';
require_once __DIR__.'/../model/dao/gridDAO.php';

$objSedeDAO = new SedeDAO();
$objGridDAO = new GridDAO();

$action = $_GET["action"];

if ($action == "combobox") {
    $cbx = '';
    $sep = '';
    $combo = $objSedeDAO->ExecuteCompleteCombobox();
    foreach ($combo as $key => $val) {
        $cbx.=$sep . $val->idSede . ';' . $val->descripcion;
        $sep = ';;';
    }
    echo $cbx;
}
