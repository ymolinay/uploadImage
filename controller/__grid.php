<?php

session_start();
require_once __DIR__.'/../model/dao/gridDAO.php';

$objGridDAO = new GridDAO();

$action = $_GET['action'];

//if ($action == "grid") {
//    $page = $_POST['page'];  // Página actual
//    $limit = $_POST['rows']; // Filas que se van a mostrar por página
//    $sidx = $_POST['sidx'];  // Índice que ordena los datos
//    $sord = $_POST['sord'];  // Modo de ordanación
//
//    if (!$sidx) {
//        $sidx = 1;
//    }
//
//    $objGridDAO->objGrid->setPage($page);
//    $objGridDAO->objGrid->setLimit($limit);
//    $objGridDAO->objGrid->setSidx($sidx);
//    $objGridDAO->objGrid->setSord($sord);
//
//    $respuesta = $objGridDAO->SearchGrid("personalGrid", "personal", $objGridDAO->objGrid, $objUsuarioDAO->objUsuario);
//    echo json_encode($respuesta);
//}

if ($action == "loadGrid") {

    $dbTable = $_GET['dbTable'];
    $fields = $_GET['fields'];

    $whereFields = $_GET['whereFields'];
    $whereLogical = $_GET['whereLogical'];
    $whereValues = $_GET['whereValues'];
    
    $joinType = $_GET['joinType'];
    $joinOn = base64_decode($_GET['joinOn']);
    $joinIndex  = $_GET['index'];

    $whereValues = explode(';', $whereValues);

    foreach ($whereValues as $key => $val) {
        if (strpos($val, 'current') !== false) {
            $whereValues[$key]=$_SESSION['session' . substr($val, 7)];
        }
    }
    
    $whereValues = implode(';', $whereValues);

    $limit = $_GET['limit'];
    $orderName = $_GET['orderName'];
    $orderMode = $_GET['orderMode'];
    $page = $_GET['page'];

    $objGridDAO->objGrid->setDbTable($dbTable);
    $objGridDAO->objGrid->setFields($fields);

    $objGridDAO->objGrid->setJoinIndex($joinIndex);
    $objGridDAO->objGrid->setJoinType($joinType);
    $objGridDAO->objGrid->setJoinOn($joinOn);
    
    $objGridDAO->objGrid->setWhereFields($whereFields);
    $objGridDAO->objGrid->setWhereLogical($whereLogical);
    $objGridDAO->objGrid->setWhereValues($whereValues);

    $objGridDAO->objGrid->setLimit($limit);
    $objGridDAO->objGrid->setOrderName($orderName);
    $objGridDAO->objGrid->setOrderMode($orderMode);
    $objGridDAO->objGrid->setPage($page);

    $data = $objGridDAO->LoadGrid($objGridDAO->objGrid);
    echo json_encode($data);
}