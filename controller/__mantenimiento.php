<?php

require_once __DIR__.'/../model/dao/mantenimientoDAO.php';
require_once __DIR__.'/../model/dao/gridDAO.php';

$objMantenimientoDAO = new MantenimientoDAO();
$objGridDAO = new GridDAO();

$action = $_GET['action'];

if ($action == 'duplicate') {
    $table = $_GET['table'];
    $field = $_GET['field'];
    $search = $_GET['search'];
    $fieldId = $_GET['fieldId'];
    $id = $_GET['id'];

    $objMantenimientoDAO->objMantenimiento->setTable($table);
    $objMantenimientoDAO->objMantenimiento->setField($field);
    $objMantenimientoDAO->objMantenimiento->setSearch($search);
    $objMantenimientoDAO->objMantenimiento->setFieldId($fieldId);
    $objMantenimientoDAO->objMantenimiento->setId($id);

    $duplicate = $objMantenimientoDAO->ExecuteSearch($objMantenimientoDAO->objMantenimiento);

    if ($duplicate > 0) {
        echo 'fail';
    } else {
        echo 'success';
    }
}

if ($action == 'delete') {
    $table = $_GET['table'];
    $fieldId = $_GET['fieldId'];
    $id = $_GET['id'];
    
    $objMantenimientoDAO->objMantenimiento->setTable($table);
    $objMantenimientoDAO->objMantenimiento->setFieldId($fieldId);
    $objMantenimientoDAO->objMantenimiento->setId($id);
    
    $delete = $objMantenimientoDAO->ExecuteDelete($objMantenimientoDAO->objMantenimiento);
    
    if (!$delete) {
        echo 'fail';
    } else {
        echo 'success';
    }
}