<?php

session_start();
require_once __DIR__.'/../model/dao/perfilDAO.php';
require_once __DIR__.'/../model/dao/gridDAO.php';

$objPerfilDAO = new PerfilDAO();
$objGridDAO = new GridDAO();

$action = $_GET["action"];

if ($action == "combobox") {
    $cbx = '';
    $sep = '';
    $combo = $objPerfilDAO->ExecuteCompleteCombobox();
    foreach ($combo as $key => $val) {
        $cbx.=$sep . $val->idPerfil . ';' . $val->descripcion;
        $sep = ';;';
    }
    echo $cbx;
    count($val);
}