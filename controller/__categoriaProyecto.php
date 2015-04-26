<?php

session_start();
require_once __DIR__.'/../model/dao/categoriaProyectoDAO.php';
require_once __DIR__.'/../model/dao/gridDAO.php';

$objCategoriaProyectoDAO = new CategoriaProyectoDAO();
$objGridDAO = new GridDAO();

$action = $_GET['action'];

if ($action == "combobox") {
    $cbx = array();
    $combo = $objCategoriaProyectoDAO->ExecuteCompleteCombobox();
    foreach ($combo as $key => $val) {
        $cbx[$key] = array("idCategoriaProyecto"=>$val->idCategoriaProyecto,"descripcionCategoria"=>$val->descripcionCategoria);
    }
    echo json_encode($cbx);
}