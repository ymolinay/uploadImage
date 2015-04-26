<?php

session_start();
require_once __DIR__.'/../model/dao/categoriaDAO.php';
require_once __DIR__.'/../model/dao/gridDAO.php';

$objCategoriaDAO = new CategoriaDAO();
$objGridDAO = new GridDAO();

$action = $_GET['action'];

if ($action == "combobox") {
    $cbx = array();
    $combo = $objCategoriaDAO->ExecuteCompleteCombobox();
    foreach ($combo as $key => $val) {
        $cbx[$key] = array("idCategoria"=>$val->idCategoria,"descripcion"=>$val->descripcion);
    }
    echo json_encode($cbx);
}