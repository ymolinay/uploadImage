<?php

session_start();
require_once __DIR__.'/../model/dao/sedeTempDAO.php';
require_once __DIR__.'/../model/dao/gridDAO.php';

$objSedeTempDAO = new SedeTempDAO();
$objGridDAO = new GridDAO();

$action = $_GET["action"];

if ($action == "save") {
    $idAcceso = $_SESSION["sessionIdAcceso"];
    $sede = $_GET['txtSede']; //descripcion
    $direccion = $_GET['txtDireccion'];
    $idUbigeo = $_GET['txtUbigeo'];
    $indicador = '1';

    $objSedeTempDAO->objSedeTemp->setIdAcceso($idAcceso);
    $objSedeTempDAO->objSedeTemp->setDescripcion($sede);
    $objSedeTempDAO->objSedeTemp->setDireccion($direccion);
    $objSedeTempDAO->objSedeTemp->setIdUbigeo($idUbigeo);
    $objSedeTempDAO->objSedeTemp->setIndicador($indicador);

    $result = $objSedeTempDAO->ExecuteSave($objSedeTempDAO->objSedeTemp);
    
    if ($result[0] == "1") {
        echo "success";
    } else {
        echo "failed";
    }

}
if ($action == "combobox") {
    $idAcceso = $_SESSION["sessionIdAcceso"]; //Yrving no quiere subirlo >.<
    $cbx = array();
    $sep = '';

    $objSedeTempDAO->objSedeTemp->setIdAcceso($idAcceso);
    $combo = $objSedeTempDAO->ExecuteCompleteCombobox($objSedeTempDAO->objSedeTemp);
    foreach ($combo as $key => $val) {
        $cbx[$key]=array("idSedeTemp"=>$val->idSedeTemp,"descripcion"=>$val->descripcion);
    }
    echo json_encode($cbx);
}
if ($action == "delete") {
    $idSedeTemp = base64_decode($_GET['id']);
    
    $objSedeTempDAO->objSedeTemp->setIdSedeTemp($idSedeTemp);
    $result = $objSedeTempDAO->ExecuteDeleteItem($objSedeTempDAO->objSedeTemp);
    
    if ($result == "1") {
        echo "success";
    } else {
        echo "failed";
    }
}
if ($action == "clear") {
    $idAcceso = $_SESSION["sessionIdAcceso"];
    $objSedeTempDAO->objSedeTemp->setIdAcceso($idAcceso);
    $result = $objSedeTempDAO->ExecuteDelete($objSedeTempDAO->objSedeTemp);
    
    if ($result == "1") {
        echo "success";
    } else {
        echo "failed";
    }
}
