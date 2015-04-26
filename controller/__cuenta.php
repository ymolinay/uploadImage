<?php

session_start();
require_once __DIR__.'/../model/dao/cuentaDAO.php';
require_once __DIR__.'/../model/dao/gridDAO.php';
//extras
require_once __DIR__.'/../model/dao/sedeDAO.php';
require_once __DIR__.'/../model/dao/sedeTempDAO.php';
require_once __DIR__.'/../model/dao/areaDAO.php';
require_once __DIR__.'/../model/dao/areaTempDAO.php';

$objCuentaDAO = new CuentaDAO();
$objGridDAO = new GridDAO();
$objSedeDAO = new SedeDAO();
$objSedeTempDAO = new SedeTempDAO();
$objAreaDAO = new AreaDAO();
$objAreaTempDAO = new AreaTempDAO();

$action = $_GET["action"];

if ($action == "save") {

    $idCuenta = $_GET["txtIdCuenta"];
    $razonSocial = $_GET["txtRazonSocial"];
    $nombreComercial = $_GET["txtNombreComercial"];
    $ruc = $_GET["txtRUC"];
    $direccion = $_GET["txtDireccion"];
    $telefono = $_GET["txtTelefono"];

    if (empty($idCuenta)) {
        $objCuentaDAO->objCuenta->setRazonSocial($razonSocial);
        $objCuentaDAO->objCuenta->setNombreComercial($nombreComercial);
        $objCuentaDAO->objCuenta->setRuc($ruc);
        $objCuentaDAO->objCuenta->setDireccion($direccion);
        $objCuentaDAO->objCuenta->setTelefono($telefono);
        $result = $objCuentaDAO->ExecuteSave($objCuentaDAO->objCuenta);
    } else {
        $objCuentaDAO->objCuenta->setIdCuenta($idCuenta);
        $objCuentaDAO->objCuenta->setRazonSocial($razonSocial);
        $objCuentaDAO->objCuenta->setNombreComercial($nombreComercial);
        $objCuentaDAO->objCuenta->setRuc($ruc);
        $objCuentaDAO->objCuenta->setDireccion($direccion);
        $objCuentaDAO->objCuenta->setTelefono($telefono);
        $arrayTemps = $objCuentaDAO->ExecuteUpdate($objCuentaDAO->objCuenta);

        foreach ($arrayTemps[0] as $valSede) {
            $objSedeDAO->objSede->setDescripcion($valSede->descripcion);
            $objSedeDAO->objSede->setDireccion($valSede->direccion);
            $objSedeDAO->objSede->setIdCuenta($idCuenta);
            $objSedeDAO->objSede->setIdUbigeo($valSede->idUbigeo);
            $objSedeDAO->objSede->setIndicador($valSede->indicador);
            $resultSede = $objSedeDAO->ExecuteSave($objSedeDAO->objSede);
            //idsede
            $idSedeTemp = $valSede->idSedeTemp;

            if ($resultSede[0]) {
                foreach ($arrayTemps[1] as $valArea) {
                    $idSedeTemp2 = $valArea->idSedeTemp;
                    //validamos que las areas correspondan a sus respectivas sedes
                    if ($idSedeTemp == $idSedeTemp2) {
                        $objAreaDAO->objArea->setDescripcion($valArea->descripcion);
                        $objAreaDAO->objArea->setIdSede($resultSede[1]);
                        $objAreaDAO->objArea->setIndicador($valArea->indicador);
                        $resultArea = $objAreaDAO->ExecuteSave($objAreaDAO->objArea);
                    }
                }
                
                if ($resultArea) {
                    $idAcceso = $_SESSION["sessionIdAcceso"];
                    $objAreaTempDAO->objAreaTemp->setIdAcceso($idAcceso);
                    $result = $objAreaTempDAO->ExecuteDelete($objAreaTempDAO->objAreaTemp);
                    
                    if ($result == "1") {
                        $objSedeTempDAO->objSedeTemp->setIdAcceso($idAcceso);
                        $result = $objSedeTempDAO->ExecuteDelete($objSedeTempDAO->objSedeTemp);
                    }
                }
            }
        }
    }

    if ($result == "1") {
        echo "success";
    } else {
        echo "failed";
    }
}

//if ($action == "combobox") {
//    $cbx = '';
//    $sep = '';
//    $combo = $objPerfilDAO->ExecuteCompleteCombobox();
//    foreach ($combo as $key => $val) {
//        $cbx.=$sep . $val->idPerfil . ';' . $val->descripcion;
//        $sep = ';;';
//    }
//    echo $cbx;
//}

if ($action == "grid") {
    $page = $_POST['page'];  // Página actual
    $limit = $_POST['rows']; // Filas que se van a mostrar por página
    $sidx = $_POST['sidx'];  // Índice que ordena los datos
    $sord = $_POST['sord'];  // Modo de ordanación

    if (!$sidx) {
        $sidx = 1;
    }

    $objGridDAO->objGrid->setPage($page);
    $objGridDAO->objGrid->setLimit($limit);
    $objGridDAO->objGrid->setSidx($sidx);
    $objGridDAO->objGrid->setSord($sord);

    $respuesta = $objGridDAO->SearchGrid("clienteGrid", "cuenta", $objGridDAO->objGrid, $objCuentaDAO->objCuenta);
    echo json_encode($respuesta);
}

if ($action == "search") {

    $idCuenta = base64_decode($_GET['id']);

    $objCuentaDAO->objCuenta->setIdCuenta($idCuenta);
    $data = $objCuentaDAO->ExecuteSelectItem($objCuentaDAO->objCuenta);
    //JSON
    foreach ($data as $key => $val) {
        $result[$key] = array("idCuenta" => $val->idCuenta, "razonSocial" => $val->razonSocial, "nombreComercial" => $val->nombreComercial, "direccion" => $val->direccion, "ruc" => $val->ruc, "telefono" => $val->telefono);
    }
    echo json_encode($result);
}

if ($action == "combobox") {
    $cbx = array();
    $combo = $objCuentaDAO->ExecuteCompleteCombobox();
    foreach ($combo as $key => $val) {
        $cbx[$key] = array("idCuenta"=>$val->idCuenta,"nombreComercial"=>$val->nombreComercial);
    }
    echo json_encode($cbx);
}